@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Új Munka Létrehozása</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('jobs.store') }}">
        @csrf
        <div class="mb-3">
            <label for="starting_address" class="form-label">Kezdő Cím</label>
            <input type="text" class="form-control" id="starting_address" name="starting_address" required>
        </div>

        <div class="mb-3">
            <label for="destination_address" class="form-label">Cél Cím</label>
            <input type="text" class="form-control" id="destination_address" name="destination_address" required>
        </div>

        <div class="mb-3">
            <label for="recipient_name" class="form-label">Címzett Neve</label>
            <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
        </div>

        <div class="mb-3">
            <label for="recipient_phone" class="form-label">Címzett Telefonszáma</label>
            <input type="text" class="form-control" id="recipient_phone" name="recipient_phone" required>
        </div>

        <div class="mb-3">
            <label for="driver_id" class="form-label">Sofőr</label>
            <select name="driver_id" id="driver_id" class="form-control" required>
                @foreach($drivers as $driver)
                <option value="{{$driver->id}}">{{$driver->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Munka Létrehozása</button>
    </form>
</div>
@endsection
