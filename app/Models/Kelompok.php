<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kelompok';

    protected $primaryKey = 'id';

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id');
    }
    public function proposal()
    {
        return $this->hasMany(Proposal::class, 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nama_kelompok',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_kelompok' => 'string',
    ];
}