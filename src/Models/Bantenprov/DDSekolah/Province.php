<?php

namespace Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model 
{

    protected $table = 'provinces';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name');

}
