<?php

namespace App\Http\Controllers;

use App\Imports\SellerImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class SellerController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new SellerImport(), $request->file);
    }
}
