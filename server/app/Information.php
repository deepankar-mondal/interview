<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $casts = [
        'input_data' => 'array',
        'output_data' => 'array'
    ];


     protected $fillable = ['name','input_data','output_data','calculated_amount_month_wise','accumulated_yield','desired_pension_amount_month_wise'];
}
