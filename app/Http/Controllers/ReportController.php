<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Company;
use App\Models\GoldMining;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function leaders(Request $request)
    {
        return view('leaders.index');
    }

    public function generateData()
    {
        $companies = Company::all();

        foreach ($companies as $company) {
            for ($i = 0; $i < 180; $i++) {
                GoldMining::create([
                    'company_id' => $company->id,
                    'date_time' => Carbon::now()->subDays($i),
                    'weight' => rand(100, 250000) / 1000,
                ]);
            }
        }

        return redirect()->route('leaders.index');
    }

    public function showReport(Request $request)
    {
        $month = Carbon::parse($request->month);
        $countries = Country::with(['companies.goldMinings' => function ($query) use ($month) {
            $query->whereYear('date_time', $month->year)->whereMonth('date_time', $month->month);
        }])->get();

        $countries = $countries->filter(function ($country) {
            $totalMined = $country->companies->sum(function ($company) {
                return $company->goldMinings->sum('weight');
            });

            return $totalMined > $country->planned_gold_mining;
        });

        return view('leaders.index', compact('countries', 'month'));
    }
}
