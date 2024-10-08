<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'foto', 'user_id'];

    public function matkul()
    {
        return $this->hasMany(Matkul::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }


    public static function getDosenID($userid)
    {
        return Dosen::where('user_id', $userid)->findOrFail();
    }
}
