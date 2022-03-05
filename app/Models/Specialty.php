<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Specialty extends Model
{
    use HasFactory;

    public function users(){
        return $this->hasMany(User::class,'specialty_id','id');
    }


    public function getActiveStatusAttribute(){
        return $this->active == 1 ? 'Active' : 'InActive';
    }

}



