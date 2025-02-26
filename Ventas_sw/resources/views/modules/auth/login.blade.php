@extends('layouts/main')

@section('titulo_pagina', 'Login de usuario')

@section('contenido')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 350px; background-color: white; border-radius: 10px;">
        <div class="text-center">
            <h2 class="mb-3">Crisol <i class="fa-solid fa-sun" style="color: #ffc107; font-size: 1.2em;"></i></h2>
            <p class="text-muted">Inicia sesión para continuar</p>
        </div>

        <!-- Mensajes de éxito o error -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('logear') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-warning w-100">Entrar</button>
            <a href="{{ route('registro') }}" class="btn btn-outline-dark w-100 mt-2">Regístrate aquí</a>
        </form>
    </div>
</div>
@endsection
