@extends('layouts.Master')

@section('tittle')
Welcome
@endsection
@include('includes.message-block')
@section('content')
<div class="row">
    <div class=col-md-4>
        <form action="signup" method="POST">
          @csrf
  <div class="form-group {{$errors->has ('email') ? 'has-error' : ''}}">
    <label for="email">Email address</label>
    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{Request :: old('email')}}">
  </div>
  <div class="form-group {{$errors->has ('firstname') ? 'has-error' : ''}}">
    <label for="firstname">Firstname</label>
    <input type="text" class="form-control" id="firstname" placeholder="firstname" name="firstname" value="{{Request::old('firstname')}}">
  </div>
  <div class="form-group{{$errors->has ('passwords') ? 'has-error' : ''}}">
     <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="password" name="password" value="{{Request :: old('password')}}">
  </div>
  <button type="submit" class="btn btn-primary ">Submit</button>
  <input type="hidden" name="_token" value="{{Session::token()}}">
</form >
    </div>
    <div class="col-md-6">
       <form action="sign_in"method="post">
         <div class="form-group {{$errors->has ('email') ? 'has-error' : ''}}">
    <label for="email">Your email</label>
    <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{Request :: old('email')}}">
  </div>
  
  <div class="form-group {{$errors->has ('password') ? 'has-error' : ''}}">
     <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="password" name="password" value="{{Request :: old('password')}}">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
   <input type="hidden" name="_token" value="{{Session::token()}}">
</form> 
    </div>
</div>
@endsection

