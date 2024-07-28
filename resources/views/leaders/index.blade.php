@extends('layouts.app')

@section('content')
    <h1>Leaders</h1>
    <form action="{{ url('show-report') }}" method="POST">
        @csrf
        <label for="month">Select month:</label>
        <input type="month" id="month" name="month" value="{{ isset($month) ? $month->format('Y-m') : '' }}" required>
        <button type="submit">Show report</button>
    </form>
    <form action="{{ route('generateData') }}" method="POST" class="mb-3">
        @csrf
        <button type="submit" class="btn btn-secondary">Generate Data</button>
    </form>

    @isset($countries)
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Country</th>
                <th>Total Mined</th>
                <th>Planned</th>
            </tr>
            </thead>
            <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->companies->sum(function ($company) { return $company->goldMinings->sum('weight'); }) }} T</td>
                    <td>{{ $country->planned_gold_mining }} T</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endisset
@endsection
