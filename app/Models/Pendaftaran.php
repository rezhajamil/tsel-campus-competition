<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pendaftaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'kelompok_id',
        'proposal_id',
    ];

    /**
     * Get the user that owns the pendaftaran.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the kelompok that owns the pendaftaran.
     */
    public function kelompok()
    {
        return $this->belongsTo(Kategori::class, 'kelompok_id');
    }

    /**
     * Get the proposal that owns the pendaftaran.
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'proposal_id');
    }
}
