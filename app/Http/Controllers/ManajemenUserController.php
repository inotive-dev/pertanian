<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Village;
use App\Models\Role;
use App\Models\UserRole;

class ManajemenUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::whereHas('user_role', function($q){
            $q->where('role_id','!=',1);
        })
        ->with('kecamatan')
        ->get();

        $data['kecamatans'] = Kecamatan::all();
        $data['roles'] = Role::all();

        return view('dashboard.manajemen-user.index', $data);
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
        $saveUser = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'kecamatan_id' => $request->kecamatan,
        ]);

        UserRole::create([
            'role_id' => $request->role,
            'user_id' => $saveUser->id
        ]);

        return redirect()->back()->with('OK','Berhasil menambahkan user');
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
        $user = User::findOrFail($id);
        $user->update([
            'email' => $request->email,
            'name' => $request->name,
            'kecamatan_id' => $request->kecamatan,
        ]);

        if ($request->password) {
            $user->update([
                'password' => $request->password
            ]);
        }

        $userRole = UserRole::where('user_id', $id)->update([
            'role_id' => $request->role
        ]);

        return redirect()->back()->with('OK','Data user berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id)->delete();
        $userRole = UserRole::where('user_id', $id)->delete();

        return redirect()->back()->with('OK','Data user berhasil dihapus');
    }

    public function emailCheck(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        return response()->json($user, 200);
    }

    public function getDetail(Request $request)
    {
        $data['user'] = User::with('user_role')->find($request->id);
        $data['kecamatans'] = Kecamatan::all();
        $data['roles'] = Role::all();
        return response()->json($data, 200);
    }
}
