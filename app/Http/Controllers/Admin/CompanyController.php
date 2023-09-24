<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // get all companies
    public function index(){
        $companies = Company::orderBy("name")->get();

        return view("companies.index", ["companies" => $companies]);
    }

    // get new company form
    public function create(){
        return view("companies.create");
    }

    // store a new companie
    public function store(Request $request){

        $request->validate([
           'name' => 'required|min:3',
           'address' => ''
        ]);

        Company::create([
            'name' => $request->name,
            'address' => $request->address
        ]);

        return redirect()->back()->with("success", "Agence enregistré avecsuccès.");
    }
}
