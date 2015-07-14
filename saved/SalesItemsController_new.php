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
     * Returns a nested array for each department for every month.
     * (Should be cached instead of loading every time)
     *
     * @param $yearNum
     * @return array
     */
    private function getDepartmentSaleByMonth($year) {
        $data = array();
        // get month array
        $months = DB::table('months')->lists('month', 'id');
        // get department array
        $departments = DB::table('departments')->lists('department', 'id');
        foreach ($departments as $d => $department) {
            foreach ($months as $m => $month) {
                $match = ['year_id' => $year, 'department_id' => $d, 'month_id' => $m];
                $revenue = DB::table('sales_items')->where($match)->sum('revenue');
                $data[$department][] = $revenue;
            }
        }

        return $data;
    }

    /**
     * Return 1-d array for the specified department.
     *
     * @param $name
     * @param $year
     * @return mixed
     */
    private function getSingleDepartment($name, $year) {
        // get the nested array
        $data = $this->getDepartmentSaleByMonth($year);

        // retrieve the 1-d array based on $name key
        $result = $data[$name];

        return $result;
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

        // get revenue by month (this year)
        $monthSales = $this->getMonthlyTotalRevenue($year, $month);

        // get revenue by department (this month)
        $departmentSales = $this->getDepartmentRevenue($year, $month);

        $month_array = Month::where('id', '<=', $month)->lists('month');
        $depart_array = Department::all()->lists('department');

        // for javascript variable uses
        Javascript::put([
            'monthNames' => $month_array,
            'departNames' => $depart_array
        ]);

        return view('sales_items.index')
            ->with('monthNames', json_encode($month_array))
            ->with('monthTotals', json_encode($monthSales))
            ->with('departNames', json_encode($depart_array))
            ->with('departTotals', json_encode($departmentSales));
    }


    public function show() {
        $first = 1;

        // compare each department revenue by month
        // get departments sales array
        $appetizerSales = $this->getSingleDepartment('Appetizers', $first);
        $barSales = $this->getSingleDepartment('Bar', $first);
        $dimsumSales = $this->getSingleDepartment('Dimsum', $first);
        $expensiveSales = $this->getSingleDepartment('Entree_expensive', $first);
        $generalSales = $this->getSingleDepartment('Entree_general', $first);
        $luxurySales = $this->getSingleDepartment('Luxury', $first);
        $productSales = $this->getSingleDepartment('Product', $first);
        $seafoodSales = $this->getSingleDepartment('Seafood', $first);
        $soupSales = $this->getSingleDepartment('Soup', $first);

        /*
        $data = array(
            'monthNames' => json_encode(Month::all()->lists('month')),
            'appetizers' => json_encode($appetizerSales),
            'dimsum' => json_encode($dimsumSales),
            'expensive' => json_encode($expensiveSales),
            'general'=> json_encode($generalSales),
            'luxury' => json_encode($luxurySales),
            'product' => json_encode($productSales),
            'seafood'=> json_encode($seafoodSales),
            'soup' => json_encode($soupSales)
        );*/

        return view('sales_items.show')
            ->with('monthNames', json_encode(Month::all()->lists('month')))
            ->with('appetizers', json_encode($appetizerSales))
            ->with('bars', json_encode($barSales))
            ->with('dimsum', json_encode($dimsumSales))
            ->with('expensive', json_encode($expensiveSales))
            ->with('general', json_encode($generalSales))
            ->with('luxury', json_encode($luxurySales))
            ->with('product', json_encode($productSales))
            ->with('seafood', json_encode($seafoodSales))
            ->with('soup', json_encode($soupSales));

        //return view('sales_items.show')->with($data);
    }


    public function detail() {
        $num = 5;
        $match = ['year_id' => 1, 'month_id' => 1, 'department_id' => 1];
        $results = DB::table('sales_items')->where($match)->orderBy('revenue', 'desc')->take($num);

        return view('sales_items.detail')->with('pairs', $results->lists('revenue', 'name'));
    }

}
