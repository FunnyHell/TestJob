<?php

namespace App\Http\Controllers;

use App\Jobs\NotificationJob;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;

class ProductController extends Controller
{
    public function index () {
        $products = Product::all();
        return view('dashboard', ['products' => $products]);
    }

    public function store (Request $request) {
        $product = new Product();
        $product->name = $request->name;
        $product->article = $request->article;
        $product->status = $request->status;
        $product->data = $request->data;
        $product->save();

        Queue::push(new NotificationJob($product));
        return $product;
    }

    public function update (Request $request, $id) {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->article = $request->article;
        $product->status = $request->status;
        $product->data = $request->data;
        $product->save();
        return $product;
    }
}
