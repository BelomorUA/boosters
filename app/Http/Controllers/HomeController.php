<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Company;
use App\Models\GoldMining;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $countriesCount = Country::count();

        $countries = Country::with('companies')->get();

        $goldMined = GoldMining::join('companies', 'gold_minings.company_id', '=', 'companies.id')
            ->join('countries', 'companies.country_id', '=', 'countries.id')
            ->select('countries.id as country_id', 'countries.name as country_name', \DB::raw('SUM(gold_minings.weight) as total_weight'))
            ->groupBy('countries.id', 'countries.name')
            ->get();

        $monthlyReport = $this->getMonthlyReport();

        $chartData = $this->getChartData();

        return view('home', compact('countriesCount', 'countries', 'goldMined', 'monthlyReport', 'chartData'));
    }

    private function getMonthlyReport()
    {
        $months = range(1, 12);
        $year = 2024;
        $report = [];

        foreach ($months as $month) {
            $startDate = Carbon::create($year, $month, 1);
            $endDate = $startDate->copy()->endOfMonth();

            $monthlyData = GoldMining::join('companies', 'gold_minings.company_id', '=', 'companies.id')
                ->join('countries', 'companies.country_id', '=', 'countries.id')
                ->select('countries.id as country_id', 'countries.name as country_name', \DB::raw('SUM(gold_minings.weight) as total_weight'), 'countries.planned_gold_mining')
                ->whereBetween('gold_minings.date_time', [$startDate, $endDate])
                ->groupBy('countries.id', 'countries.name', 'countries.planned_gold_mining')
                ->get();

            foreach ($monthlyData as $data) {
                $report[$year][$month][$data->country_id] = [
                    'country_name' => $data->country_name,
                    'total_weight' => $data->total_weight,
                    'planned_gold_mining' => $data->planned_gold_mining,
                    'achieved' => $data->total_weight >= $data->planned_gold_mining
                ];
            }
        }

        return $report;
    }

    private function getChartData()
    {
        $goldMiningData = GoldMining::join('companies', 'gold_minings.company_id', '=', 'companies.id')
            ->join('countries', 'companies.country_id', '=', 'countries.id')
            ->select(\DB::raw('YEAR(gold_minings.date_time) as year'), \DB::raw('MONTH(gold_minings.date_time) as month'), \DB::raw('SUM(gold_minings.weight) as total_weight'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $chartData = [];

        foreach ($goldMiningData as $data) {
            $chartData[] = [
                'year_month' => $data->year . '-' . str_pad($data->month, 2, '0', STR_PAD_LEFT),
                'total_weight' => $data->total_weight,
            ];
        }

        return $chartData;
    }
}
