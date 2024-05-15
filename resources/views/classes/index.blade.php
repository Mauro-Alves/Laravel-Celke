@extends('layouts.admin')

@section('content')

    <h2>Listar as Aulas</h2>

    <a href="{{ route('course.index') }}">
        <button type="submit">Cursos</button>
    </a> <br><br>

    <a href="{{ route('classe.create',['course' => $course->id]) }}">
        <button type="submit">Cadastrar</button>
    </a> <br><br>

    <x-alert />

    @forelse ($classes as $classe)
        ID: {{ $classe->id }} <br>
        Nome: {{ $classe->name }} <br>
        Ordem: {{ $classe->order_classe }} <br>
        Descrição: {{ $classe->description }} <br>
        Curso: {{ $classe->course->name }} <br>
        Cadastrado: {{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
        Editado: {{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br><br>

        <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}">
            <button type="submit">Editar</button>
        </a><br><br>

        <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
        </form><br>
        
    @empty
    <p style="color: #f00">Nenhum aula encontrada!</p>
    @endforelse
@endsection
