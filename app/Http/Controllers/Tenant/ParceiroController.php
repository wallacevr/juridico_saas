<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Parceiro;

class ParceiroController extends Controller
{
    //

    public function index()
    {
        return view('tenant.parceiros.index', [
            'parceiros' => Parceiro::paginate(10),
        ]);
    }

    public function create()
    {
 
        return view('tenant.parceiros.create');
    }

    public function show(Parceiro $parceiro)
    {
        return view('tenant.parceiros.index', [
            'parceiros' => Parceiro::paginate(10),
        ]);
    }

    public function edit(Parceiro $parceiro)
    {
        return view('tenant.parceiros.index', [
            'parceiros' => Parceiro::paginate(10),
        ]);
    }

    public function update(Parceiro $parceiro)
    {
        return view('tenant.parceiros.index', [
            'parceiros' => Parceiro::paginate(10),
        ]);
    }

    public function destroy(Parceiro $parceiro)
    {
        return view('tenant.parceiros.index', [
            'parceiros' => Parceiro::paginate(10),
        ]);
    }
}
