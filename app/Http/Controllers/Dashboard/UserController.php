<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::selectRaw('users.*, roles.name as role')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.id', 'asc')
            ->get();

        return view('pages.users.index', compact(['user']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::all();

        return view('pages.users.create', compact(['role']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());
            $image_path = $file->move('storage/users', $filename);
        } else {
            $image_path = null;
        }

        User::create([
            'role_id'       => $request->role_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'picture_path'  => $image_path
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $role = Role::all();

        return view('pages.users.edit', compact(['user', 'role']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if ($request->hasFile('image')){
            $file = $request->file('image');
            $filename = sprintf('%s_%s.%s', date('Y-m-d'), md5(microtime(true)), $file->extension());

            if ($user->picture_path != null) unlink($user->picture_path);
            $image_path = $file->move('storage/users', $filename);
        } else {
            $image_path = $user->picture_path;
        }

        $user->update([
            'role_id'       => $request->role_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'picture_path'  => $image_path
        ]);

        return redirect()->route('user.index')->with('success', 'User berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user->picture_path != null) unlink($user->picture_path);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User berhasil dihapus!');
    }
}
