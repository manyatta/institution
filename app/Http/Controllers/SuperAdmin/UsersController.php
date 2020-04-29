<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
// use App\Employer;
// use App\Admin;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return all the kind of users  
        $users = User::all();
        return view('super_admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::where('role','iadmin')->get();
        $validate = $request->validate([
            'name' => ['unique:users','required'],
            'email' => ['unique:users','required']
        ]);
        $save = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $save->roles()->attach($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // if (Gate::denies('edit-users')) {
        //     return redirect(route('super_admin.users.index'));
        // }

        $roles = Role::all();
        return view('super_admin.users.edit')->with([
        'user'=> $user,
        'roles' => $roles,
            ]);
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        return redirect()->route('super_admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if (Gate::denies('delete-users')) {
        //     return redirect(route('super_admin.users.index'));
        // }
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('super_admin.users.index');
    }
}
