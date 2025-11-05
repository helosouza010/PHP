<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Página principal (listar todas)
    public function index()
    {
        $categories = Category::get();
        return view('categories.index', compact('categories'));
    }

    // Formulário de criação
    public function create()
    {
        return view('categories.create_update');
    }

    // Criar nova categoria
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    // Formulário de edição
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.create_update', compact('category'));
    }

    // Atualizar categoria existente
    public function update(Request $request, string $id)
    {
        Category::find($id)->update($request->all());
        return redirect()->route('categories.index');
    }

    // Excluir categoria
    public function destroy(string $id)
    {
        Category::find($id)->delete();
        return redirect()->route('categories.index');
    }
}
