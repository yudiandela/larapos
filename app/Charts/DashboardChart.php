<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Product;
use App\Models\Sale;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class DashboardChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $now = now()->subDays(6);

        $days = [];
        $sales = [];
        for ($i = 0; $i <= 6; $i++) {
            $sales[] = (int) Sale::whereDate('created_at', $now->format('Y-m-d'))->sum('total');
            $days[]  = $now->translatedFormat('d F Y');
            $now->addDay();
        }

        return Chartisan::build()->labels($days)
            ->dataset('Penjualan', $sales);
    }
}
