<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\User;
use Auth;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->update([
            'name' => $request->name,
        ]);

        if ($request->password) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil update profile',
            'data' => $user
        ],201);
    }

    public function getProfile(Request $request)
    {
        $user = User::with('kecamatan')->findOrFail(Auth::user()->id);

        return response()->json([
            'statusCode' => 200,
            'message' => 'Berhasil get profile',
            'data' => $user
        ],200);
    }
}
