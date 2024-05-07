@extends('layouts.admin')

@section('content')
    <h2>Cadastrar um Curso</h2>

    <a href="{{ route('course.index') }}">
        <button type="submit">Listar</button></a> <br></a><br><br>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    @if ($errors->any())
        <span style="color:#f00">
            @foreach ($errors->all() as $error)
             {{ $error }} <br>
            @endforeach
            <br>
        </span>
    @endif

    <form action="{{ route('course.store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome do Curso" value="{{ old('name') }}"
            ><br><br>

        <label>Preço: </label>
        <input type="text" name="price" id="price" placeholder="Preço do Curso: 2.47" value="{{ old('price') }}"
            ><br><br>

        <button type="submit">Cadastrar</button>

    </form>
@endsection
