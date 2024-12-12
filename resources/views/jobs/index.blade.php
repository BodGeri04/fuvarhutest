@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table>
            <thead>
                <tr>
                    <th> ID</th>
                    <th> Kezdő cím</th>
                    <th> Cél cím </th>
                    <th> Partner neve </th>
                    <th> Partner telefonszáma</th>
                    <th> Státusz </th>
                    <th> Vezető ID </th>
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
                        <td> {{ $job->status }} </td>
                        <td> {{ $job->driver_id }} </td>
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
