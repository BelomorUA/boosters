@extends('layouts.app')

@section('content')
    <h1>{{ isset($company) ? 'Edit Company' : 'Add Company' }}</h1>
    <form action="{{ isset($company) ? route('companies.update', $company) : route('companies.store') }}" method="POST">
        @csrf
        @if(isset($company))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $company->name ?? old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $company->email ?? old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="country_id">Country</label>
            <select name="country_id" id="country_id" class="form-control" required>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ (isset($company) && $company->country_id == $country->id) ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">{{ isset($company) ? 'Update' : 'Add' }}</button>
    </form>
@endsection
