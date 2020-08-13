@extends('layouts.dashboard')
@section('content')

<div class="row">
    <div class="col-md-12">
      <table class="table table-hover table-responsive-sm w-100">
        <thead>
          <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>condition</th>
            <th>Waiting time(days)</th>
            <th>Schedule Date</th>
            <th>Surgeon</th>
            <th>View Detail</th>
            <th>Status</th>
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
            <td>{{$entry->patient->name}}
            </td>
          <td>{{$entry->patient->condition}}</td>
          <td>{{$entry->created_at}}</td>
          <td><p class="my-0">{{date('d M, Y',strtotime($entry->due_date))}}</p>
              <p class="my-0">{{date('h:i:s',strtotime($entry->due_date))}}</p></td>
          <td>{{$entry->surgeon->name ?? ''}}</td>
            <td>
            <a href="{{route('detail',['id' => $entry->id])}}" target="_blank" rel="noopener noreferrer">detail</a>
            </td>
            <td>
              {{$entry->status()}}
            </td>
          </tr>
          @endforeach
          @endif
          
        </tbody>
      </table>
    </div>
</div>
@endsection 