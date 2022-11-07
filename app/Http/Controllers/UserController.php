<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

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
    }

    public function login(Request $request){
         
            $request->session()->put('email', $request->email);  
            $request->session()->put('password', $request->password);  
            $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
           
            ]);

            $user = DB::table('users')
                  ->where('email', $request->get('email'))
                  ->first();
            if (isset($user)) {
                    if (Crypt::decrypt($user->password) == $request->get('password') ) {
                        $request->session()->put('fullname', $user->fullname);  
                        $request->session()->forget('email');
                        $request->session()->forget('password');
                                                
                        return redirect()->route('client.list');
                    }else{
                        return back()->with('login_fail','Invalid password');
                    }
                    
            }else{
                return back()->with('login_fail','Invalid username or password');
                // return back()->with('login_fail',Crypt::encrypt($request->password));
            }   
       
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
         $this->validate($request, [
            'fullname' => 'required',
            'email' => 'required',
            'password' => 'required'
            ]);

            $user = new User;
            $user->fullname = $request->get('fullname');
            $user->email = $request->get('email');
            $user->password =Crypt::encrypt($request->get('password')) ;
            $user->save();
   
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
