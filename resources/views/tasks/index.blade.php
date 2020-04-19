@extends('layouts.app')

@section('content')
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Created at</th>
      <th scope="col">Updated at</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($tasks as $task)
    <tr>
      <th scope="row">{{ $task->id }}</th>
      <td>{{ $task->name }}</td>
      <td>{{ $task->description }}</td>
      <td>{{ $task->created_at }}</td>
      <td>{{ $task->updated_at }}</td>
    </tr>
	@empty
	  <p>No tasks at the moment.</p>
	@endforelse
  </tbody>
</table>
@endsection