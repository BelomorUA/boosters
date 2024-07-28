@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Countries</h1>
        <a href="{{ route('countries.create') }}" class="btn btn-primary">Add Country</a>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Name</th>
            <th>Planned Gold Mining</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($countries as $country)
            <tr>
                <td>{{ $country->name }}</td>
                <td>{{ $country->planned_gold_mining }}</td>
                <td>
                    <a href="{{ route('countries.edit', $country) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('countries.destroy', $country) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
