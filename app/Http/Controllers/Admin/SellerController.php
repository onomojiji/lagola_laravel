<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    // get all sellers list
    public function index(){
        $sellers = [];

        // get all user by active = 1, admin = 0 and order by name
        for ($i=0; $i<count($users = User::where("active", 1)->where("admin", 0)->orderBy("name")->get()); $i++){
            // if user is selles
            if ($users[$i]->seller != null){
                // store user in sellers[]
                $sellers[] = [
                    "id" => $users[$i]->seller->id,
                    "name" => $users[$i]->name,
                    "phone" => $users[$i]->phone,
                    "sexe" => $users[$i]->seller->sexe,
                    "cni" => $users[$i]->seller->cni,
                    "company" => $users[$i]->seller->company->name,
                    "status" => $users[$i]->active,
                ];
            }
        }

        return view("sellers.index", ["sellers" => $sellers]);
    }

    // add new seller
    public function create(){
        // get all companies order by name
        $compannies = Company::orderBy("name")->get();

        //reture sellers.create view with $companies
        return view("sellers.create", ["companies" => $compannies]);
    }

    // store seller informtions
    public function store(Request $request){

        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required|min:9|max:9|unique:users',
            'sexe' => 'required',
            'cni' => 'required|unique:sellers',
            'company_id' => 'required',
            'password' => 'required|min:6',
            'confirm' => 'required|min:6',
        ]);

        // check if the both password are same
        if ($request->password != $request->confirm){ // if not return to the form
            return redirect()->route("sellers.create")->with("fail", "Les mots de passe sont différents.");
        }

        // first store the user informations
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // second store the seller informations
        Seller::create([
            "user_id" => $user->id,
            "company_id" => $request->company_id,
            "sexe" => $request->sexe,
            "cni" => $request->cni,
        ]);

        return redirect()->route('sellers.create')->with("success", "Vendeur(se) enregistré avecsuccès.");
    }
}
