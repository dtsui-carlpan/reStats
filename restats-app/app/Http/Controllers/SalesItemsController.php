<?php

namespace App\Http\Controllers;

use DB;
use View;
use JavaScript;
use App\Month;
use App\SalesItem;
use App\Department;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class SalesItemsController extends Controller
{
    /**
     * Authentication protection.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Total revenue by months.
     *
     * @param $yearNum
     * @return array
     */
    private function getMonthlyTotalRevenue($year, $month) {
        $data = array();
        // get month array
        $months = DB::table('months')->where('id', '<=', $month)->lists('month', 'id');
        foreach ($months as $key => $value) {
            $match = ['year_id' => $year, 'month_id' => $key];
            $revenue = DB::table('sales_items')->where($match)->sum('revenue');
            $data[$value] = $revenue;
        }

        return $data;
    }

    /**
     * Total revenue by departments.
     *  (specify by month for real-time info)
     *
     * @param $yearNum
     * @return array
     */
    private function getDepartmentRevenue($year, $month) {
        $data = array();
        // get department array
        $departments = DB::table('departments')->lists('department', 'id');
        foreach ($departments as $key => $value) {
            $match = ['year_id' => $year, 'month_id' => $month, 'department_id' => $key];
            $revenue = DB::table('sales_items')->where($match)->sum('revenue');
            $data[$value] = $revenue;
        }

        return $data;
    }


    /**
     * Get an associative array of top $num items by sales
     * in current month.
     *
     * @param $year
     * @param $month
     * @param $num
     * @return mixed
     */
    private function getTopItemsByMonth($year, $month, $num) {
        // perform query and get array of top items
        $match = ['year_id' => $year, 'month_id' => $month];
        $top = DB::table('sales_items')->where($match)->orderBy('revenue', 'desc')
                                       ->take($num)->lists('revenue', 'name');

        return $top;
    }

    private function getTopItemsTilNow($year, $month, $num) {
        $match = ['year_id' => $year];
        $top = DB::table('sales_items')->where($match);

        return $top;
    }


    /**
     * Index page.
     *
     * @return $this
     */
    public function index() {
        // essentially everything later will be in real time
        // one solution is to extract year/month/week/day from timestamp()
        $year = 1; // current year
        $month = 7; // current month
        $num = 5; // temp number, user will enter this value

        // get revenue by month (this year)
        $monthSales = $this->getMonthlyTotalRevenue($year, $month);

        // get revenue by department (this month)
        $departmentSales = $this->getDepartmentRevenue($year, $month);

        // get top items in current month
        $topCurrentItems = $this->getTopItemsByMonth($year, $month, $num);

        $month_array = Month::where('id', '<=', $month)->lists('month');
        $depart_array = Department::all()->lists('department');

        // for javascript variable uses
        Javascript::put([
            'monthNames' => $month_array,
            'departNames' => $depart_array
        ]);

        return view('sales_items.index')
            ->with('topCurrentItems', $topCurrentItems)
            ->with('monthNames', json_encode($month_array))
            ->with('monthTotals', json_encode($monthSales))
            ->with('departNames', json_encode($depart_array))
            ->with('departTotals', json_encode($departmentSales));
    }

    public function show() {
        return view('sales_items.show');
    }


    public function detail() {
        $num = 5;
        $match = ['year_id' => 1, 'month_id' => 1, 'department_id' => 1];
        $results = DB::table('sales_items')->where($match)->orderBy('revenue', 'desc')->take($num);

        return view('sales_items.detail')->with('pairs', $results->lists('revenue', 'name'));
    }

}
