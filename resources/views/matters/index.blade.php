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
    @forelse ($matters as $matter)
    <tr>
      <th scope="row">{{ $matter->id }}</th>
      <td>{{ $matter->name }}</td>
      <td>{{ $matter->description }}</td>
      <td>{{ $matter->created_at }}</td>
      <td>{{ $matter->updated_at }}</td>
    </tr>
	@empty
	  <p>No matters at the moment.</p>
	@endforelse
  </tbody>
</table>
@endsection