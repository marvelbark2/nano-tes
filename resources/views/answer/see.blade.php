@extends('answer')

@section('content')
<h4>{{ $survey->title }}</h4>
<div class="table-responsive">
    <table class="table align-items-center table-flush">
  <thead>
      <thead class="thead-light">
        <th scope="col" data-field="id">Question</th>
        <th scope="col" data-field="name">Answer(s)</th>
    </tr>
  </thead>

  <tbody>
    @forelse ($survey->questions as $item)
    <tr>
      <td>{{ $item->title }}</td>
      @foreach ($item->answers as $answer)
        <td>{{ $answer->answer }} <br/>
        <small>{{ $answer->created_at }}</small></td>
      @endforeach
    </tr>
    @empty
      <tr>
        <td>
          No answers provided by you for this Survey
        </td>
        <td></td>
      </tr>
    @endforelse
  </tbody>
</table>
<br>
        <hr>
        <br>
        <div class="container" style="height: 400px; width: 600px;">
            <div class="card">
        <div class="card-body">
            <div class="chart">
        {!! $chart->container() !!} 
        </div>
      </div>
    </div>
</div>
        <br>
        <hr>
        <br>
<div class="container" style="height: 400px; width: 600px;">
    <div class="card">
        <div class="card-body">
            <div class="chart">
        {!! $chart2->container() !!} 
      </div>
    </div>
  </div>
        </div>
@endsection
