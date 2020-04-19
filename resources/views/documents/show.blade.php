@extends('layouts.app')

@section('content')
<table class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Document Id</th>
      <th scope="col">Location</th>
      <th scope="col">Created at</th>
      <th scope="col">Updated at</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ $document->id }}</th>
      <td>{{ $document->invoice_id }}</td>
      <td>{{ $document->location }}</td>
      <td>{{ $document->created_at }}</td>
      <td>{{ $document->updated_at }}</td>
    </tr>
  </tbody>
</table>
@endsection