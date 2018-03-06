<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionName extends Model
{
	protected $fillable = ['id','nama'];
    public function questions() {
    return $this->hasMany(Question::class);
  }
  public function survey() {
    return $this->belongsTo(Survey::class);
  }
}
