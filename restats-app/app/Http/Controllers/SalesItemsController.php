<?php

namespace App\Http\Controllers;

use App\SalesItem;
use App\Month;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesItemsController extends Controller
{
    /**
     *
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        //$sale = SalesItem::find(1);
        $sales = Month::first()->sales_items()->select()->get();

        return view('sales_items.index')
            ->with('items', $sales)
            ->with('names', json_encode($sales->lists('name')))
            ->with('totals', json_encode($sales->lists('revenue')));
    }
}
