<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Login

    public function index()
    {
        // Carregar a view
        return view('login.index');
    }
}
