<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // get all categories list order by name
    public function index(){
        // request to get all categories objects in database
        $categories = Category::orderBy("name")->get();

        // return categories.index view with $categories
        return view("categories.index", ["categories" => $categories]);
    }

    // get the categories.create view to add new category
    public function create(){
        return view("categories.create");
    }

    // store a new categorie on database
    public function store(Request $request){
        // validate all request response
        $request->validate([
            "avatar" => "",
            "name" => "required|unique:categories",
            "description" => ""
        ]);

        // verify if $request->avatar is set
        if ($request->avatar != null){ // if avatar is set
            $avatar = $request->file("avatar");
            $title = Str::remove([' ','.', ',', '?', ';', ':', '!', '§', '%', '*', 'µ', '$', '£', '^', '¨', '"', "/", "'", "\\"], $request->name);
            $extension = $avatar->extension();

            // création du nom du fichier image
            $avatarName =  $title. '.' . $extension;

            // sauvegarde du fichier image dans le dossier
            $path = $request->file("avatar")->storeAs('images/avatars/categories', $avatarName, "real_public");
        }else{
            $path = null;
        }

        Category::create([
            "avatar" => $path,
            "name" => $request->name,
            "description" => $request->description
        ]);

        return redirect()->back()->with("success", "Catégorie créé avec succès...");
    }
}
