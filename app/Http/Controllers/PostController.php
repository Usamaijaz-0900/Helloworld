<?php 

namespace App\http\Controllers;
use App\User;
use App\post;
use App\like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{

	public function getDashBoard(){
		$posts = Post::orderBy('created_at', 'desc')->get();
		return view('dashboard', ['posts' => $posts]);
	}
	public function postCreatePost(Request $request){

		$this->validate($request,[
			'body' => 'required|max:1000'
		]);
		$post = new Post();
		$post->body=$request['body'];
		$message = "There was an error";

		if($request->User()->posts()->save($post)){
			$message = "Post created successfully";
		}
		return redirect()->route('hash')->with(['message' => $message]);
	
	}
 
	public function getDeletePost($post_id){
		$post= Post::where('id', $post_id)->first();
		  if(Auth::user() != $post->user){
		  return redirect()->back();
		  }
        $post->delete();
        return redirect()->route('hash')->with(['message'=> 'Successfully deleted!!']);
         
	}
	public function postEditpost(Request $request)
	{
	
		$this->validate($request,[
			'body' => 'required'
		]);
		$post = Post::find($request['postid']);
		$post->body = $request['body'];
		if(Auth::user() != $post->user){
		  return redirect()->back();
		  }
		$post->update();
		return response()->json(['new_body' => $post->body],200);
	}


	public function postLikePost(Request $request)
	{
		$post_id = $request['postid'];
		$postislike = $request['islike'] == 'true';
		$update = false;
		$post = Post::find($post_id);
		if(!post){
			return null;
		}
		$User = Auth::user();
		$like = $user->likes()->where('post_id', $post_id)->first();
		if($like){
			$already_like = $like->like;
			$update = true;
			if($already_like == $postislike){
				$like->delete();
				return null;
			}

		}
		else{
			$like = new Like();
		}

		$like->like = $is_like;
		$like->user_id = $user->id;
		$like->post_id = $post_id;
		dd($like);
		if($update){
			$like->update();
		}
		else{
			$like->save();
		}
		return null;
	}

}