<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            ['id' => 1, 'produk' => 'Laptop Gaming'],
            ['id' => 2, 'produk' => 'Mouse Wireless'],
            ['id' => 3, 'produk' => 'Keyboard Mechanical'],
        ];

        return view('list_product', compact('data'));
    }
}

