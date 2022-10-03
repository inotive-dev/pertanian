<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Village;
use App\Models\Kecamatan;
use App\Models\User;
use App\Models\Comodity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['years'] = [];
        $allLaporan = Laporan::select(['created_at'])->orderBy('created_at','DESC')->get();
        foreach ($allLaporan as $key => $value) {
            if (!in_array($value->created_at->year,$data['years'])) {
                $data['years'][] = $value->created_at->year;
            }
        }
        // dd($data['years']);
        $data['selectedYear'] = $data['years'][0] ?? null;
        if ($request->year) {
            $data['selectedYear'] = $request->year;
        }
        
        $wilayahArray = null;
        $sumKategoryPerWilayah = null;
        $colorArray = null;

        $currentWilayah = 'kecamatan';
        if ($request->wilayah) {
            $currentWilayah = $request->wilayah;
        }
        $data['laporans'] = Laporan::where('is_verified',1)
        ->with('comodity','village')
        ->get();
        $data['villages'] = Village::all();
        $data['comodities'] = Comodity::all();
        $comodityId = $data['comodities'][0]->id;
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

        if ($currentWilayah == 'kecamatan') {
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
        foreach ($data['comodities'] as $key => $value) {
            $arrKomoditas[] = $value->name;
            $laporanProdusen = Laporan::where('comodity_id',$value->id)->whereYear('created_at',$year)->sum('harga_produsen');
            $laporanGrosir = Laporan::where('comodity_id',$value->id)->whereYear('created_at',$year)->sum('harga_grosir');
            $laporanEceran = Laporan::where('comodity_id',$value->id)->whereYear('created_at',$year)->sum('harga_eceran');

            $arrSumHargaProdusen[] = $laporanProdusen;
            $arrSumHargaGrosir[] = $laporanGrosir;
            $arrSumHargaEceran[] = $laporanEceran;
            $colorBarArray[] = $this->random_rgb_color($colorBarArray);
        }

        $data['arrSumHargaProdusen'] = $arrSumHargaProdusen;
        $data['arrSumHargaGrosir'] = $arrSumHargaGrosir;
        $data['arrSumHargaEceran'] = $arrSumHargaEceran;
        $data['colorBarArray'] = $colorBarArray;

        $data['komoditasId'] = $comodityId;
        $data['type'] = $type;
        $data['year'] = $year;
        $data['wilayahArray'] = $wilayahArray;
        $data['sumKategoryPerWilayah'] = $sumKategoryPerWilayah;
        $data['colorArray'] = $colorArray;
        $data['arrKomoditas'] = $arrKomoditas;
        
        $data['currentWilayah'] = $currentWilayah;
        // dd($data);
        return view('dashboard.dashboard.index',$data);
    }

    public function random_rgb_color($colorArray) {
        $r = rand(0, 255);
        $g = rand(0, 255);
        $b = rand(0, 255);
        $currentColor = "rgb($r, $g, $b)";
        // if (in_array($currentColor,$colorArray)) {
        //     $this->random_rgb_color();
        // } else {
        //     return $currentColor;
        // }

        return $currentColor;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
