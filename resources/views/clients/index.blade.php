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
    @forelse ($clients as $client)
    <tr>
      <th scope="row">{{ $client->id }}</th>
      <td>{{ $client->name }}</td>
      <td>{{ $client->description }}</td>
      <td>{{ $client->created_at }}</td>
      <td>{{ $client->updated_at }}</td>
    </tr>
	@empty
	  <p>No clients at the moment.</p>
	@endforelse
  </tbody>
</table>
@endsection