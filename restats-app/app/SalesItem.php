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
    /**
     * Retrieve specific year.
     *
     * @param $query
     * @param $yearNum
     */
    public function scopeSelectYear($query, $year) {
        $query->where('year_id', $year);
    }

    /**
     * Retrieve specific month.
     *
     * @param $query
     * @param $month
     */
    public function scopeSelectMonth($query, $month) {
        $query->where('month_id', $month);
    }

    /**
     * Retrieve specific month.
     *
     * @param $query
     * @param $month
     * @param $year
     */
    public function scopeSelectDepartment($query, $month, $year) {
        $match = ['month_id' => $month, 'year_id' => $year];
        $query->where($match);
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
