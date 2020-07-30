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
            <th>Schedule Date</th>
            <th>Surgeon</th>
            <th>View Detail</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Jane Doe
            </td>
            <td>Cardio</td>
            <td><p class="my-0">17th Sept, 2020</p>
              <p class="my-0">12:01:04</p></td>
            <td>John Doe</td>
            <td>
              Details
            </td>
            <td>
              Pending
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Jane Doe
            </td>
            <td>Cardio</td>
            <td><p class="my-0">17th Sept, 2020</p>
              <p class="my-0">12:01:04</p></td>
            <td>John Doe</td>
            <td>
              Details
            </td>
            <td>
              Pending
            </td>
          </tr>
          <tr>
            <td>3</td>
            <td>Hank Doe
            </td>
            <td>Cardio</td>
            <td><p class="my-0">17th Sept, 2020</p>
              <p class="my-0">12:01:04</p></td>
            <td>Ken Doe</td>
            <td>
              Details
            </td>
            <td>
              Complete
            </td>
          </tr>
          </tr>
        </tbody>
      </table>
    </div>
</div>
@endsection 