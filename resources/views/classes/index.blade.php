@extends('layouts.admin')

@section('content')

    <h2>Listar as Aulas</h2>

    <a href="{{ route('course.index') }}">
        <button type="submit">Cursos</button></a> <br>
    </a> <br><br>

    {{-- <x-alert /> --}}

    @forelse ($classes as $classe)
        ID: {{ $classe->id }} <br>
        Nome: {{ $classe->name }} <br>
        Ordem: {{ $classe->order_classe }} <br>
        Descrição: {{ $classe->description }} <br>
        Curso: {{ $classe->course->name }} <br>
        Cadastrado: {{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
        Editado: {{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br><br>
        
    @empty
    <p style="color: #f00">Nenhum aula encontrada!</p>
    @endforelse
@endsection
