@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Új Munka Létrehozása</h1>

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

        <form method="POST" action="{{ route('jobs.store') }}">
            @csrf
            <div class="mb-3">
                <label for="starting_address" class="form-label">Kezdő Cím</label>
                <input type="text" class="form-control @error('starting_address') is-invalid @enderror"
                    id="starting_address" name="starting_address" required>
                @error('starting_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="destination_address" class="form-label">Cél Cím</label>
                <input type="text" class="form-control @error('destination_address') is-invalid @enderror" id="destination_address" name="destination_address" required>
                @error('destination_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="recipient_name" class="form-label">Címzett Neve</label>
                <input type="text" class="form-control @error('recipient_name') is-invalid @enderror" id="recipient_name" name="recipient_name" required>
                @error('recipient_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="recipient_phone" class="form-label">Címzett Telefonszáma</label>
                <input type="text" class="form-control @error('recipient_phone') is-invalid @enderror" id="recipient_phone" name="recipient_phone" required>
                @error('recipient_phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="driver_id" class="form-label">Sofőr</label>
                <select name="driver_id" id="driver_id" class="form-control @error('driver_id') is-invalid @enderror" required>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }} ||| {{ $driver->email }}</option>
                    @endforeach
                </select>
                @error('driver_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Munka Létrehozása</button>
        </form>
    </div>
@endsection
