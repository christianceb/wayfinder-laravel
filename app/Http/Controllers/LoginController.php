<?php

namespace App\Http\Controllers;

use App\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        if(Auth::user()) {
            return redirect()
            ->route('Admin.successlogin')
            ->with('Welcome! Your logged in');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.login');
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
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */

function checklogin(Request $request) {

    $this->validate($request, [
        'email'   => 'required|email',
        'password'  => 'required'
    ]);

    // create our user data for the authentication
    $userdata = $request->only('email', 'password');

    // attempt to do the login
    if (Auth::attempt($userdata)) {
        return redirect()
        ->route('Admin.successlogin')
        ->with('Welcome! Your logged in');
    } 
    else {        
    // validation not successful, send back to form 
    return back()->with('error', 'Wrong Login Details');
}

    
}

    function successlogin() {
        return view('Admin.successlogin');
    }

    function logout() {
        Auth::logout();
        return view('Admin.login');
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
        //
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
    }
}
