@extends('layouts/main')

@section('titulo_pagina', 'Registro de usuario')

@section('contenido')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 350px; background-color: white; border-radius: 10px;">
        <div class="text-center">
            <h2 class="mb-3">Crisol <i class="fas fa-sun" style="color: #ffc107;"></i></h2>
            <p class="text-muted">Regístrate para comenzar</p>
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

        <form action="{{ route('registrar') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                       name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control" required>
            </div>

            <button class="btn btn-warning w-100">Registrarse</button>
            <a href="{{ route('login') }}" class="btn btn-outline-dark w-100 mt-2">Iniciar sesión</a>
        </form>
    </div>
</div>
@endsection
