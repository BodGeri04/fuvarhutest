@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Munkáim</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Kezdő cím</th>
                <th>Cél cím</th>
                <th>Címzett Neve</th>
                <th>Címzett Telefonszáma</th>
                <th>Státusz</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->starting_address }}</td>
                    <td>{{ $job->destination_address }}</td>
                    <td>{{ $job->recipient_name }}</td>
                    <td>{{ $job->recipient_phone }}</td>
                    <td>{{ $job->status }}</td>
                    <td>
                        <a href="{{ route('drivers.edit', $job->id) }}" class="btn btn-primary">Módosítás</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection