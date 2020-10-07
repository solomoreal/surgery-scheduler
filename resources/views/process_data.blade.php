@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-10 mx-auto">
      <table class="table table-hover table-responsive-sm w-100">
        <thead>
          <tr>
            <th>Processes</th>
            <th>Arrival Time</th>
            <th>Burst Time</th>
            
          </tr>
        </thead>
        <tbody>
          @if($processes ?? '')

          @php
          $sn = 0;    
          @endphp
          @foreach($processes as $entry)
          <tr>
          <td>P{{++$sn}}</td>
          <td>{{$entry->arrival_time}}</td>
            <td>{{$entry->burst_time}}
            </td>
            </tr>
          @endforeach
          @endif
          
        </tbody>
      </table>
    </div>
</div>
@endsection 