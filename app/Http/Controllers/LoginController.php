<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        if (!$authenticated) {

            //Redirecionar o usuário para a página anterior "login", enviar a mensagem de erro
            return back()->withInput()->with('error', 'E-mail ou senha inválidos!');
        }

        //Se correto redirecionar o Usuário
        return redirect()->route('dashboard.index');
    }

    // Carregar o formulário cadastrar novo usuário
    public function create()
    {
        // Carregara a VIEW
        return view('login.create');
    }

    // Cadastrar no banco de dados o novo usuário
    public function store(LoginUserRequest $request)
    {
        // Validar o formulário
        $request->validated();

        // Marca o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            // Cadastrar o usuário no banco de dados na tabela usuários
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            // Salvar log
            Log::info('Usuário cadastrado.', ['id' => $user->id]);

            // Operação é concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('login.index')->with('success', 'Usuário cadastrado com sucesso!');
            
        } catch (Exception $e) {

            // Salvar log
            Log::info('Usuário não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não é concluída com êxito
            DB::rollBack();

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'Usuário não cadastrado!');
        }
    }

    public function destroy()
    {
        // Deslogar o usuário
        Auth::logout();

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('login.index')->with('success', 'Deslogado com sucesso!');
    }
}
