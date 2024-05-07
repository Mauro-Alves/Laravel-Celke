@extends('layouts.admin')

@section('content')
    <h2>Detalhes do curso</h2>

    <a href="{{ route('course.index') }}">
        <button type="submit">Listar</button>
    </a> <br><br>

    <a href="{{ route('course.edit', ['course' => $course->id]) }}">
        <button type="submit">Editar</button>
    </a> <br><br>

    <form action="{{ route('course.destroy', ['course' => $course->id]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>

    </form><br>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif


    ID: {{ $course->id }} <br>
    Nome: {{ $course->name }} <br>
    Preço: {{ 'R$ ' . number_format($course->price, 2, ',' , '.') }} <br>
    Cadastrado: {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
    Editado: {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
@endsection
