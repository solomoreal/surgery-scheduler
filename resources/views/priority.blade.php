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
            <th>Completion Time</th>
            <th>Turn Around Time</th>
            <th>Waiting Time</th>
            
            
          </tr>
        </thead>
        <tbody>
        <h3>Avarege Waiting Time: {{$average_waiting_time}} <span> <small> (For {{count($entries)}} Processess)</small></span></h3>
        <h3>Avarege Turn Around Time: {{$average_turnaround_time}} <span> <small> (For {{count($entries)}} Processess)</small></span></h3>
          @if($entries ?? '')

          @php
          $sn = 0;    
          @endphp
          @foreach($entries as $entry)
          <tr>
          <td>P{{++$sn}}</td>
          <td>{{$entry->arrival_time}}</td>
            <td>{{$entry->burst_time}}</td>
            <td>{{$entry->completion_time}}</td>
            <td>{{$entry->turnaround_time}}</td>
            <td>{{$entry->waiting_time}}</td>
            </tr>
          @endforeach
          
          @endif
          
        </tbody>
      </table>
    </div>
</div>
@endsection 