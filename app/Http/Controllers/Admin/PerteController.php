<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyHasProduct;
use App\Models\Perte;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PerteController extends Controller
{
    // make pertes
    public function perte(int $company_id, $product_id){

        $companyHasproduct = CompanyHasProduct::where("company_id", $company_id)->where("product_id", $product_id)->first();

        // create perte
        Perte::create([
            "product_id" => $product_id,
            "company_id" => $company_id,
            "quantity" => $companyHasproduct->quantity
        ]);

        $companyHasproduct->update([
            "quantity" => 0
        ]);

        return back()->with("success", "stock du produit vidé avec succès...");
    }

}
