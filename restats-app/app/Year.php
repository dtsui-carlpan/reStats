<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    /**
     * @var string
     */
    protected $table = 'years';

    /**
     *
     */
    public function sales_items() {
        $this->hasMany('App\SalesItem', 'year_id');
    }

}
