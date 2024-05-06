@extends('layouts.admin')

@section('content')

 <h2>Editar o Curso</h2>

 <a href="{{ route('courses.index') }}">Listar</a> <br>
 <a href="{{ route('courses.show', ['course' => $course->id]) }}">Visualizar</a> <br><br>

 <form action="{{ route('courses.update', ['course' => $course->id ]) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="Nome: "></label>
    <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" placeholder="Nome do curso" required><br><br>

    <button type="submit">Salvar</button>

 </form>

@endsection

