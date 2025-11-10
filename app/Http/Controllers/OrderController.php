<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Services\OrderService;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderService;
    
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::with('customer', 'items.product')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Customer::all();
        $products = Product::all();
        return view('orders.create_update', compact('clients', 'products'));
    }

    public function store(StoreOrderRequest $request)
    {
        try {
            $this->orderService->storeOrder($request->validated());
            return redirect()->route('orders.index')
                ->with('success', 'Pedido criado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Erro ao criar pedido: ' . $e->getMessage()]);
        }
    }

    public function edit(string $id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        $clients = Customer::all();
        $products = Product::all();
        return view('orders.create_update', compact('order', 'clients', 'products'));
    }

    public function update(UpdateOrderRequest $request, string $id)
    {
        $order = Order::findOrFail($id);
        try {
            $this->orderService->updateOrder($order, $request->validated());
            return redirect()->route('orders.index')
                ->with('success', 'Pedido atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()
                ->withErrors(['error' => 'Erro ao atualizar pedido: ' . $e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        Order::findOrFail($id)->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Pedido deletado com sucesso!');
    }

    public function show(string $id)
    {
        return 'Detalhes do pedido: ' . $id;
    }
}
