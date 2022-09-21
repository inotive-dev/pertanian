<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Village;
use App\Models\User;
use App\Models\Comodity;
use Validator;

class LaporanController extends Controller
{
    public function storeLaporan(Request $request){
        
        $validator = Validator::make($request->all(), [
            'desa' => 'required',
            'komoditas' => 'required',
            'luas_tanam' => 'required',
            'tanam_hasil' => 'required',
            'produksi' => 'required',
            'provitas' => 'required',
            'harga_produsen' => 'required',
            'harga_grosir' => 'required',
            'harga_eceran' => 'required'
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $key => $value) {
                $errors[] = $value;
            }
            return response()->json([
                'statusCode' => 400,
                'message' => 'Bad request',
                'error' => $errors
            ], 400);
        }
        
        $data = Laporan::create([
            'desa_id' => $request->desa,
            'comodity_id' => $request->komoditas,
            'luas_tanam' => $request->luas_tanam,
            'tanam_hasil' => $request->tanam_hasil,
            'jumlah_produksi' => $request->produksi,
            'provitas' => $request->provitas,
            'harga_produsen' => str_replace('.','',$request->harga_produsen),
            'harga_grosir' => str_replace('.','',$request->harga_grosir),
            'harga_eceran' => str_replace('.','',$request->harga_eceran),
        ]);

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil menyimpan laporan',
            'data' => $data
        ],201);
    }

    public function index(Request $request)
    {
        $data['fruits'] = Comodity::where('type','buah')
        ->get();

        foreach ($data['fruits'] as $key => $value) {
            $laporan['luas_tanam'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('luas_tanam');
            $laporan['tanam_hasil'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('tanam_hasil');
            $laporan['jumlah_produksi'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('jumlah_produksi');
            $laporan['provitas'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('provitas');
            $laporan['harga_produsen'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_produsen');
            $laporan['harga_grosir'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_grosir');
            $laporan['harga_eceran'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_eceran');
    
            $value['laporan'] = $laporan;
        }

        $data['vegetables'] = Comodity::where('type','sayur')
        ->get();

        foreach ($data['vegetables'] as $key => $value) {
            $laporan['luas_tanam'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('luas_tanam');
            $laporan['tanam_hasil'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('tanam_hasil');
            $laporan['jumlah_produksi'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('jumlah_produksi');
            $laporan['provitas'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('provitas');
            $laporan['harga_produsen'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_produsen');
            $laporan['harga_grosir'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_grosir');
            $laporan['harga_eceran'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_eceran');
        
            $value['laporan'] = $laporan;
        }

        $data['biopharmaceuticals'] = Comodity::where('type','biofarmaka')
        ->get();

        foreach ($data['biopharmaceuticals'] as $key => $value) {
            $laporan['luas_tanam'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('luas_tanam');
            $laporan['tanam_hasil'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('tanam_hasil');
            $laporan['jumlah_produksi'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('jumlah_produksi');
            $laporan['provitas'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('provitas');
            $laporan['harga_produsen'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_produsen');
            $laporan['harga_grosir'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_grosir');
            $laporan['harga_eceran'] = Laporan::where('is_verified',1)->where('comodity_id',$value->id)->sum('harga_eceran');
        
            $value['laporan'] = $laporan;
        }

        return response()->json([
            'statusCode' => 200,
            'message' => 'Berhasil get data laporan',
            'data' => $data
        ], 200);
    }
}
