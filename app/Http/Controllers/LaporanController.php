<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\Laporan;
use App\Models\Village;
use App\Models\User;
use App\Models\Comodity;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['villages'] = Village::all();
        $data['comodities'] = Comodity::all();
        $data['not_verifieds'] = Laporan::where('is_verified',0)
        ->with('comodity','village')
        ->get();
        $data['fruits'] = Laporan::where('is_verified',1)
        ->wherehas('comodity', function($q){
            $q->where('type','buah');
        })
        ->with('comodity','village')
        ->get();
        $data['vegetables'] = Laporan::where('is_verified',1)
        ->wherehas('comodity', function($q){
            $q->where('type','sayur');
        })
        ->with('comodity','village')
        ->get();
        $data['biopharmaceuticals'] = Laporan::where('is_verified',1)
        ->wherehas('comodity', function($q){
            $q->where('type','biofarmaka');
        })
        ->with('comodity','village')
        ->get();
        return view('dashboard.laporan.index',$data);
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
        Laporan::create([
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

        return redirect()->back()->with('OK','Berhasil menambahkan laporan');
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
        Laporan::findOrFail($id)->update([
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

        return redirect()->back()->with('OK','Berhasil melakukan update laporan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Laporan::findOrFail($id)
        ->delete();

        return redirect()->back()->with('OK','Berhasil melakukan hapus laporan');
    }

    public function verifyLaporan($id)
    {
        Laporan::findOrFail($id)
        ->update([
            'is_verified' => 1
        ]);

        return redirect()->back()->with('OK','Berhasil melakukan verifikasi laporan');
    }

    public function getDetail(Request $request)
    {
        $data['laporan'] = Laporan::with('comodity','village')->find($request->id);
        $data['comodities'] = Comodity::all();
        $data['villages'] = Village::all();
        return response()->json($data, 200);
    }
}
