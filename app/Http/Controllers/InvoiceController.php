<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Invoice_detail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use PDF;
use DOMDocument;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = DB::table('invoices')
                ->select('invoices.*','clients.company_name')
                ->join('clients', 'clients.client_id', '=', 'invoices.client_id')
                ->leftjoin('invoice_details', 'invoice_details.invoice_id', '=', 'invoices.invoice_id')
                ->groupBy('invoices.invoice_id')
                ->get();
        $invoicesData = [   'invoices' => $invoices,
                            
                        ];

        return view('pages.invoice_list', compact('invoicesData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create($client)
    {
        // return $client;
        $clientInfo = DB::table('clients')
                ->select('clients.*')
                ->where('clients.company_name','=',"$client")    
                ->first();
        if ($clientInfo) {
           $client_PICs = DB::table('client_pics')
                ->select('client_pics.*')
                ->where('client_pics.client_id','=',"$clientInfo->client_id")    
                ->get();
            $clientInfo = [ 'client' => $clientInfo, 'PIC' => $client_PICs];
        }
       
        // return $client_PICs;
        
        // return $clientInfo;
        // $PIC = $clientInfo['PIC'];
        // for ($i=0; $i < sizeof($PIC); $i++) { 
            
        //     return $PIC[$i]->PIC_id;
        // }
        return view('pages.invoice_create', compact('clientInfo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $quantity_list = explode(",",$request->quantity_list);
        $unitPrice_list = explode(",",$request->unitPrice_list);
        $amount_list = explode(",",$request->amount_list);
        

        $user = DB::table('users')
                    ->where('fullname', $request->session()->get('fullname'))
                    ->first();

        $client = DB::table('clients')
                    ->where('company_name', $request->company_name)
                    ->first();

        

        $invoice = new Invoice;
        $invoice->invoice_date = $request->get('invoice_date');
        $invoice->subtotal = $request->get('subtotal');
        $invoice->total_amount = $request->get('total_amount');
        $invoice->status = 1;
        $invoice->tax_id = 1;
        $invoice->user_id = $user->user_id;
        $invoice->client_id = $client->client_id;
                

        $invoice->save();

        for ($i=0; $i < sizeof($quantity_list); $i++) { 
            $invoice_detail = new Invoice_detail;
            $invoice_detail->description = $request->get('description')[$i];
            $invoice_detail->qty = $quantity_list[$i];
            $invoice_detail->unit_price = $unitPrice_list[$i];
            $invoice_detail->amount = $amount_list[$i];


            $invoice_detail->save();
        }
        return redirect()->route('invoice.client');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company_name)
    {
        $invoices = DB::table('invoices')
                ->select('invoices.*','clients.company_name')
                ->join('clients', 'clients.client_id', '=', 'invoices.client_id')
                ->leftjoin('invoice_details', 'invoice_details.invoice_id', '=', 'invoices.invoice_id')
                ->where('clients.company_name','=',$company_name)
                ->groupBy('invoices.invoice_id')
                ->get();
        
        $invoicesData = [   'invoices' => $invoices,
                            'company_name' => $company_name,
                        ];

        return view('pages.invoice_list', compact('invoicesData'));
    }


    public function downloadPDF($id = null){
        // $order_details = new Order_detail();
        // $user = new users();
        
        // $order_detail = $order_details->getOrder_Detail($id);
        // $orders = new Order($user->getUserID());
       
        // $order = $orders->findOrder($id);

        // if ($order == null) {
        //     return abort(404);
        // }

        $invoice_id = $id;
        $invoice_client = DB::table('invoices')
                ->select('invoices.*','clients.*', 'payable_taxes.*')
                ->join('clients', 'clients.client_id', '=', 'invoices.client_id')
                ->join('payable_taxes', 'invoices.tax_id', '=', 'payable_taxes.tax_id')
                ->where('invoices.invoice_id', $invoice_id)
                ->first();

        $client_PICs = DB::table('client_pics')
                    ->where('client_pics.client_id', $invoice_client->client_id)
                    ->get();
       // return $client_PICs;
        $invoice_detail = DB::table('invoice_details')
                ->select('invoice_details.DESCRIPTION','invoice_details.qty','invoice_details.unit_price','invoice_details.amount')
                ->where('invoice_details.invoice_id', $invoice_id)
                ->get();
        

        $invoice = [
                'invoice_client' => $invoice_client,
                'invoice_detail' => $invoice_detail,
                'client_PICs'    => $client_PICs,
        ];


        
        $invoice_no = $invoice['invoice_client']->invoice_no;
        $invoice_client = $invoice['invoice_client']->company_name;
        $pdf = PDF::loadView('pages.include.invoicePDF',compact('invoice'));
        $filename = $invoice_no.' '.$invoice_client;
        
        return $pdf->download($filename.'.pdf');
    }


    public function edit($id)
    {

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

