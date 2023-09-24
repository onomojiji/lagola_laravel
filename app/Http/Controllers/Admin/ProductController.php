<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

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

    // store a new product on database
    public function store(Request $request){
        // validate all requests content
        $request->validate([
            "avatar" => "",
            "name" => "required|unique:products|min:3",
            "price" => "required|min:2",
            "category_id" => "required"
        ]);

        // write data in database
        Product::create([
            "avatar" => $request->avatar,
            "name" => $request->name,
            "price" => $request->price,
            "category_id" => $request->category_id
        ]);

        // return back with succes message
        return back()->with("success", "Produit créé avec succès...");
    }
}
