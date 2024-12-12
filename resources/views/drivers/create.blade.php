@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Új Fuvarozó Létrehozása</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('drivers.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Név</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Admin?</label>
            <select required name="is_admin" data-plugin-selectOne class="form-control populate">
                <option value='1'>
                    Igen
                </option>
                <option value='0'>
                    Nem
                </option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Fuvarozó Létrehozása</button>
    </form>
</div>
@endsection