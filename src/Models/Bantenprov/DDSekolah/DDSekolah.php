<?php

namespace Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DDSekolah extends Model
{

    protected $table = 'dd_sekolahs';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('negara', 'province_id', 'kab_kota', 'regency_id', 'tahun', 'data');

    public function getProvince()
    {
        return $this->hasOne('Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah\Province','id','province_id');
    }

    public function getRegency()
    {
        return $this->hasOne('Bantenprov\DDSekolah\Models\Bantenprov\DDSekolah\Regency','id','regency_id');
    }

}

