<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $clients = Clients::all()->toArray();
        return view('pages.client_list', compact('clients'));
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
    public function findPICPhone(Request $request){
        
        $data = DB::table('client_pics')
                ->select('client_pics.phone_no')
                ->where('client_pics.PIC_id','=',$request->id)    
                ->get();

        return response()->json($data);
    }
    public function store(Request $request)
    {
            
            $request->session()->put('company_name', $request->company_name);  
            $request->session()->put('company_email', $request->company_email);  
            $request->session()->put('company_address', $request->company_address);  
            $request->session()->put('PIC_Name', $request->PIC_Name);  
            $request->session()->put('phone_no', $request->phone_no);  
            $this->validate($request, [
                'company_name' => 'required',
                'company_address' => 'required',
                'PIC_Name' => 'required',
                'phone_no' => 'required|numeric'
            ]);
          
            // get user id    
               
                $user = DB::table('users')
                        ->where('fullname', $request->session()->get('fullname'))
                        ->first();
            
                $client = DB::table('clients')
                  ->where('company_name', $request->get('company_name'))
                  ->first();
                if ($client) {
                    $request->session()->forget('company_name');
                    return back()->with('error', 'company_name Duplicate');
                }

                $client = DB::table('clients')
                  ->where('company_email', $request->get('company_email'))
                  ->first();
                                

                $client = new Clients;
                $client->company_name = $request->get('company_name');
                $client->company_email = $request->get('company_email');
                $client->company_address = $request->get('company_address');
                $client->user_id = $user->user_id;
                

                $client->save();
           
            $request->session()->forget('company_name');
            $request->session()->forget('company_email');
            $request->session()->forget('company_address');
            $request->session()->forget('PIC_Name');
            $request->session()->forget('phone_no');
            return redirect()->route('client.list')->with('success','New Client Data Added');
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
