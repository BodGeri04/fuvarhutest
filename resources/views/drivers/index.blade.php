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
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->starting_address }}</td>
                        <td>{{ $job->destination_address }}</td>
                        <td>{{ $job->recipient_name }}</td>
                        <td>{{ $job->recipient_phone }}</td>
                        @if ($job->status == 'Completed')
                            <td style="color: green">{{ $job->status }}</td>
                        @elseif($job->status == 'Failed')
                            <td style="color: red">{{ $job->status }}</td>
                        @else
                            <td style="color: orange">{{ $job->status }}</td>
                        @endif
                        <td>
                            <a href="{{ route('drivers.edit', $job->id) }}" class="btn btn-primary">Módosítás</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @empty($job)
                <tbody>
                    <td class="text-center">Jelenleg nincs munkád.

                    </td>
                </tbody>
            @endempty
        </table>
    </div>
@endsection
