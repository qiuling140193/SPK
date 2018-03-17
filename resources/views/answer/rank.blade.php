@extends('layout')

@section('content')

  <table class="bordered striped">
    <thead>
      <tr>
          <th data-field="id">ID</th>
          <th data-field="user_id">User ID</th>
          <th data-field="question_id">Question ID</th>
          <th data-field="survey_id">Survey ID</th>
          <th data-field="answer">Answer</th>
          <th data-field="nilai">Grade</th>
      </tr>

    </thead>

    <tbody>
      @foreach($answer as $answer)
        <tr>
          <td>{{ $answer->id }}</td>
          <td>{{ $answer->user_id }}</td>
          <td>{{ $answer->question_id }}</td>
          <td>{{ $answer->survey_id }}</td>
          <td>{{ $answer->answer }}</td>
          <td>{{ $answer->key }}</td>
          <td>{{ $answer->kriteria }}</td>
      </tr>
      @endforeach 
    </tbody>
</table>
@endsection
