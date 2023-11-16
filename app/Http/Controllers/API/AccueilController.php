<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Command;
use App\Models\Company;
use App\Models\CompanyHasProduct;
use App\Models\Fonction;
use App\Models\Institution;
use App\Models\Mois;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccueilController extends Controller
{
    // accueil des produits vendus
    public function home(){

        /*
         * ALGO
         * - Je trouve d'abord la date du jour
         * - Je trouve les identifiants du vendeur connecté ainsi que son kiosque
         * - Je cherche dans la liste des commandes d'aujourd'hui, les commandes qui ont été faites par le vendeurs
         * actuellement connecté
         * - Puis je fais la somme des quantités de produits vendus aujourd'hui
         * - Ensuite je fais la somme des prix tu total des produits vendus aujourd"hui
         * - Puis pour chaque produit vendu, je trouve le nombre de vente de ce jour et la quantité en stock restant
         * dans son kiosque d'appartenance
         * - Et enfin je renvoi un tableau constitué des produits + la quantité en stock + la quantité vendue aujourd'hui
         * */

        // aujourd'hui
        $today = date("Y-m-d", strtotime(Carbon::now()));

        // le vendeur connecté
        $seller = Auth::user()->seller;

        // le kiosque connecté
        $company = $seller->company;

        // Toutes les ventes d'aujourd'hui
        $allTodayCommands = Command::where("seller_id", $seller->id)
            ->where("company_id", $company->id)
            ->where("date", $today)
            ->get();

        // somme des produits vendus aujourd'hui
        $allTodaySumProducts = 0;
        foreach ($allTodayCommands as $command){
            $allTodaySumProducts += $command->quantity;
        }

        // somme des prix des produits vendus aujourd'hui
        $allTodaySumProductsPriceToday = 0;
        foreach ($allTodayCommands as $command){
            // somme des prix = Somme (quantite * prix unitaire)
            $allTodaySumProductsPriceToday += ($command->quantity * $command->product->price);
        }

        // pour chaque produit vendu aujourd'hui determiner la quantité totale sortie et en stock du jour

        $allTodayProducts = []; // liste des produits vendus aujourd'hui avec toutes les infos annexes
        $allPivots = []; // liste des pivots

        // je parcours la liste des commandes d'aujourd'hui
        for ($i=0; $i< count($allTodayCommands); $i++){

            // Pour chaque produit différent, je le définis comme pivot
            $actualProductId = $allTodayCommands[$i]->product_id; // pivot actuel

            // je vérifie si le pivot actuel existe déjà dans la table des pivots
            // Si il n'existe pas, on continue
            if (!in_array($actualProductId, $allPivots)){

                // J'ajoute son id dans la liste des pivots
                array_push($allPivots, $actualProductId);

                $allOut = 0; // quantité totale sortie
                $allInStock = CompanyHasProduct::where("product_id", $actualProductId)
                    ->where("company_id", $company->id)
                    ->first()->quantity; // quantité totale en stock

                // je parcours à nouveau la liste des commandes du jour
                foreach ($allTodayCommands as $command){

                    // si l'id du produit de la commande du pointeur est égal au pivot
                    if ($command->product_id == $actualProductId){
                        $allOut += $command->quantity; // on incrémente le nombre de vente

                        // on va chercher dans la table des entrées de produits
                        $allInStock = CompanyHasProduct::where("product_id", $actualProductId)->where("company_id", $company->id)->first()->quantity;
                    }
                }

                // a la fin du cycle du produit actuel on le stock dans la liste des produits
                $allTodayProducts[] = [
                    "id" => $allTodayCommands[$i]->product->id,
                    "avatar" => $allTodayCommands[$i]->product->avatar,
                    "name" => $allTodayCommands[$i]->product->name,
                    "price" => number_format($allTodayCommands[$i]->product->price, 0, "", " ")." Fcfa" ,
                    "inStock" => $allInStock,
                    "outStock" => $allOut
                ];
            }

            // si il existe dans la table des pivots, on passe au produit suivant

        }

        // a la fin, on retourne le resultat dans un json
        return response()->json([
            "status" => "success",
            "message" => "Bienvenue",
            "data" => [
                "today" => date("d/m/Y", strtotime(Carbon::now())),
                "allProducts" => number_format($allTodaySumProducts, 0, "", " ") ,
                "allSumProductPrice" => number_format($allTodaySumProductsPriceToday, 0, "", " ")." Fcfa",
                "allProductsToday" => $allTodayProducts
            ]
        ], 200);

    }

    // accueil des produits en stock
    public function homeInStock(){
        /*
         * ALGO
         * - Je trouve aujourd'hui
         * - Je trouve le vendeur connecté
         * - Je trouve le kiosque du vendeur connecté
         * - Je parcours la table des companyhasproduct pour réccupérer chaque produit du kiosque
         * */

        // aujourd'hui
        $today = date("Y-m-d", strtotime(Carbon::now()));

        // le vendeur connecté
        $seller = Auth::user()->seller;

        // le kiosque connecté
        $company = $seller->company;

        // tous les produits du kiosques
        $allCompanyProducts = [];
        foreach (CompanyHasProduct::where("company_id", $company->id)->get() as $item){
            $allCompanyProducts[] = [
                "id" => $item->product_id,
                "avatar" => $item->product->avatar,
                "name" => $item->product->name,
                "price" => number_format($item->product->price, 0, "", " ")." Fcfa",
                "quantity" => number_format($item->quantity, 0, "", " "),
            ];
        }

        // on retourne le tableau sous forme de json
        return response()->json([
           "status" => "success",
           "message" => "Okay",
           "data" => [
               "today" => $today,
               "allCompanyProducts" => $allCompanyProducts
           ]
        ]);
    }
}
