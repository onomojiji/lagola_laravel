<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Company;
use App\Models\Seller;

class HomeController extends Controller
{
    public function home(){

        // réccupérer la liste des ventes
        $ventes = Command::orderBy("created_at", "desc")->get();

        // récupérer la liste des kiosques
        $kiosques = Company::orderBy("name")->get();

        // réccupérer la liste des vendeuses
        $vendeuses = Seller::all();

        return view("index");
    }
}
