<?php

namespace App\Http\Controllers;

use App\SalesItem;
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
        $sale = SalesItem::find(1);
        return view('sales_items.index')->with('item', $sale);
    }
}
