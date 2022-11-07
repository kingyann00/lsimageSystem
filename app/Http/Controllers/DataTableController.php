<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class DataTableController extends Controller
{
    public function index()
    {
        return view('pages.client_list');
    }
    public function get()
    {


        return datatables()->of(Clients::query())->make(true);
    }

}