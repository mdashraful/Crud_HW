<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name','b_date','gender', 'address', 'email', 'phone', 'interest', 'batch', 'course', 'p_hour', 'image', 'cv'];

    /* set the interest */
    public function setInterestAttribute($value) {
        $this->attributes['interest'] = json_encode($value);
    }
    /* get the interest */
    public function getInterestAttribute($value) {
        return $this->attributes['interest'] = json_decode($value);
    }

    /* set the course */
    public function setCourseAttribute($value) {
        $this->attributes['course'] = json_encode($value);
    }
    /* get the course */
    public function getCourseAttribute($value) {
        return $this->attributes['course'] = json_decode($value);
    }
}
