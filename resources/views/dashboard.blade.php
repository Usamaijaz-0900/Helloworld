@extends('layouts.Master')

@section('content')
@include('includes.message-block')
<section class="row new-post">
	<div col-md-6 col md-offset-3>
		<header><h3>What do you want to say?</h3></header>
		  <form action="createpost" method = 'POST'>
	          @csrf
			  <div class="form-group ">
			  	<textarea class="form-control" name="body" id="new-post" row="5" placeholder="your_post"></textarea>
			  </div>
	  
	 		 <button type="submit" class="btn btn-primary ">Create post</button>
	  		<input type="hidden" name="_token" value="{{Session::token()}}">
		</form >
	</div>
</section>
<section class="row posts">
	<div col-md-6 col md-offset-3>
		<header><h3>What other people say</h3></header>
		@foreach($posts  as $post)
		<article class="post" data-postid="{{$post->id}}">
			<p>
				{{$post->body}}
				
			</p>
			<div class="info">
				posted by {{$post->user->firstname}} on{{$post->created_at}}
			</div>
			<div class="interaction"> 
				<a href="" class="Like">Like</a>
				<a href="" class="Like">DisLike</a>
				@if(Auth::user() == $post->user)
				<a href="#" class="Edit">Edit</a>
				<a href="{{route('post.delete',['post_id' => $post->id])}}">Delete</a>
				@endif() 
				
			</div>
		</article>
		<@endforeach>
 
	</div>
</section>

<div class="modal" tabindex="-1" role="dialog" id="edit-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>
      	<div class="form-group">
      		<label for="post-body">EDIT THE POST</label>
      		<textarea class="form-control"  name="post-body" id="post-body" rows="5"></textarea>
      	</div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
	var url = '{{route('edit')}}';
	var urlLike = '{{route('like')}}';
	var token ='{{Session::token() }}';
</script>
@endsection	
<link href = "{{asset('src/css/main.css')}}" rel = "stylesheet"/>
<script src="{{asset('src/js/app.js')}}">
</script>