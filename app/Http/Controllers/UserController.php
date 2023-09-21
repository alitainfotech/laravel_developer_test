<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Function to show all products to home page
     */
    public function index() {

        $products = Product::all();
        $plans = Plan::first();
        return view('user.home',compact('products', 'plans'));
    }
}
