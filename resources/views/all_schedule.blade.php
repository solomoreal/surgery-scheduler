@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-12">
      <table class="table table-hover table-responsive-sm w-100">
        <thead>
          <tr>
            <th>Processes</th>
            <th>Arrival Time(Created At)</th>
            <th>Name</th>
            <th>condition</th>
            <th>Waiting time(days)</th>
            <th>Schedule Date(Service Time)</th>
            <th>Surgeon</th>
            <th>View Detail</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @if($entries ?? '')

          @php
          $sn = 0;    
          @endphp
          @foreach($entries as $entry)
          <tr>
          <td>{{++$sn}}</td>
          <td>{{$entry->created_at}}</td>
            <td>{{$entry->patient->name}}
            </td>
          <td>{{$entry->patient->condition}}</td>
          <td>{{$entry->waiting_time > 0 ? $entry->waiting_time + 1 : $entry->waiting_time }}</td>
          <td><p class="my-0">{{date('d M, Y',strtotime($entry->due_date))}}</p>
              <p class="my-0">{{date('h:i:s',strtotime($entry->due_date))}}</p></td>
          <td>{{$entry->surgeon->name ?? ''}}</td>
            <td>
            <a href="{{route('detail',['id' => $entry->id])}}" target="_blank" rel="noopener noreferrer">detail</a>
            </td>
            <td>
              {{$entry->status()}}
            </td>
            @if(Auth::user()->role == 2)
            @if($entry->status == 0)
            <td>
              <a href="{{route('complete',['id' => $entry->id])}}">Complete</a><br>
              <a href="{{route('cancel',['id' => $entry->id])}}">Cancel</a>
            </td>
            @endif
            @endif
          </tr>
          @endforeach
          @endif
          
        </tbody>
      </table>
    </div>
</div>
@endsection 