<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = "siswas";
    protected $guarded= [];

    public function project(){
        return $this->hasMany(Project::class);
    }

    public function contact(){
        return $this->hasMany(Contact::class);
    }



}
