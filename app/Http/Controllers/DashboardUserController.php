<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.users.user-management', [
            'title' => 'User',
            'roles' => Role::all(),
            'users' => User::latest()->paginate(10),
            'admins' => User::where('role_id', 2)->get(),
        ]);
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
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'nim' => 'required|min:7|max:18|unique:users,nim',
            'email' => 'required|email:dns',
            'password' => 'required|min:4',
            'role_id' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect('/pages/users')->with('userSuccess', 'Data user berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return json_encode($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // return $request;
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email:dns',
            'role_id' => 'required'
        ];

        if ($request->nim != $user->nim) {
            $rules['nim'] = 'required|min:7|max:18|unique:users,nim';
        }

        $validatedData = $request->validate($rules);
        User::where('id', $user->id)
            ->update($validatedData);

        return redirect('/pages/users')->with('userSuccess', 'Data user berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/pages/users')->with('deleteUser', 'Hapus data user berhasil');
    }

    public function makeAdmin($id)
    {
        $userData = [
            'role_id' => 2,
        ];

        User::where('id', $id)->update($userData);

        return redirect('/pages/admin')->with('adminSuccess', 'Data admin berhasil ditambahkan');
    }
}
