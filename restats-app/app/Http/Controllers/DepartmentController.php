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

class DepartmentController extends Controller
{

    /**
     * Authentication protection.
     */
    public function __construct() {
        $this->middleware('auth');
    }


    /*************************
     * Query functions       *
     *************************/

    private function getTopItems($year, $month, $department, $num) {
        $data = array();
        $match = ['year_id' => $year, 'month_id' => $month, 'department_id' => $department];

        // get lists
        $name = DB::table('sales_items')->where($match)->orderBy('revenue', 'desc')->take($num)->lists('name');
        $price =  DB::table('sales_items')->where($match)->orderBy('revenue', 'desc')->take($num)->lists('price');
        $revenue = DB::table('sales_items')->where($match)->orderBy('revenue', 'desc')->take($num)->lists('revenue');

        // build up array with key as name and value as ['price', 'revenue']
        for ($index = 0; $index < count($name); $index++) {
            $data[$name[$index]] = [$price[$index], $revenue[$index]];
        }

        return $data;
    }

    private function getLeastItems($year, $month, $department, $num) {
        $data = array();
        $match = ['year_id' => $year, 'month_id' => $month, 'department_id' => $department];

        // queries to get lists
        $name = DB::table('sales_items')->where($match)->orderBy('revenue', 'asc')->take($num)->lists('name');
        $price = DB::table('sales_items')->where($match)->orderBy('revenue', 'asc')->take($num)->lists('price');
        $revenue = DB::table('sales_items')->where($match)->orderBy('revenue', 'asc')->take($num)->lists('revenue');

        // reverse array
        $name = array_reverse($name);
        $price = array_reverse($price);
        $revenue = array_reverse($revenue);

        // build up array with key as name and value as ['price', 'revenue']
        for ($index = 0; $index < count($name); $index++) {
            $data[$name[$index]] = [$price[$index], $revenue[$index]];
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
    private function getDepartmentSaleByMonth($year, $month) {
        $data = array();
        // get month array
        $months = DB::table('months')->where('id', '<=', $month)->lists('month', 'id');
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
    private function getSingleDepartment($name, $year, $month) {
        // get the nested array
        $data = $this->getDepartmentSaleByMonth($year, $month);

        // retrieve the 1-d array based on $name key
        $result = $data[$name];

        return $result;
    }


    /*************************
     * Passing data to view  *
     *************************/
    /**
     * @return mixed
     */
    public function showAppetizers() {
        $year = 1;
        $month = 7;
        $department = 1;

        // for sales plot
        $appetizerSales = $this->getSingleDepartment('Appetizers', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        // for table summary
        $num = 5; // temp
        $top = $this->getTopItems($year, $month, $department, $num);
        $least = $this->getLeastItems($year, $month, $department, $num);

        return view('departments.appetizers')
            ->with('monthNames', json_encode($month_array))
            ->with('appetizers', json_encode($appetizerSales))
            ->with('topItems', $top)
            ->with('leastItems', $least);
    }





    /**
     * @return mixed
     */
    public function showBar() {
        $year = 1;
        $month = 7;
        $barSales = $this->getSingleDepartment('Bar', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.bar')
            ->with('monthNames', json_encode($month_array))
            ->with('bars', json_encode($barSales));
    }

    /**
     * @return mixed
     */
    public function showDimsum() {
        $year = 1;
        $month = 7;
        $dimsumSales = $this->getSingleDepartment('Dimsum', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.dimsum')
            ->with('monthNames', json_encode($month_array))
            ->with('dimsum', json_encode($dimsumSales));
    }

    /**
     * @return mixed
     */
    public function showEntreeExpensive() {
        $year = 1;
        $month = 7;
        $expensiveSales = $this->getSingleDepartment('Entree_expensive', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.entree_expensive')
            ->with('monthNames', json_encode($month_array))
            ->with('expensive', json_encode($expensiveSales));
    }

    /**
     * @return mixed
     */
    public function showEntreeGeneral() {
        $year = 1;
        $month = 7;
        $generalSales = $this->getSingleDepartment('Entree_general', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.entree_general')
            ->with('monthNames', json_encode($month_array))
            ->with('general', json_encode($generalSales));
    }

    /**
     * @return mixed
     */
    public function showLuxury() {
        $year = 1;
        $month = 7;
        $luxurySales = $this->getSingleDepartment('Luxury', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.luxury')
            ->with('monthNames', json_encode($month_array))
            ->with('luxury', json_encode($luxurySales));
    }

    /**
     * @return mixed
     */
    public function showProduct() {
        $year = 1;
        $month = 7;
        $productSales = $this->getSingleDepartment('Product', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.product')
            ->with('monthNames', json_encode($month_array))
            ->with('product', json_encode($productSales));
    }

    /**
     * @return mixed
     */
    public function showSeafood() {
        $year = 1;
        $month = 7;
        $seafoodSales = $this->getSingleDepartment('Seafood', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.seafood')
            ->with('monthNames', json_encode($month_array))
            ->with('seafood', json_encode($seafoodSales));
    }

    /**
     * @return mixed
     */
    public function showSoup() {
        $year = 1;
        $month = 7;
        $soupSales = $this->getSingleDepartment('Soup', $year, $month);
        $month_array = Month::where('id', '<=', $month)->lists('month');

        return view('departments.soup')
            ->with('monthNames', json_encode($month_array))
            ->with('soup', json_encode($soupSales));
    }
}
