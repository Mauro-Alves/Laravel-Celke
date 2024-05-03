@extends('layouts.admin')

@section('content')

       <h2>Detalhes do curso</h2>

    <a href="{{ route('courses.index') }}">Listar</a> <br>
    <a href="{{ route('courses.edit') }}">Editar</a> <br><br>

    
    ID: {{ $course->id}} <br>
    Nome: {{ $course->name}} <br>
    Cadastrado:  {{ \Carbon\Carbon::parse($course->created_at )->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
    Editado: {{ \Carbon\Carbon::parse($course->updated_at )->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>


@endsection