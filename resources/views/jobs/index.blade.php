@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Munkák</h1>
        <form method="GET" action="{{ route('jobs.index') }}">
            <div class="mb-3">
                <label for="status" class="form-label">Szűrés státusz szerint</label>
                <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Minden státusz --</option>
                    <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Kiosztva</option>
                    <option value="in progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Folyamatban
                    </option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Elvégezve</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Sikertelen</option>
                </select>
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th> ID</th>
                    <th> Kezdő cím</th>
                    <th> Cél cím </th>
                    <th> Címzett neve </th>
                    <th> Címzett telefonszáma</th>
                    <th> Státusz </th>
                    <th> Vezető Név </th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td> {{ $job->id }} </td>
                        <td> {{ $job->starting_address }} </td>
                        <td> {{ $job->destination_address }} </td>
                        <td> {{ $job->recipient_name }} </td>
                        <td> {{ $job->recipient_phone }} </td>
                        @if ($job->status == 'Completed')
                            <td style="color: green">{{ $job->status }}</td>
                        @elseif($job->status == 'Failed')
                            <td style="color: red">{{ $job->status }}</td>
                        @else
                            <td style="color: orange">{{ $job->status }}</td>
                        @endif
                        <td>{{ optional($job->driver)->name ?? 'Nincs hozzárendelve' }}</td>
                        <td>
                            <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-primary">Módosítás</a>
                        </td>
                        <td>
                            <!-- Törlés gomb, ami pop-upot nyit -->
                            <form action="{{ route('jobs.destroy', $job->id) }}" method="POST"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('/jobs/create') }}" class="btn btn-xs btn-success pull-right">Új hozzáadása</a>
    </div>
    <script>
        // Pop-up megerősítés a törlés előtt
        function confirmDelete() {
            return confirm("Biztosan törölni szeretnéd ezt a munkát?");
        }
    </script>
@endsection
