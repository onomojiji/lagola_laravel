<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Command;
use App\Models\CompanyHasProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // approvisionner un kiosque
    public function inputProduct(Request $request){
        // validate request input values

        try {
            $request->validate([
                "product_id" => "required",
                "quantity" => "required"
            ]);
        }catch (e){
            return response()->json([
                "status" => "fail",
                "massage" => "Erreur d'enregistrement, vérifiez les informations puis réessayez."
            ], 404);
        }


        // get the auth seller company
        $company = Auth::user()->seller->company;
        $companyHasProduct = CompanyHasProduct::where("company_id", $company->id)->where("product_id", $request->product_id)->first();

        if ($companyHasProduct == null){
            // store the intrance in the database
            CompanyHasProduct::create([
                "company_id" => $company->id,
                "product_id" => $request->product_id,
                "date" => Carbon::now(),
                "quantity" => $request->quantity,
            ]);
        }else{
            $quantity = $companyHasProduct->quantity;
            $companyHasProduct->update([
                "date" => Carbon::now(),
                "quantity" => $quantity + $request->quantity,
            ]);
        }

        return response()->json([
            "status" => "success",
            "message" => "Ravitaillement effectué avec succès."
        ], 201);

    }

    // sell a product
    public function sellProduct(Request $request){
        // validate request fields
        $request->validate([
            "product_id" => "required",
            "quantity" => "required"
        ]);

        // verify if request->quantity < sum of product in the company
        /*
         * ALGORITHME
         * - Detecter le kiosque de la vendeuse de l'utilisateur connecté
         * - Detecter le produit et le kiosque
         * - Compter le total des quantités du produit dans le kiosque
         * - Compter le total des quantités du produit vendu par le kiosque
         * - comparer ces deux quantités
         * - si le stock est plus grand que la quantité demandé on continue les opérations
         * - sinon tout s'arrête et on renvoi un message d'erreur
         * */

        // get seller
        $seller = Auth::user()->seller;

        // get company
        $company = $seller->company;

        // get product
        $product = Product::find($request->product_id);

        // verify if this company has product in stock
        if (CompanyHasProduct::where("product_id", $request->product_id)->where("company_id", $company->id)->first() == null){
            return response()->json([
                "status" => "fail",
                "message" => "Ce produit n'est pas en stock dans votre kiosque.."
            ], 404);
        }

        // count product in company quantity
        $productInStockCompany = CompanyHasProduct::where("product_id", $request->product_id)->where("company_id", $company->id)->first()->quantity;

        // if request->quantity + $productCommand quantity > $productInStockCompany
        if ($request->quantity > $productInStockCompany){
            return response()->json([
                "status" => "fail",
                "massage" => "Erreur d'enregistrement, quantité en stock insuffisante",
            ], 404);
        }

        // store command on database
        Command::create([
            "seller_id" => $seller->id,
            "company_id" => $company->id,
            "product_id" => $request->product_id,
            "date" => Carbon::now(),
            "quantity" => $request->quantity
        ]);

        //
        CompanyHasProduct::where("product_id", $request->product_id)->where("company_id", $company->id)->first()->update([
           "quantity" => $productInStockCompany - $request->quantity
        ]);

        return response()->json([
           "status" => "success",
           "message" => "Vente enregistré avec succès.."
        ], 201);
    }

    // get new sell interface
    public function getnewsell(){
        $all = [];
        $allProducts = Product::orderBy("name")->get();

        foreach ($allProducts as $product){
            $all[] = [
                "id" => $product->id,
                "name" => $product->name
            ];
        }

        return response()->json([
            "status" => "success",
            "message" => "Ajouter une nouvelle vente..",
            "products" => $all
        ]);

    }

    public function gethistory(){
        // aujourd'hui
        $today = date("Y-m-d", strtotime(\Illuminate\Support\Carbon::now()));

        // le vendeur connecté
        $seller = Auth::user()->seller;

        // le kiosque connecté
        $company = $seller->company;

        $history = [];

        // Toutes les ventes d'aujourd'hui
        $allTodayCommands = Command::where("seller_id", $seller->id)
            ->where("company_id", $company->id)
            ->where("date", $today)
            ->orderBy("created_at", "desc")
            ->get();

        foreach ($allTodayCommands as $command){
            $history[] = [
                "avatar" => $command->product->avatar,
                "name" => $command->product->name,
                "quantity" => $command->quantity,
            ];
        }

        return response()->json([
            "status" => "success",
            "message" => "historique des commandes journalières",
            "commandes" => $history
        ]);
    }

}
