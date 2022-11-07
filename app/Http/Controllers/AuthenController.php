<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class AuthenController extends Controller
{
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

            }   

        


          
    
       
       
   }

   public function checkLogin(){

   }
}
