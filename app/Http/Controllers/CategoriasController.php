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
            'nombre' => 'required'
        ]);
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->user_id = auth()->user()->id;
        $categoria->save();
        return redirect('/dashboard');
    }

    public function edit(Categoria $categoria)
    {

        if (auth()->user()->id == $categoria->user_id)
        {
            return view('edit', compact('categoria'));
        }
        else {
            return redirect('/dashboard');
        }
    }

    public function update(Request $request, Categoria $categoria)
    {
        if(isset($_POST['delete'])) {
            $categoria->delete();
            return redirect('/dashboard');
        }
        else
        {
            $this->validate($request, [
                'nombre' => 'required'
            ]);
            $categoria->nombre = $request->nombre;
            $categoria->save();
            return redirect('/dashboard');
        }
    }
}
