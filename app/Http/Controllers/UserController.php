<?php 

namespace App\http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
	
	
	public function postSignUp(Request $request){
		
		$this->validate($request, [
			'email' => 'required|email|unique:users',
			'firstname' => 'required|max:120',
			'password' => 'required|min:4'

		] );
		$email = $request['email'];
		$firstname = $request['firstname'];
		$password = bcrypt($request['password']);

		$user = new User();
		$user->email=$email;
		$user->firstname=$firstname;
		$user->password=$password;

		$user->save();
		Auth::login($user);  
		return redirect()->route('hash');
	}

	public function postSignin(Request $request){

		$this->validate($request,[
			'email' => 'required',
			'password' => 'required'
		]); 
		if(Auth :: attempt(['email'=> $request['email'],'password' => $request['password']])){
			return redirect()->route('hash');
		}
		return redirect()->back();
		
	}

		public function getLogout()
		{
			Auth::logout();
			return view('welcome');
		}

		public function getAccount()
		{
			return view('account',['user' => Auth::user()]);
		}

		public function postSaveAccount(Request $request)
		{
		
			$user= Auth::user();
			$user->firstname = $request['first_name'];
			$user->update();
			$file = $request->file('image');
			$filename = $request['first_name'] .'-'. $user->id.'.jpg';
			if($file){
				Storage::disk('local')->put($filename, File::get($file));
 			}

			return redirect()->route('account');
		}

	public function getUserImage($filename){
		dd('ok');
		$file = Storage::disk('local')->get($filename);
	return new Response($file,200); 
	}
	

}