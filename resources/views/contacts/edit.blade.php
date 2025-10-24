@extends('layouts.app')


@section('content')
<h3>Editar Contato</h3><form action="{{ route('contacts.update', $contact) }}" method="POST">
@csrf
@method('PUT')
<div class="mb-3">
<label class="form-label">Nome</label>
<input type="text" name="name" class="form-control" value="{{ old('name', $contact->name) }}">
@error('name')<div class="text-danger">{{ $message }}</div>@enderror
</div><div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}">
@error('email')<div class="text-danger">{{ $message }}</div>@enderror
</div>
<button class="btn btn-primary">Atualizar</button>
<a href="{{ route('contacts.index') }}" class="btn btn-secondary">Voltar</a>
</form>
@endsection