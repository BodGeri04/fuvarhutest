@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Új Fuvarozó Létrehozása</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('drivers.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Név</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="is_admin" class="form-label">Admin?</label>
            <select name="is_admin" class="form-control @error('is_admin') is-invalid @enderror" required>
                <option value='0' {{ old('is_admin') == 0 ? 'selected' : '' }}>Nem</option>
                <option value='1' {{ old('is_admin') == 1 ? 'selected' : '' }}>Igen</option>
            </select>
            @error('is_admin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Fuvarozó Létrehozása</button>
        <a type="button" href="{{ url()->previous() }}" class="btn btn-secondary">Vissza</a>
    </form>
</div>
@endsection
