<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyHasProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // get all product order by name and price
    public function index(){
        $products = [];

        foreach (Product::orderBy("name")->orderBy("price")->get() as $product){
            $products [] = [
              "id" => $product->id,
              "name" => $product->name,
                "avatar" => $product->avatar,
                "price" => number_format($product->price, "0", "", " ")." Fcfa",
                "purchase_price" => number_format($product->purchase_price, "0", "", " ")." Fcfa",
                "category" => $product->category->name
            ];
        }

        return view("products.index", ["products" => $products]);
    }

    // get new product view
    public function create(){
        // get all categories order by name
        $categories = Category::orderBy("name")->get();

        return view("products.create", ["categories" => $categories]);
    }

    // get product view
    public function edit(int $id){

        // get product
        $product = Product::find($id);

        // get all categories order by name
        $categories = Category::orderBy("name")->get();

        return view("products.edit",
            [
                "categories" => $categories,
                "product" => $product
            ]
        );
    }

    // store a new product on database
    public function store(Request $request){
        // validate all requests content
        $request->validate([
            "avatar" => "",
            "name" => "required|unique:products|min:3",
            "price" => "required|min:2",
            "purchase_price" => "required|min:2",
            "category_id" => "required"
        ]);

        // verify if $request->avatar is set
        if ($request->avatar != null){ // if avatar is set
            $path = $this->saveFile($request);
        }else{
            $path = null;
        }

        // write data in database
        Product::create([
            "avatar" => $path,
            "name" => $request->name,
            "price" => $request->price,
            "purchase_price" => $request->purchase_price,
            "category_id" => $request->category_id
        ]);

        // return back with succes message
        return back()->with("success", "Produit créé avec succès...");
    }

    // update product imformations
    public function update(Request $request ,int $id){
        // get product
        $product = Product::find($id);

        // request validate
        $request->validate([
            "avatar" => "",
            "name" => "required|min:3",
            "price" => "required|min:2",
            "purchase_price" => "required|min:2",
            "category_id" => "required"
        ]);

        // verify if $request->avatar is set
        if ($request->avatar != null){ // if avatar is set
            $path = $this->saveFile($request);

            // write data in database
            $product->update([
                "avatar" => $path,
                "name" => $request->name,
                "price" => $request->price,
                "purchase_price" => $request->purchase_price,
                "category_id" => $request->category_id
            ]);

        }else{
            $path = null;
            // write data in database
            $product->update([
                "name" => $request->name,
                "price" => $request->price,
                "purchase_price" => $request->purchase_price,
                "category_id" => $request->category_id
            ]);
        }

        // return back with succes message
        return back()->with("success", "Produit mis à jour avec succès...");
    }

    // get ravitaillement create page
    public function getInCompany(){
        // get all company list
        $companies = Company::orderBy("name")->get();

        // get all product
        $products = Product::orderBy("name")->get();

        return view(
            "products.getincompany", [
                "companies" => $companies,
                "products" => $products
        ]);
    }

    public function addInCompany(Request $request){

        $request->validate([
            "product_id" => "required",
            "company_id" => "required",
            "quantity" => "required"
        ]);

        $companyHasProduct = CompanyHasProduct::where("company_id", $request->company_id)->where("product_id", $request->product_id)->first();

        if ($companyHasProduct == null){
            // store the intrance in the database
            CompanyHasProduct::create([
                "company_id" => $request->company_id,
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

        return back()->with("success", "Kiosque ravitaillé avec succès...");

    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function saveFile(Request $request): string|false
    {
        $avatar = $request->file("avatar");
        $title = Str::remove([' ', '.', ',', '?', ';', ':', '!', '§', '%', '*', 'µ', '$', '£', '^', '¨', '"', "/", "'", "\\"], $request->name);
        $extension = $avatar->extension();

        // création du nom du fichier image
        $avatarName = $title . '.' . $extension;

        // sauvegarde du fichier image dans le dossier
        $path = $request->file("avatar")->storeAs('images/avatars/products', $avatarName, "real_public");
        return $path;
    }
}
