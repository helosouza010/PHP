<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>CRUD Contatos</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
<div class="container">
<a class="navbar-brand" href="{{ route('contacts.index') }}">Contatos</a>
</div>
</nav><div class="container">
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif


@yield('content')
</div>
</body>
</html>