<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

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

        // Verificar se existe usuário no banco de dados com o e-mail
        $user = User::where('email', $request->email)->first();

        // Verificar se encontrou usuário no banco de dados com o e-mail
        if (!$user) {

            // Salvar log
            Log::warning('Tentativa de recuperação com e-mail não cadastrado', ['email' => $request->email]);

            // Redirecionar o usuário, enviar mensagem de erro
            return back()->withInput()->with('error', 'E-mail não encontrado');
        }

        try {
            // Salvar o token, recuperar senha e enviar e-mail
            $status = Password::sendResetLink(
                $request->only('email')
            );

            // Salvar log
            Log::warning('Recuperar senha.', ['status' => $request->$status, 'email' => $request->email]);

            // Redirecionar o usuário, enviar mensagem de sucesso
            return redirect()->route('login.index')->with('success', 'Enviado e-mal com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!');

        } catch (Exception $e) {

            // Salvar log
            Log::warning('Erro recuperar senha.', ['error' => $e->getMessage(), 'email' => $request->email]);

            // Redirecionar o usuário, enviar mensagem de erro
            return back()->withInput()->with('error', 'Tente mais tarde!');
        }
    }

    public function showResetPassword(Request $request)
    {
        dd($request->token);
    }
}
