@extends('layouts.admin')

@section('content')
    <h2>Listar os Cursos</h2>

    <a href="{{ route('courses.create') }}">
        <button type="submit">Cadastrar</button></a> <br>
    </a> <br><br>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    {{-- Imprimir os registros --}}
    @forelse ($courses as $course)
        {{ $course->id }} <br>
        {{ $course->name }} <br>
        {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
        {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br><br>

        <a href="{{ route('courses.show', ['course' => $course->id]) }}">
            <button type="submit">Visualizar</button>
        </a><br><br>
        <a href="{{ route('courses.edit', ['course' => $course->id]) }}">
            <button type="submit">Editar</button>
        </a><br><br>

        <form action="{{ route('courses.destroy', ['course' => $course->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>

        </form>

        <hr>

    @empty
        <p style="color: #f00">Nenhum curso encontrado!</p>
    @endforelse

    {{-- Imprimir paginação --}}
    {{-- {{ $courses->links() }} --}}
@endsection
