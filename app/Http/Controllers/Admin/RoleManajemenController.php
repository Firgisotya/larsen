<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleManajemen;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RoleManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = RoleManajemen::all();
        return view('admin.role.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_role' => 'required',
        ]);

        $role = RoleManajemen::create($validateData);
        Alert::success('Berhasil', 'Data Berhasil Disimpan');
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoleManajemen  $roleManajemen
     * @return \Illuminate\Http\Response
     */
    public function show(RoleManajemen $roleManajemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleManajemen  $roleManajemen
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleManajemen $roleManajemen, $id)
    {
        $role = RoleManajemen::findOrFail($id);
        return view('admin.role.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleManajemen  $roleManajemen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleManajemen $roleManajemen, $id)
    {
        $validateData = $request->validate([
            'nama_role' => 'required',
        ]);

        RoleManajemen::where('id', $id)
            ->update($validateData);
        Alert::success('Berhasil', 'Data Berhasil Diubah');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleManajemen  $roleManajemen
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleManajemen $roleManajemen, $id)
    {
        $role = RoleManajemen::findOrFail($id);

        if(User::where('role_id', $role->id)->exists()){
            Alert::error('Gagal', 'Data Tidak Dapat Dihapus Karena Memiliki Relasi');
            return redirect()->route('role.index');
        }

        $role->delete();
        Alert::success('Berhasil', 'Data Berhasil Dihapus');
        return redirect()->route('role.index');
    }
}
