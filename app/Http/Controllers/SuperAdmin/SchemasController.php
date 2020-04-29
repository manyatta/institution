<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Institution;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SchemasController extends Controller
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
        $institutions = Institution::all();
        $users = User::all();
        return view('super_admin.schemas.index')->with([
            'institutions'=>$institutions,
            'users' => $users
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = User::whereHas('roles', function($q){
            $q->where('role', 'iadmin');
        })->get();
        return view('super_admin.schemas.create')->with('admins', $admins);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'unique:institutions',
            'user_id' => 'unique:institutions'
        ]);
        //request the variables
        $name = $request->name;
        $user_id = $request->user_id;

        
        //create the institution in the institutions table alongside its admin
        $institutionName = Institution::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
        
        //getting the admin
        $admin = User::where('id',$user_id)->get();
        //attachig the admin with the institution
        $institutionName->users()->attach($admin);

       
        //create the schema
        DB::unprepared("
        CREATE SCHEMA $name;
        ");

        //create the tables in the schema
        //Creating the Alumni table
        Schema::create($name.'.alumni', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('id_number');
            $table->String('name');
            $table->String('email');
            $table->string('password');
            $table->timestamps();
        });
        //creating the courses table
        Schema::create($name.'.courses', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->timestamps();
        });



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function show(Institution $institution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institution $institution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Institution  $institution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institution $institution)
    {
        //
    }
}
