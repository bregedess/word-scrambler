<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $guarded = [];

    public $timestamps = true;

    public function path()
    {
        return '/api/v1/words/' . $this->id;
    }
}
