<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Karyawan extends Model
{
    protected $fillable = [
        'id','nama','alamat','tempat_lhr','tgl_lhr','jabatan'
        ];

    protected $table = 'Karyawans';
}
