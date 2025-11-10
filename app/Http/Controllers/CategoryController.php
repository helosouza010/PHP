<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // Página principal (listar todas)
    public function index()
    {
        $categories = Category::all();
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
        ]);

        // Uso do service
        $this->categoryService->storeCategory($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoria criada com sucesso.');
    }

    // Formulário de edição
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.create_update', compact('category'));
    }

    // Atualizar categoria existente
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoria atualizada com sucesso.');
    }

    // Excluir categoria
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoria excluída com sucesso.');
    }
}
