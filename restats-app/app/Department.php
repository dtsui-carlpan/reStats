<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * @var string
     */
    protected $table = 'departments';

    /**
     *
     */
    public function sales_items() {
        $this->hasMany('App\SalesItem', 'department_id');
    }

}
