<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $productsGet = Product::select('id','name','price')->get();
        return view('product.index',['products'=>$productsGet]);


    }
    public function delete(Product $pro){
        if($pro->delete()){
            return redirect()->route('products.index');
        }

    }
   
}
