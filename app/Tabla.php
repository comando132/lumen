<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabla extends Model {
    protected $table = 'tabla';
    protected $primaryKey = 'id';
    protected $fillable = ['a', 'b', 'res'];
    public $timestamps = false;
}