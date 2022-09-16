<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saran;

class SaranController extends Controller
{
    public function storeSaran(Request $request)
    {
        $saran = Saran::create([
            'user_name' => $request->user_name,
            'saran' => $request->saran
        ]);

        return response()->json([
            'statusCode' => 201,
            'message' => 'Saran anda berhasil dikirim'
        ], 201);
    }
}
