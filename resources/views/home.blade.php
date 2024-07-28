@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4">Statistics</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Number of Countries: {{ $countriesCount }}</h2>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Number of Companies in Each Country</h2>
                <ul class="list-group">
                    @foreach($countries as $country)
                        <li class="list-group-item">{{ $country->name }}: {{ $country->companies->count() }} companies</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Total Mined Gold in Each Country</h2>
                <ul class="list-group">
                    @foreach($goldMined as $gold)
                        <li class="list-group-item">
                            {{ $gold->country_name }}: {{ $gold->total_weight }} kg
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Monthly Report</h2>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Year-Month</th>
                        <th>Country</th>
                        <th>Total Mined (kg)</th>
                        <th>plan (kg)</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monthlyReport as $year => $months)
                        @foreach($months as $month => $data)
                            @foreach($data as $report)
                                <tr>
                                    <td>{{ $year }}-{{ str_pad($month, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $report['country_name'] }}</td>
                                    <td>{{ $report['total_weight'] }}</td>
                                    <td>{{ $report['planned_gold_mining'] }}</td>
                                    <td>
                                        @if($report['achieved'])
                                            <span class="badge badge-success">Achieved</span>
                                        @else
                                            <span class="badge badge-danger">Not Achieved</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="card-title">Gold Mining Over Time</h2>
                <canvas id="goldMiningChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('goldMiningChart').getContext('2d');
            var chartData = @json($chartData);
            var labels = chartData.map(function(data) {
                return data.year_month;
            });
            var data = chartData.map(function(data) {
                return data.total_weight;
            });

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Mined Gold (kg)',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Year-Month'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Mined Gold (kg)'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
