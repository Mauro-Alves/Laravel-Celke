<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    //Listar os cursos
    public function index(){

        // Recuperar os registros do banco de dados
        // $courses = Course::where('id', 1000)->get();
        //$courses = Course::paginate(10);
        $courses = Course::orderBy('name', 'ASC')->get();

        // Carregar a VIEW
        return  view('courses.index', ['courses' => $courses]);
    }

    //Visualizar o curso
    public function show(Course $course){



        //$course = Course::where('id', $request->course)->first();

        // Carregar a VIEW
        return  view('courses.show',['course' => $course]);
    }
    
    //Carregar o formulário cadastrar novo curso
    public function create(){

        // Carregar a VIEW
        return  view('courses.create');
    }
    
    //Cadastrar no banco de dados o novo curso
    public function store(Request $request){
        
        // Cadastrar no banco de dados na tabela cursos
        // os valores de todos os campos

        // dd($request->name);
        $course = Course::create([
            'name' => $request->name
        ]);

        //Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso cadastrado com sucesso!');
    }
    
    //Carregar o formulário editar curso
    public function edit(Course $course){
        
        
        // Carregar a VIEW
        return  view('courses.edit', ['course' => $course]);
    }
    
    //Editar no banco de dados o curso
    public function update(Request $request, Course $course){

        //Editar as informações do registro no banco de dados

        $course->update([
            'name' => $request->name
        ]);
        
        // Rediecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('courses.show', ['course' => $course->id])->with('success', 'Curso editado com sucesso!');
    }
    
    //Excluir o curso do banco de dados
    public function destroy(){
        
        dd('Excluir o curso do banco de dados');
    }
    
}
