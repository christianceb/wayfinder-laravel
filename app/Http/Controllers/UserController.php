<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $admin = User::all();
        return view('Admin.Admin_Browse', ['admin' => $admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Admin_Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $admin = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $admin->save();
        return redirect('/Admin')
        ->with('success','Admin created');

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
        $admin = User::find($id);
        return view('Admin.Admin_Show', ['admin' => $admin]);
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
        $admin = User::find($id);
        return view('Admin.Admin_edit', ['admin' => $admin]);
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
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $admin = User::find($id);
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->password = Hash::make($request->get('password'));

        $admin->update();
        return redirect('/Admin')
        ->with('success','Admin updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = User::findOrFail($id);
        // hide goes here

        // if($admin) {
        //     echo '<script>document.getElementById("id").style.display = "none"; </script>';
        // }

        // delete for now to not waste time and continue the sprint
        $admin->delete();

        return redirect('/Admin')->with('success', 'Admin hidden');

    }
}
