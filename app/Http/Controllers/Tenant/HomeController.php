<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('tenant.dashboard');
    }
}
