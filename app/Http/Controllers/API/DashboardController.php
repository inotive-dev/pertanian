<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Village;
use App\Models\Kecamatan;
use App\Models\User;
use App\Models\Comodity;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        
        $wilayahArray = null;
        $sumKategoryPerWilayah = null;
        $colorArray = null;

        $wilayah = 'kecamatan';
        if ($request->wilayah) {
            $wilayah = $request->wilayah;
        }
        $data['wilayah'] = $wilayah;
        $laporans = Laporan::where('is_verified',1)
        ->with('comodity','village')
        ->get();
        $villages = Village::all();
        $comodities = Comodity::all();
        $comodityId = $comodities[0]->id;
        if ($request->komoditasId) {
            $comodityId = $request->komoditasId;
        }
        $data['comodityId'] = $comodityId;
        $category = 'luas_tanam';
        if ($request->category) {
            $category = $request->category;
        }
        $data['category'] = $category;
        $type = 'buah';
        if ($request->type) {
            $type = $request->type;
        }

        if ($wilayah == 'kecamatan') {
            $wilayahCollection = Kecamatan::with('villages')->get();
            foreach ($wilayahCollection as $key => $wilayah) {
                $wilayahArray[] = $wilayah->name;
                $tempoKategorySum = 0;
                foreach ($wilayah->villages as $key => $village) {
                    $laporan = Laporan::where('desa_id',$village->id)
                    ->where('comodity_id',$comodityId)
                    ->wherehas('comodity', function($q) use($type){
                        $q->where('type',$type);
                    })
                    ->sum($category);
                    $tempoKategorySum = $tempoKategorySum + $laporan;
                }
                $colorArray[] = $this->random_rgb_color($colorArray);
                $sumKategoryPerWilayah[] = $tempoKategorySum;
            }
        } else {
            $wilayahCollection = Village::all();
            foreach ($wilayahCollection as $key => $wilayah) {
                $wilayahArray[] = $wilayah->name;
                $laporan = Laporan::where('desa_id',$wilayah->id)->where('comodity_id',$comodityId)->sum($category);
                
                $colorArray[] = $this->random_rgb_color($colorArray);
                $sumKategoryPerWilayah[] = $laporan;
            }
        }

        $arrKomoditas = null;
        $arrSumHargaProdusen = null;
        $arrSumHargaGrosir = null;
        $arrSumHargaEceran = null;
        $colorBarArray = [];

        $year = date('Y');
        if($request->year) {
            $year = $request->year;
        }
        $comodities = Comodity::all();
        foreach ($comodities as $key => $value) {
            $arrKomoditas[] = $value->name;
            $laporanProdusen = Laporan::where('comodity_id',$value->id)->whereYear('created_at',$year)->sum('harga_produsen');
            $laporanGrosir = Laporan::where('comodity_id',$value->id)->whereYear('created_at',$year)->sum('harga_grosir');
            $laporanEceran = Laporan::where('comodity_id',$value->id)->whereYear('created_at',$year)->sum('harga_eceran');

            $arrSumHargaProdusen[] = $laporanProdusen;
            $arrSumHargaGrosir[] = $laporanGrosir;
            $arrSumHargaEceran[] = $laporanEceran;
            $colorBarArray[] = $this->random_rgb_color($colorBarArray);
        }

        $data['komoditasId'] = $comodityId;
        $data['type'] = $type;
        $data['year'] = $year;
        $data['wilayahArray'] = $wilayahArray;
        $data['sumKategoryPerWilayah'] = $sumKategoryPerWilayah;
        $data['colorArray'] = $colorArray;
        $data['arrKomoditas'] = $arrKomoditas;
        
        $data['arrSumHargaProdusen'] = $arrSumHargaProdusen;
        $data['arrSumHargaGrosir'] = $arrSumHargaGrosir;
        $data['arrSumHargaEceran'] = $arrSumHargaEceran;
        $data['colorBarArray'] = $colorBarArray;
        // dd($data);
        return response()->json([
            'statusCode' => 200,
            'message' => 'Berhasil get data dashboard',
            'data' => $data
        ],200);
    }

    public function random_rgb_color($colorArray) {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        $currentColor = [$r, $g, $b, 1];
        // if (in_array($currentColor,$colorArray)) {
        //     $this->random_rgb_color();
        // } else {
        //     return $currentColor;
        // }

        return $currentColor;
        
    }

    public function getAllComodity() {
        $comodities= Comodity::all();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Berhasil get data komoditas',
            'data' => $comodities
        ],200);
    }
}
