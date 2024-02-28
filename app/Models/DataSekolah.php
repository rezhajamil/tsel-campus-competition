<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'data_sekolah_sumatera';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'NPSN';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'NPSN',
        'NAMA_SEKOLAH',
        'PROVINSI',
        'KAB_KOTA',
        'KECAMATAN',
        'KELURAHAN',
        'STATUS_SEKOLAH',
        'JENJANG',
        'KATEGORI_JENJANG',
        'REGIONAL',
        'BRANCH',
        'CLUSTER',
        'LATITUDE',
        'LONGITUDE',
        'PJP',
        'FREKUENSI',
        'TELP',
        'ALAMAT',
        'CITY',
        'jlh_siswa',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'NPSN' => 'string', // Kolom NPSN di-cast sebagai string
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
