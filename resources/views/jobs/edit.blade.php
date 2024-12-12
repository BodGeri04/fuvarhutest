@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('jobs.update', $job->id) }}">
            @csrf
            @method('PUT')
            <h1>{{ $job->id }}. sorszámú munka szerkesztése</h1>

            <!-- Kiindulási cím -->
            <div class="form-group">
                <label for="starting_address">Kiindulási cím</label>
                <input type="text" name="starting_address" id="starting_address" class="form-control"
                    value="{{ $job->starting_address }}" required>
            </div>

            <!-- Érkezési cím -->
            <div class="form-group">
                <label for="destination_address">Érkezési cím</label>
                <input type="text" name="destination_address" id="destination_address" class="form-control"
                    value="{{ $job->destination_address }}" required>
            </div>

            <!-- Címzett neve -->
            <div class="form-group">
                <label for="recipient_name">Címzett neve</label>
                <input type="text" name="recipient_name" id="recipient_name" class="form-control"
                    value="{{ $job->recipient_name }}" required>
            </div>

            <!-- Címzett telefonszáma -->
            <div class="form-group">
                <label for="recipient_phone">Címzett telefonszáma</label>
                <input type="text" name="recipient_phone" id="recipient_phone" class="form-control"
                    value="{{ $job->recipient_phone }}" required>
            </div>

            <!-- Fuvarozó kiválasztása -->
            <div class="form-group">
                <label for="driver_id">Fuvarozó</label>
                <select name="driver_id" id="driver_id" class="form-control">
                    <option value="">Nincs hozzárendelve</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ $job->driver_id == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <br>
            <!-- Mentés -->
            <button type="submit" class="btn btn-primary">Mentés</button>
            <a type="button" href="{{ url()->previous() }}" class="btn btn-secondary">Vissza</a>
        </form>
    </div>
@endsection
