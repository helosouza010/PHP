<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create_update');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|size:11',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'phone.required' => 'O campo Telefone é obrigatório.',
            'address.required' => 'O campo Endereço é obrigatório.',
        ]);

        $this->customerService->storeCustomer($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Cliente criado com sucesso.');
    }

    public function show(string $id)
    {
        return 'O id do cliente é: ' . $id;
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.create_update', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cpf' => 'required|size:11',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validated);

        return redirect()->route('customers.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Cliente excluído com sucesso.');
    }
}
