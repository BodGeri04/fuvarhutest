@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Munka Státuszának Módosítása</h1>
    <form method="POST" action="{{ route('drivers.update', $job->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="status" class="form-label">Státusz</label>
            <select name="status" class="form-control" required>
                <option value="assigned" {{ $job->status === 'assigned' ? 'selected' : '' }}>Kiosztva</option>
                <option value="in progress" {{ $job->status === 'in_progress' ? 'selected' : '' }}>Folyamatban</option>
                <option value="completed" {{ $job->status === 'completed' ? 'selected' : '' }}>Elvégezve</option>
                <option value="failed" {{ $job->status === 'failed' ? 'selected' : '' }}>Sikertelen</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Státusz Módosítása</button>
    </form>
</div>
@endsection