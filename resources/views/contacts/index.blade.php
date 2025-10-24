@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
<h3>Lista de Contatos</h3>
<a href="{{ route('contacts.create') }}" class="btn btn-success">Novo Contato</a>
</div>
@if($contacts->count())
<table class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Nome</th>
<th>Email</th>
<th>Ações</th>
</tr>
</thead>
<tbody>
    @foreach($contacts as $c)
<tr>
<td>{{ $c->id }}</td>
<td>{{ $c->name }}</td>
<td>{{ $c->email }}</td>
<td style="width:200px;">
<a href="{{ route('contacts.show', $c) }}" class="btn btn-sm btn-info">Ver</a>
<a href="{{ route('contacts.edit', $c) }}" class="btn btn-sm btn-warning">Editar</a>
<form action="{{ route('contacts.destroy', $c) }}" method="POST" style="display:inline" onsubmit="return confirm('Remover?')">
@csrf
@method('DELETE')
<button class="btn btn-sm btn-danger">Apagar</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>


{{ $contacts->links() }}


@else
<p>Nenhum contato encontrado.</p>
@endif
@endsection