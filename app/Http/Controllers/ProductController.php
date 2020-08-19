<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category','images'])->paginate(env('PAGINATION_COUNT'));
        $currencyCode = env("CURRENCY_CODE","$");
        return view('admin.products.products')->with([
            'currency_code'=>$currencyCode ,
            'products' => $products]);

    }

    public function newProduct($id=null){


        $product = null;
        if(!is_null($id)){
            $product = Product::with(['hasUnit','category'])->find($id);

        }
        $units= Unit::all();
        $categories = Category::all();
        return view('admin.products.new-product')->with([
            'product'=>$product,
            'units'=>$units ,
            'categories'=>$categories

        ]);



    }
    public function delete($id){

    }
    public function update(Request $request){
        dd($request);

    }
    public function store(Request $request){

    }
}
