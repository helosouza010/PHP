<?php


namespace App\Http\Controllers;


use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller
{
public function index(){
$contacts = Contact::orderBy('id','desc')->paginate(10);
return view('contacts.index', compact('contacts'));
}


public function create()
{
return view('contacts.create');
}


public function store(Request $request)
{
$data = $request->validate([
'name' => 'required|string|max:255',
'email' => 'required|email|unique:contacts,email',
]);


Contact::create($data);


return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso.');
}
public function show(Contact $contact)
{
return view('contacts.show', compact('contact'));
}


public function edit(Contact $contact)
{
return view('contacts.edit', compact('contact'));
}
public function update(Request $request, Contact $contact)
{
$data = $request->validate([
'name' => 'required|string|max:255',
'email' => 'required|email|unique:contacts,email,'.$contact->id,
]);


$contact->update($data);


return redirect()->route('contacts.index')->with('success', 'Contato atualizado.');
}public function destroy(Contact $contact)
{
$contact->delete();
return redirect()->route('contacts.index')->with('success', 'Contato removido.');
}
}