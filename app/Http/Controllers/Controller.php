<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
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
=======
use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected function getCurrentUser(): ?User
    {
        return Auth::user();
>>>>>>> 7e26a6e78dec355319f45492333b56002a784e7f
    }
}

