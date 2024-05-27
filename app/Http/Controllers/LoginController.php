<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Login

    public function index()
    {
        // Carregar a view
        return view('login.index');
    }

    public function LoginProcess(LoginRequest $request)
    {
        // Validar o formulário
        $request->validated();

        //Validar o usuário e a senha com as informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(!$authenticated){

            //Redirecionar o usuário para a página anterior "login", enviar a mensagem de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválidos!');

        }
        
            //Se correto redirecionar o Usuário
            return redirect()->route('dashboard.index');
    }
}
