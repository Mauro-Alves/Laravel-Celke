@extends('layouts.admin')

@section('content')

 <h2>Editar o Curso</h2>

 <a href="{{ route('course.index') }}">
   <button type="submit">Listar</button></a> <br>
</a> <br>

 <a href="{{ route('course.show', ['course' => $course->id]) }}">
   <button type="submit">Visualizar</button></a> <br>
</a> <br><br>

@if ($errors->any())
<span style="color:#f00">
    @foreach ($errors->all() as $error)
     {{ $error }} <br>
    @endforeach
    <br>
</span>
@endif

 <form action="{{ route('course.update', ['course' => $course->id ]) }}" method="POST">
    @csrf
    @method('PUT')

    <label> Nome: </label>
    <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" placeholder="Nome do curso" ><br><br>

    <label> Preço: </label>
    <input type="text" name="price" id="price" value="{{ old('price', $course->price) }}" placeholder="Preço do curso: 2.47" ><br><br>

    <button type="submit">Salvar</button>

 </form>

@endsection

