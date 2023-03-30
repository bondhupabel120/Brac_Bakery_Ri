<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class ProjectController extends Controller
{
    function index()
    {
        if (isset($_COOKIE['product'])) {
            $products = json_decode($_COOKIE['product']);
            $cookie_products = Product::where(function ($query) use ($products) {
                if ($products) {
                    foreach ($products as $key => $product) {
                        if ($key == 0) {
                            $query->where('id', $product);
                        } else {
                            $query->orWhere('id', $product);
                        }
                    }
                }
            })->get();
        } else {
            $cookie_products = [];
        }
        $categories = Category::where('status', 1)->orderby('id', 'asc')->with('products')->get();
        return view('index', compact('categories', 'cookie_products',));
    }

    function products()
    {
        $categories = Category::where('status', 1)->orderby('id', 'asc')->with('products')->get();
        return view('products', compact('categories'));
    }

    function productDetails($id)
    {
        $product = Product::where('id', $id)->with('rcategory')->first();
        if (isset($_COOKIE['product'])) {
            $products = json_decode($_COOKIE['product']);
        } else {
            $products = [];
        }
        array_push($products, $product->id);
        setcookie('product', json_encode($products), time() + 86400, "/");
        return view('product_details', compact('product'));
    }

    function single_product(Request $request, $id)
    {
        $product_array = DB::table('products')->where('id', $id)->get(); //arrayOfOneObj
        //   <!  dump($product_array);
        return view('single_product', ['product_array' => $product_array]);
    }
}
