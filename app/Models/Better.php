<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Better extends Model
{
    use HasFactory;

    public $fillable = ['name', 'surname', 'bet', 'horse_id'];

    public function horse(){
        return $this->belongsTo('App\Models\Horse');
}
}