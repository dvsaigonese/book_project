<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SatisticsController extends Controller
{
    public function index()
    {
        return view('admin.satistics.satistics');
    }

    public function revenueStatistics($option)
    {
        if ($option == '0') {
            $revenue = DB::table('orders')
                ->select(DB::raw('MONTH(created_at) AS x'), DB::raw('SUM(subtotal_price) AS y'))
                ->where('order_status', 3)
                ->whereYear('created_at', date("Y"))  // Laravel specific for year filtering
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();
        } else if ($option == '1') {
            $query = '
                    SELECT
                      CASE
                        WHEN MONTH(created_at) IN (1, 2, 3) THEN 1
                        WHEN MONTH(created_at) IN (4, 5, 6) THEN 2
                        WHEN MONTH(created_at) IN (7, 8, 9) THEN 3
                        ELSE 4
                      END AS x,
                      SUM(subtotal_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    AND YEAR(created_at) = YEAR(CURRENT_DATE())
                    GROUP BY x
                    ORDER BY x;
            ';
            $revenue = DB::select($query);
        } else if ($option == '2') {
            $query = '
                    SELECT
                      DATE(created_at) AS x,
                      SUM(subtotal_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    AND YEAR(created_at) = YEAR(CURRENT_DATE())
                    AND MONTH(created_at) = MONTH(CURRENT_DATE())
                    GROUP BY DATE(created_at)
                    ORDER BY x;
            ';
            $revenue = DB::select($query);
        } else if ($option == '3') {
            $query = '
                    SELECT
                      HOUR(created_at) AS x,
                      SUM(total_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    AND YEAR(created_at) = YEAR(CURRENT_DATE())
                    AND MONTH(created_at) = MONTH(CURRENT_DATE())
                    AND DAY(created_at) = DAY(CURRENT_DATE())
                    GROUP BY HOUR(created_at)
                    ORDER BY x;

            ';
            $revenue = DB::select($query);
        } else if ($option == '4') {
            $query = '
                    SELECT
                      YEAR(created_at) AS x,
                      SUM(subtotal_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    GROUP BY YEAR(created_at)
                    ORDER BY x;
            ';
            $revenue = DB::select($query);
        }

        return json_encode($revenue);
    }

    public function timeStatistics($option)
    {
        if ($option == 0) {
            $query = '
                    SELECT
                      MONTH(created_at) AS x,
                      SUM(subtotal_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    AND created_at BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] .
                '" GROUP BY MONTH(created_at)
                    ORDER BY x;
            ';
            $revenue = DB::select($query);
        } else if ($option == 1) {
            $query = '
                    SELECT
                      DATE(created_at) AS x,
                      SUM(subtotal_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    AND created_at BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] .
                '" GROUP BY DATE(created_at)
                    ORDER BY x;
            ';
            $revenue = DB::select($query);
        } else if ($option == 2) {
            $query = '
                    SELECT
                      HOUR(created_at) AS x,
                      SUM(subtotal_price) AS y
                    FROM orders
                    WHERE order_status = 3
                    AND created_at BETWEEN "' . $_GET["from"] . '" AND "' . $_GET["to"] .
            '" GROUP BY HOUR(created_at)
                    ORDER BY x;
            ';

            $revenue = DB::select($query);
        }


        return json_encode($revenue);
    }
}
