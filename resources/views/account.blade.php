@extends('layouts.master')

@section('titlte')
Account
@endsection

@section('content')
<section class="row new-post">
	<div col-md-6 col md-offset-3>
		<header><h3>Your Account</h3></header>
		  <form action="{{ route('account.save')}}" method = 'POST' enctype="multipart/form-data">
	          @csrf
			  <div class="form-group ">
			  	<label for="first_name">First</label>
    			 <input type="text" class="form-control" id="first_name" placeholder="first_name" name="first_name" value="{{$user->firstname}}">
			  </div>
	  		 <div class="form-group ">
			  	<label for="image">Image (only in jpg)</label>
    			 <input type="file" class="form-control" id="image"  name="image" >
			  </div>
	 		 <button type="submit" class="btn btn-primary ">Save Account</button>
	  		<input type="hidden" name="_token" value="{{Session::token()}}">
		</form >
	</div>
</section>

@if(Storage::disk('local')->has($user->firstname.'-'.$user->id.'.jpg'))
<section class="row new-post">
	<div class="col-md-6 col-md-offset-3">
		<img src="{{route('account.image',['filename' => $user->firstname.'-'. $user->id. '.jpg'])}}" alt="usama ijaz" class="img-reponsive">
	</div>
</section>
@endif
@endsection