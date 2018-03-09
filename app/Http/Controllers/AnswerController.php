<?php

namespace App\Http\Controllers;

use Auth;
use App\Survey;
use App\Answer;
use App\Karyawan;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


class AnswerController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function store(Request $request, Survey $survey, Karyawan $karyawan) 
  {
    // remove the token
    $arr = $request->except('_token'); 
    foreach ($arr as $key => $value) { 
      $newAnswer = new Answer();
        if($value == 'Sangat Baik'){
          $newAnswer->key='5';
        }elseif ($value == 'Baik') {
          $newAnswer->key='4';
        }elseif ($value == 'Sedang') {
          $newAnswer->key='3';
        }elseif ($value == 'Buruk') {
          $newAnswer->key='2';
        }elseif ($value == 'Sangat Buruk') {
          $newAnswer->key='1';
        }
          if(array_has($karyawan,'karyawan_id')){
            $newValue = json_encode($karyawan['karyawan_id']);
            $newAnswer->karyawan_id = $newValue;
          } else {
            $karyawan = array_except($karyawan,['karyawan_id']);
            $newAnswer->karyawan_id = json_encode($karyawan);
            $newAnswer->karyawan_id = $karyawan;
          }
        
          
        
        $newAnswer->answer=$value;
        $newAnswer->question_id = $key;
        $newAnswer->user_id = Auth::id();
        $newAnswer->survey_id = $survey->id;


        $newAnswer->save();

        $answerArray[] = $newAnswer;
        };
        return redirect()->action('SurveyController@view_survey_answers', [$survey->id,]);
    
  }
}
