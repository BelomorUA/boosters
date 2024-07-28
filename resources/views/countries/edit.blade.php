@extends('layouts.app')

@section('content')
    <h1>{{ isset($country) ? 'Edit Country' : 'Add Country' }}</h1>
    <form action="{{ isset($country) ? route('countries.update', $country) : route('countries.store') }}" method="POST">
        @csrf
        @if(isset($country))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $country->name ?? old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="planned_gold_mining">Planned Gold Mining (in T)</label>
            <input type="number" step="0.01" name="planned_gold_mining" id="planned_gold_mining" class="form-control" value="{{ $country->planned_gold_mining ?? old('planned_gold_mining') }}" required>
        </div>
        <button type="submit" class="btn btn-success">{{ isset($country) ? 'Update' : 'Add' }}</button>
    </form>
@endsection
