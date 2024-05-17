<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClasseRequest;
use App\Models\Classe;
use App\Models\Course;
use Exception;
use Illuminate\Support\Facades\DB;

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

        // Marcar ponto inicial de uma transação

        DB::beginTransaction();
        // Validar o formulário

        try {

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

            // Operação concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $request->course_id])->with('success', 'Aula cadastrada com sucesso!');
        } catch (Exception $e) {

            // Operação não concluída com êxito
            DB::rollBack();

            //Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Aula não cadastrada!');
        }
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

        // Marcar ponto inicial de uma transação
        DB::beginTransaction();

        // Validar o formulário
        try {

            // Editar as informações do registro no banco de dados
            $classe->update([
                "name" => $request->name,
                'description' => $request->description,
            ]);

            // Operação concluída com êxito
            DB::commit();

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula editada com sucesso!');
        } catch (Exception $e) {

            // Operação não concluída com êxito
            DB::rollBack();

            //Redirecionar o usuário, enviar a mensagem de erro
            return redirect()->back()->with('error', 'Aula não editada!');
        }
    }

    public function destroy(Classe $classe)
    {
        try {
            // Excluir o registro do banco de dados
            $classe->delete();

            //Redirecionar o usiário, enviar a mensagem de sucesso
            return redirect()->route('classe.index', ['course' => $classe->course_id])->with('success', 'Aula apagada com sucesso!');
        } catch (Exception $e) {

            // Re4direcionar o usuário, enviar a mensagem de erro
            return redirect()->route('classe.index')->with('error', 'Aula não apagada!');
        }
    }
}
