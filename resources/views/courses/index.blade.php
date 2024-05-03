@extends('layouts.admin')

@section('content')

    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}">Cadastrar</a> <br><br>

    {{-- Imprimir os registros --}}
    @forelse ($courses as $course)

    {{ $course->id }} <br>
    {{ $course->name }} <br>
    {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
    {{ \Carbon\Carbon::parse($course->updated_at )->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>

    <a href="{{ route('courses.show', ['course' => $course->id ]) }}">Visualizar</a>
    
    <hr>
    
    @empty
        <p style="color: #f00">Nenhum curso encontrado!</p>
    @endforelse

    {{-- Imprimir paginação --}}
    {{-- {{ $courses->links() }} --}}

@endsection



