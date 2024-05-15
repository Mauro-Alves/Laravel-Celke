<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;

class ClasseController extends Controller
{
     // Listar as aulas
    public function index(Course $course)
    {
        // Recuperar as aulas do banco de dados
        $classes = Classe::with('course')
            ->where('course_id', $course->id)
            ->orderBy('order_classe')
            ->get();

        // Carregar a VIEW
        return view('classes.index', ['course' => $course, 'classes' => $classes]);
    }

    // Detalhes da aula
    public function show(Classe $classe)
    {
        // Carregar a VIEW
        return view('classes.show', ['classe' => $classe]);
    }

     // Carregar o formulário cadastrar nova aula
    public function create(Course $course)
    {
        //Carregar a VIEW
        return view('classes.create', ['course' => $course]);
    }

    // Cadastrar no banco de dados a nova aula
    public function store(ClasseRequest $request)
    {
        // Validar formulário

        $request->validated();

        //Recuperar a última ordem da aula no curso
        $lastOrderClasse = Classe::where('course_id', $request->course_id)
            ->orderBy('order_classe', 'DESC')
            ->first();

        // Cadastrar no banco de dados na tabela aulas
        Classe::create([
            "name" => $request->name,
            'description' => $request->description,
            'order_classe' => $lastOrderClasse ? $lastOrderClasse->order_classe + 1 : 1,
            'course_id' => $request->course_id,
        ]);

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrada com sucesso!');
    }

    public function edit(Classe $classe)
    {
        // Carregar a VIEW
        return view('classes.edit', ['classe' => $classe]);
    }

    public function update(ClasseRequest $request, Classe $classe)
    {
        // Validar o formulário
        $request->validated();

        // Editar as informações do registro no banco de dados
        $classe->update([
            "name" => $request->name,
            'description' => $request->description,
        ]);

        // Redirecionar o usuário, enviar a mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com sucesso!');
    }

    public function destroy(Classe $classe)
    {
try{
        // Excluir o registro do banco de dados
        $classe->delete();

        //Redirecionar o usiário, enviar a mensagem de sucesso
        return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula apagada com sucesso!');
     
    }  catch(Exception $e) {

            // Re4direcionar o usuário, enviar a mensagem de erro
            return redirect()->route('classe.index')->with('error', 'Aula não apagada!');
      }
    }
}
