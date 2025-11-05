@extends('layout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center rounded-top-4 py-3 px-4">
            <h5 class="mb-0">
                <i class="bi bi-tags me-2"></i>
                {{ isset($category) ? 'Editar Categoria' : 'Adicionar Categoria' }}
            </h5>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left-circle"></i> Voltar
            </a>
        </div>

        <div class="card-body bg-light px-4 py-4">
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif

                <!-- Nome -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold text-dark">
                        <i class="bi bi-tag me-1 text-primary"></i> Nome da Categoria
                    </label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Ex: Eletrônicos" value="{{ $category->name ?? '' }}" />
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success px-4 me-2">
                        <i class="bi bi-save2"></i> Salvar
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary px-3">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
