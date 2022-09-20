<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
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
}
