<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'proposal';

    protected $primaryKey = 'proposal_id';

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'proposal_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'kelompok_id',
        'judul_proposal',
        'ide_bisnis',
        'model_bisnis_canvas',
        'deskripsi_laba_rugi',
        'file_laba_rugi',
        'file_pemasaran',
        'deskripsi_pemasaran',
        'deskripsi_maintenance',
        'file_maintenance',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'kelompok_id' => 'integer',
    ];

    /**
     * Get the user that owns the proposal.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the kelompok that owns the proposal.
     */
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }
}
