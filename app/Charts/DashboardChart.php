<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
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
        $now = now()->subDays(29);

        $days = [];
        $sales = [];
        $saleByProducts = [];

        $products = Product::get();
        for ($i = 0; $i <= 29; $i++) {
            $sales[] = (int) Sale::whereDate('created_at', $now->format('Y-m-d'))->sum('total');
            foreach ($products as $product) {
                $saleByProducts[$i][$product->slug] = (int) SaleProduct::where('product_id', $product->id)->whereDate('created_at', $now->format('Y-m-d'))->sum('total_price');
            }
            $days[]  = $now->translatedFormat('d F');
            $now->addDay();
        }

        $chart = Chartisan::build()->labels($days)
            ->dataset('Penjualan', $sales);

        foreach ($products as $value) {
            $chart->dataset($value->name, collect($saleByProducts)->pluck($value->slug)->toArray());
        }

        return $chart;
    }
}
