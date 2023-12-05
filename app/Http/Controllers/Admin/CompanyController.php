<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\Company;
use App\Models\CompanyHasProduct;
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

    // show company in stock products
    public function show(int $company_id){
        $company = Company::find($company_id);

        if ($company == null){
            abort(404);
        }

        $companyProducts = [];
        $companyCommands = [];

        $companyHasProducts = CompanyHasProduct::where("company_id", $company_id)->orderBy("updated_at", "desc")->get();

        $companyHasCommands = Command::where("company_id", $company_id)->orderBy("updated_at", "desc")->paginate(30);

        // get all company in stock product;
        foreach ($companyHasProducts as $chp){
            $companyProducts[] = [
                "id" => $chp->id,
                "product_id" => $chp->product_id,
                "company_id" => $chp->company_id,
                "name" => $chp->product->name,
                "category" => $chp->product->category->name,
                "date" => date("H:i:s | d/m/Y", strtotime($chp->updated_at) ),
                "quantity" => $chp->quantity,
                "price" => number_format(num: $chp->product->price, decimals: 0, decimal_separator: ",", thousands_separator: " ")
            ];
        }

        // get all company commands
        foreach ($companyHasCommands as $command){

            $companyCommands[] = [
                "name" => $command->product->name,
                "quantity" => $command->quantity,
                "date" => date("H:i:s | d/m/Y", strtotime($command->created_at)),"category" => $command->product->category->name,
                "price" => number_format(num: $command->product->price * $command->quantity, decimals: 0, decimal_separator: ",", thousands_separator: " ")
            ];
        }

        return view(
            "companies.show", [
                "company" => $company,
                "companyProducts" =>$companyProducts,
                "companyCommands" => $companyCommands
        ]);
    }
}
