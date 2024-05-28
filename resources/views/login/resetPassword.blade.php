@extends('layouts.login')

@section('content')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h3 class="text-center font-weight-light my-4">Nova senha</h3>
            </div>
            <div class="card-body">

                <x-alert />

                <form action="{{ route('reset-password.submit') }}" method="POST">
                    @csrf
                    @method('POST')

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="Seu e-mail do usuário" value="{{ old('email') }}" />
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Confirmar a nova Senha" />
                        <label for="password">Nova Senha</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirmar a nova Senha" />
                        <label for="password_confirmation">Confirmar Nova Senha</label>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="this.innerText = 'Atualizando...'">Atualizar</button>
                    </div>

                </form>
            </div>

            <div class="card-footer text-center py-3">
                <div class="small text-decoration-none">
                    <a href="{{ route('login.index') }}" class="text-decoration-none">Clique aqui</a> para acessar.
                </div>
            </div>
        </div>
    </div>

@endsection
