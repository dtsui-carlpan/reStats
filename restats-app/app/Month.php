<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    /**
     * @var string
     */
    protected $table = 'months';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sales_items() {
        return $this->hasMany('App\SalesItem', 'month_id');
    }
}
