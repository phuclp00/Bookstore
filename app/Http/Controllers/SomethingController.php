<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Observers\Product;
use Illuminate\Http\Request;

class SomethingController extends Controller
{
    public function index()
    {
        $books = ProductModel::all();
        return \response(['data' => $books]);
    }
}
