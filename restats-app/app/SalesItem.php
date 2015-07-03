<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sales_items';

    /****************
     * Query Scopes *
     ****************/

    public function scopeTotalRevenue($query) {
        $query->where();
    }





    /**************************
     * Eloquent Relationships *
     **************************/

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function months() {
        return $this->belongsTo('App\Month', 'month_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function years() {
        return $this->belongsTo('App\Year', 'year_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departments() {
        return $this->belongsTo('App\Department', 'department_id');
    }
}
