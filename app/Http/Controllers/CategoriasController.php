<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = auth()->user()->categorias();
        return view('dashboard', compact('categorias'));
    }
    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'description' => 'required'
        ]);
        $task = new Categoria();
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->save();
        return redirect('/dashboard');
    }

    public function edit(Categoria $task)
    {

        if (auth()->user()->id == $task->user_id)
        {
            return view('edit', compact('task'));
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, Categoria $task)
    {
        if(isset($_POST['delete'])) {
            $task->delete();
            return redirect('/dashboard');
        }
        else
        {
            $this->validate($request, [
                'description' => 'required'
            ]);
            $task->description = $request->description;
            $task->save();
            return redirect('/dashboard');
        }
    }
}
