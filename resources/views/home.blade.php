@extends('layouts.app')

@section('content')
<nav class="navbar navbar-light bg-primary padding-none">
  	<div class="nav-item dropdown">
  		<a class="navbar-brand nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 5px; border-right-color: white; border-right-style: solid; color: white;">MENU 
			<svg class="bi bi-list" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
            </svg>
  		</a>
  		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	         <a class="dropdown-item" href="{{ route('clients.index', ['clients' => App\Client::all()]) }}">Clients</a>
	         <a class="dropdown-item" href="{{ route('matters.index', ['matters' => App\Matter::all()]) }}">Matters</a>
	         <a class="dropdown-item" href="{{ route('documents.index', ['documents' => App\Document::all()]) }}">Documents</a>
	    </div>
  	</div>
  	<form class="form-inline">
	  	<div style="margin: 10px;">
	        <svg class="bi bi-book" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg" style="margin: auto;">
	            <path fill-rule="evenodd" d="M3.214 1.072C4.813.752 6.916.71 8.354 2.146A.5.5 0 018.5 2.5v11a.5.5 0 01-.854.354c-.843-.844-2.115-1.059-3.47-.92-1.344.14-2.66.617-3.452 1.013A.5.5 0 010 13.5v-11a.5.5 0 01.276-.447L.5 2.5l-.224-.447.002-.001.004-.002.013-.006a5.017 5.017 0 01.22-.103 12.958 12.958 0 012.7-.869zM1 2.82v9.908c.846-.343 1.944-.672 3.074-.788 1.143-.118 2.387-.023 3.426.56V2.718c-1.063-.929-2.631-.956-4.09-.664A11.958 11.958 0 001 2.82z" clip-rule="evenodd"/>
	            <path fill-rule="evenodd" d="M12.786 1.072C11.188.752 9.084.71 7.646 2.146A.5.5 0 007.5 2.5v11a.5.5 0 00.854.354c.843-.844 2.115-1.059 3.47-.92 1.344.14 2.66.617 3.452 1.013A.5.5 0 0016 13.5v-11a.5.5 0 00-.276-.447L15.5 2.5l.224-.447-.002-.001-.004-.002-.013-.006-.047-.023a12.582 12.582 0 00-.799-.34 12.96 12.96 0 00-2.073-.609zM15 2.82v9.908c-.846-.343-1.944-.672-3.074-.788-1.143-.118-2.387-.023-3.426.56V2.718c1.063-.929 2.631-.956 4.09-.664A11.956 11.956 0 0115 2.82z" clip-rule="evenodd"/>
	        </svg>
	    </div>
    	<input class="form-control" type="search" placeholder="Search for matters, documents, tasks, events..." aria-label="Search">
	</form>
	<div class="rounded border border-white" id="clock-id" style="color: white; margin: 1em 1em 1em 3em; padding: 5px;">
		<div>TIMERS 
			<svg class="bi bi-clock" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 15A7 7 0 108 1a7 7 0 000 14zm8-7A8 8 0 110 8a8 8 0 0116 0z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M7.5 3a.5.5 0 01.5.5v5.21l3.248 1.856a.5.5 0 01-.496.868l-3.5-2A.5.5 0 017 9V3.5a.5.5 0 01.5-.5z" clip-rule="evenodd"/>
            </svg>
		</div>
	</div>
</nav>

<div class="nav navbar bg-light">
	<form method="POST" action="/all" class="form-group">
	@csrf
		<div class="form-inline">
	        <label >Client *</label>
            <input type="text" name="client" class="form-control" list="clients-list" id="client-name-input" oninput="clientName()">
            <datalist id="clients-list">
            @foreach ($clients as $client)
				<option value="{{ $client->name }}">
			@endforeach
			</datalist>
	    </div>

		<div class="form-inline">
	        <label >Matter *</label>
            <input type="text" name="matter" class="form-control" list="matters-list" />
            <datalist id="matters-list">
            @foreach ($matters as $matter)
				<option value="{{ $matter->name }}">
			@endforeach
			</datalist>
	    </div>

		<div class="nav bg-white">
			<div class="navbar">
				<div class="form-group">
					<div class="form-inline">
						<label>Client * </label><span><b id="client-name-output"></b></span>
					</div>
					<div class="form-inline">
						<label>Matter </label><span><b id="matter-name"></b></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline">
					<div class="input-group-prepend">
    					<label class="input-group-text" for="inputGroupIssuer">Issuer:</label>
  					</div>
					<select class="custom-select" name="user_id" id="inputGroupIssuer">
					@foreach ($users as $user)
						<option value="{{ $user->id }}" selected>{{ $user->name }}</option>
					@endforeach
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline">
					<div class="input-group-prepend">
						<label for="inputGroupLanguages" class="input-group-text">Language: </label>
					</div>
					<select name="" id="inputGroupLanguages" class="custom-select">
						<option value="english">English</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="form-inline">
					<div class="input-group-prepend">
    					<label class="input-group-text" for="inputGroupCurrencies">Currency:</label>
  					</div>
					<select class="custom-select" name="currency_id" id="inputGroupIssuer">
					@foreach ($currencies as $currency)
						@php
							if ($currency->id == 3)
								break;
						@endphp
						<option value="{{ $currency->id }}" selected>{{ $currency->currency }}</option>
					@endforeach
					</select>
				</div>
			</div>

			<div class="form-inline">
		        <label>Invoice No:</label>
		        <div class="d-flex justify-content-right">
		            <input type="number" name="invoice_num" class="form-control" />
		        </div>
		    </div>

		    <div class="form-inline">
		        <label>Issuing date:</label>
		        <div class="d-flex justify-content-right">
		            <input type="date" name="issue_date" class="form-control" />
		        </div>
		    </div>

			<div class="form-inline">
		        <label>Amount:</label>

		        <div class="d-flex justify-content-right">
		            <input type="text" name="amount" class="form-control" value="{{ old('amount') }}" placeholder="0.00" />
		        </div>
		        <span class="currency-option">$</span>
		        <span id="amount-span"></span>
		    </div>

		    <div class="form-inline">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" checked>
                    <label class="form-check-label" for="exampleCheck1">Discount:</label>
                </div>
                <input type="text" class="form-control" value="{{ old('discount') }}" name="discount" placeholder="0.00">
                <span>%</span>
                <span class="currency-options">$</span>
                <span >0.00</span>
            </div>

            <div class="form-inline">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" checked>
                    <label class="form-check-label" for="exampleCheck1">VAT:</label>
                </div>
                <input type="text" class="form-control"placeholder="0.00" />
                <span>%</span>
                <span class="currency-options">$</span>
                <span id="vat">0.00</span>
            </div>

            <div class="form-inline">
		        <label>Services:</label>
		        <div class="d-flex justify-content-right">
		        	<textarea class="form-control" name="description" rows="3" placeholder="Services..." value="{{ old('description') }}"></textarea>
		        </div>
		    </div>
		</div>
		<div class="form-inline">
		<div class="text-left">
			<button type="submit" class="btn btn-primary">Create invoice</button>
		</div>

		<div class="text-left">
			<a href="/home" class="btn btn-outline-danger">Clear</a>
		</div>
		</div>
	</form>
</div>
@endsection