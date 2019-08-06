@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('layouts.headers.answer')
 <br>
 <br>
 <br>
<div class="container-fluid mt--7">
    <div class="row">
<h4>{{ $survey->title }}</h4>
<div class="table-responsive">
  <div>
<table class="table align-items-center">
  <thead class="thead-light">
    <tr>
        <th data-field="id" scope="col">Question</th>
        <th data-field="name" scope="col">Answer(s)</th>
    </tr>
  </thead>

  <tbody class="list">
        @forelse ($survey->questions as $item)
    <td>
        <div class="media align-items-center">
                            
            <div class="media-body">
              <span class="mb-0 text-sm">
      {{ $item->title }}
              </span>
            </div>
          </div>
    </td>
    <td>
      @foreach ($item->answers as $answer)
      <div class="media-body">
          <span class="mb-0 text-sm">{{ $answer->answer }}
        <small>{{ $answer->created_at }}</small>
      </span>
    </div>
  </div>
      @endforeach
    </td>
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
  </div>
</div>
    </div>
    
</div>
<div class="card">
    <div class="card-body">
        <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="chart-orders" class="chart-canvas"></canvas>
        </div>
    </div>
</div>
<script src="http://127.0.0.1:8000/argon/vendor/chart.js/dist/Chart.min.js"></script>
<script src="http://127.0.0.1:8000/argon/vendor/chart.js/dist/Chart.extension.js"></script>
@endsection
