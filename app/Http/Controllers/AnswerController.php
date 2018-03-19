<?php

namespace App\Http\Controllers;

use Auth;
use App\Survey;
use App\Answer;
use App\Karyawan;
use App\Question;
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

  public function index(Survey $survey, Request $request, Answer $answer, Question $question)
    {
        $answer=Answer::all();
        $question=Question::all();
        return view('answer.rank',compact('question', 'answer'));
    }

  public function store(Request $request, Survey $survey, Karyawan $karyawan, Question $question) 
  {

    // remove the token
    $arr = $request->except('_token', 'karyawan_id','kriteria');
    $karyawan_id= $request->input('karyawan_id');
    $kriteria = array_except($question,['kriteria']);
    $kriteria=$request->input($question,['kriteria']);
    foreach($arr as $key => $array) {
      $newAnswer = new Answer();
      switch ($array) {
        case 'Sangat Baik':
          $newAnswer->key = '5';
          break;
        case 'Baik':
          $newAnswer->key = '4';
          break;
        case 'Sedang':
          $newAnswer->key = '3';
          break;
        case 'Buruk':
          $newAnswer->key = '2';
          break;
        case 'Sangat Buruk':
          $newAnswer->key = '1';
          break;
        default:
          # code...
          break;
      }
      $newAnswer->karyawan_id = $karyawan_id;
      foreach($survey->questions as $question) {
        if($question->id == $key) {
          $newAnswer->kriteria = $question->kriteria;    
        }  
      }
      $newAnswer->answer = $array;
      $newAnswer->question_id = $key;
      $newAnswer->user_id = Auth::id();
      $newAnswer->survey_id = $survey->id;
      $newAnswer->save();
    }
        return redirect()->action('SurveyController@view_survey_answers', [$survey->id,]);
    
  }
}
