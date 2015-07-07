<?php

namespace App\Http\Controllers;

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
    private function getMonthlyTotalRevenue($year) {
        $data = [];
        $months = Month::with('sales_items')->get();
        foreach($months as $month) {
            $month_name = $month->month;
            $month_rev = $month->sales_items()->selectYear($year)->sum('revenue');
            $data[$month_name] = $month_rev;
        }
        return $data;
    }


    /**
     * Total revenue by departments.
     *
     * @param $yearNum
     * @return array
     */
    private function getDepartmentRevenue($year) {
        $data = [];
        $departments = Department::with('sales_items')->get();
        foreach($departments as $department) {
            $department_name = $department->department;
            $department_rev = $department->sales_items()->selectYear($year)->sum('revenue');
            $data[$department_name] = $department_rev;
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
        $data = [];
        $departments = Department::with('sales_items')->get();
        foreach($departments as $department) {
            for ($m = 1; $m <= 12; $m++) {
                $department_rev = $department->sales_items()->selectDepartment($m, $year)->sum('revenue');
                $data[$department->department][] = $department_rev;
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
        // year 2014
        $first = 1;

        // get revenue by month
        $monthSales = $this->getMonthlyTotalRevenue($first);

        // get revenue by department
        $departmentSales = $this->getDepartmentRevenue($first);

        // compare each department revenue by month
        // Appetizers
        $appetizerSales = $this->getSingleDepartment('Appetizers', $first);
        // Bar
        $barSales = $this->getSingleDepartment('Bar', $first);

        return view('sales_items.index')
            ->with('monthNames', json_encode(Month::all()->lists('month')))
            ->with('monthTotals', json_encode($monthSales))
            ->with('departNames', json_encode(Department::all()->lists('department')))
            ->with('departTotals', json_encode($departmentSales))
            ->with('appetizers', json_encode($appetizerSales))
            ->with('bars', json_encode($barSales));
    }

}
