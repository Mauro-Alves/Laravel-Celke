<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    //Listar os cursos
    public function index()
    {

        // Recuperar os registros do banco de dados
        // $courses = Course::where('id', 1000)->get();
        // $courses = Course::paginate(10);
        $courses = Course::orderBy('name', 'ASC')
        
        ->paginate(10);


        // Salvar log
        Log::info('Listar cursos.');

        // Carregar a VIEW
        return  view('courses.index', ['menu' => 'courses', 'courses' => $courses]);
    }

    //Visualizar o curso
    public function show(Course $course)
    {
        //$course = Course::where('id', $request->course)->first();

        // Salvar log
        Log::info('Visualizar o curso.', ['course_id' => $course->id]);

        // Carregar a VIEW
        return  view('courses.show', ['menu' => 'courses', 'course' => $course]);
    }

    //Carregar o formulário cadastrar novo curso
    public function create()
    {

        // Carregar a VIEW
        return  view('courses.create', ['menu' => 'courses']);
    }

    //Cadastrar no banco de dados o novo curso
    public function store(CourseRequest $request)
    {

        // Validar o formulário
        $request->validated();


        // Marcar ponto inicial de uma transação
        DB::beginTransaction();

        try {
            // Cadastrar no banco de dados na tabela cursos
            // os valores de todos os campos

            $course = Course::create([
                'name' => $request->name,
                'price' => str_replace(',', '.', str_replace('.', '', $request->price)),
            ]);


            // Operação concluída com êxito
            DB::commit();

            // Salvar log
            Log::info('Curso cadastrado com sucesso!', ['course_id' => $course->id]);

            //Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
        } catch (Exception $e) {

            // Operação não concluída com êxito
            DB::rollBack();

            // Salvar log
            Log::notice('Curso não cadastrado!', ['error' => $course->$e->getMessage()]);

            //Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Curso não cadastrado!');
        }
    }

    //Carregar o formulário editar curso
    public function edit(Course $course)
    {


        // Carregar a VIEW
        return  view('courses.edit', ['menu' => 'courses', 'course' => $course]);
    }

    //Editar no banco de dados o curso
    public function update(CourseRequest $request, Course $course)
    {

        // Marcar ponto inicial de uma transação

        DB::beginTransaction();
        // Validar o formulário

        try {

            $request->validated();

            //Editar as informações do registro no banco de dados

            $course->update([
                'name' => $request->name,
                'price' => str_replace(',', '.', str_replace('.', '', $request->price)),
            ]);

            // Operação concluída com êxito
            DB::commit();

            // Salvar log
            Log::info('Curso editado com sucesso!', ['course_id' => $course->id]);


            // Rediecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('course.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
        } catch (Exception $e) {

            // Operação não concluída com êxito
            DB::rollBack();

            // Salvar log
            Log::notice('Curso não editado!', ['error' => $e->getMessage()]);


            //Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Curso não editado!');
        }
    }

    //Excluir o curso do banco de dados
    public function destroy(Course $course)
    {

        try {

            // Excluir o registro do banco de dados

            $course->delete();

            // Salvar log
            Log::info('Curso apagado com sucesso!', ['course_id' => $course->id]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('course.index')->with('success', 'Curso excluído com sucesso!');
        } catch (Exception $e) {

            // Salvar log
            Log::notice('Curso não apagado!', ['error' => $e->getMessage()]);

            // Re4direcionar o usuário, enviar a mensagem de erro
            return redirect()->route('course.index')->with('error', 'Curso não excluído!');
        }
    }
}
