@extends('layouts.app')


@section('content')
<h3>Detalhes do Contato</h3>


<div class="card">
<div class="card-body">
<p><strong>Nome:</strong> {{ $contact->name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Criado em:</strong> {{ $contact->created_at }}</p>
</div>
</div>


<a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection