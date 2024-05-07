@extends('layouts.admin')

@section('content')
    <h2>Listar os Cursos</h2>

    <a href="{{ route('course.create') }}">
        <button type="submit">Cadastrar</button></a> <br>
    </a> <br><br>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    {{-- Imprimir os registros --}}
    @forelse ($courses as $course)
        ID: {{ $course->id }} <br>
        Nome: {{ $course->name }} <br>
        Preço: {{ 'R$ ' . number_format($course->price, 2, ',' , '.') }} <br>
        Cadastrado: {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br>
        Editado: {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/y H:i:s') }} <br><br>

        <a href="{{ route('classe.index', ['course' => $course->id]) }}">
            <button type="submit">Aulas</button>
        </a><br><br>

        <a href="{{ route('course.show', ['course' => $course->id]) }}">
            <button type="submit">Visualizar</button>
        </a><br><br>

        <a href="{{ route('course.edit', ['course' => $course->id]) }}">
            <button type="submit">Editar</button>
        </a><br><br>

        <form action="{{ route('course.destroy', ['course' => $course->id]) }}" method="POST">
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
