<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Página principal (listar todos)
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    // Formulário de criação
    public function create()
    {
        $categories = Category::all();
        return view('products.create_update', compact('categories'));
    }

    // Criar novo produto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'name.required'        => 'O campo Nome é obrigatório.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'price.required'       => 'O campo Preço é obrigatório.',
            'category_id.required' => 'Selecione uma categoria válida.',
        ]);

        $this->productService->storeProduct($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produto criado com sucesso.');
    }

    // Formulário de edição
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.create_update', compact('product', 'categories'));
    }

    // Atualizar produto
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produto atualizado com sucesso.');
    }

    // Excluir produto
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produto excluído com sucesso.');
    }

    // Exibir detalhes (opcional)
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
