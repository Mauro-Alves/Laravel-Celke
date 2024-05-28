<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    // Carregar o formulário recuperar senha
    public function showForgotPassword()
    {
        //Carregar a VIEW
        return view('login.forgotPassword');
    }

    // Receber os dados do formulário recuperar senha
    public function submitForgotPassword(Request $request)
    {
        // Validar o formulário
        $request->validate(
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'O campo e-mail é obrigatório.',
                'email.email' => 'Necessário enviar e-mail válido',
            ]
        );

        dd("Enviar e-mail");
    }
}
