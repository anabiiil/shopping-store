<?php

namespace App\Http\Controllers\front;

use Session;
use App\Models\User;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FrontAuth extends Controller
{
    public function login()
    {
        return view('front.auth.login');
    }
    public function dologin(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',

        ],[
            'email.required' => 'Email Is Required',
            'email.email' => 'Must Enter a Valid Email',
            'password.required' =>'Password Is Required'
        ]);


        $credential = ['email' => $request->email, 'password' => $request->password , 'status' => 1];
        $attempt = auth()->guard('web')->attempt($credential);
        $userCount = User::where(['email' => $request->email])->count();
        if($userCount == 0){
            session()->flash('success', 'This email does not exist ');
            return redirect()->back();
        }

        $userData = User::where(['email' => $request->email])->first();
        if($userData->status == 0 ){
            session()->flash('success', 'Your Account Is Not Activated ! Please Contact Admin ');
            return redirect()->back();
        }
        if($attempt){
            session()->flash('success', 'Logged Is Succefully');
            return redirect('/cart');
        }
        else{
            session()->flash('success', 'Incorrect UserName Or Password');
            return redirect('front/login');

        }


    }
    public function forgot_password(){
        return view('front.auth.forget_password');
    }
    public function forgot_password_post(Request $request){

        $user = User::where('email',$request->email)->first();
        if(!$user){
            session()->flash('success', 'Email does not exists!');
            return redirect()->back();
        }else{

             //Generate Random Password
             $random_password =  Str::random(8);

             //Encode/Secure Password
             $new_password = bcrypt($random_password);

             //Update Password
             User::where('email',$request->email)->update(['password'=>$new_password]);

             //Send Forgot Password Email Code
             $email = $request->email;
             $name = $user->name;
             $messageData = [
                 'email'=>$email,
                 'name'=>$name,
                 'password'=>$random_password
             ];
             Mail::send('emails.forgotpassword',$messageData,function($message)use($email){
                 $message->to($email)->subject('New Password - E-com Website');
             });

             session()->flash('success', 'Please check your email for new password!');
             return redirect('front/login');

        }
    }
    public function register(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ],[
            'email.required' => 'Email Is Required',
            'email.email' => 'Must Enter a Valid Email',
            'password.required' =>'Password Is Required'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());

        $data = $request->all();
        $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
        // Send Confirmation Email
        $email = $data['email'];
        Mail::send('emails.confirmation',$messageData,function($message) use($email){
             $message->to($email)->subject('Confirm your E-com Account');
         });
         session()->flash('success', 'please confirm your email to activate your account');
         return redirect()->back();
        if(Auth::attempt($validatedData)){
            session()->flash('success', 'User Has Been Added Succefully');
            return redirect('/cart');
        }


    }
    public function checkEmail(Request $request){
    	// Check if User already exists
    	$data = $request->all();
		$usersCount = User::where('email',$data['email'])->count();
		if($usersCount>0){
			echo "false";
		}else{
			echo "true"; die;
		}
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post')){

            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/

            if(empty($data['name'])){
                return redirect()->back()->with('flash_message_error','Please enter your Name to update your account details!');
            }

            if(empty($data['address'])){
                $data['address'] = '';
            }

            if(empty($data['city'])){
                $data['city'] = '';
            }


            if(empty($data['country'])){
                $data['country'] = '';
            }

            if(empty($data['pincode'])){
                $data['pincode'] = '';
            }

            if(empty($data['mobile'])){
                $data['mobile'] = '';
            }

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
             $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            session()->flash('success', 'Account Has Been Updated Succefully');
            return redirect()->back();

         }

        return view('front.auth.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            return response()->json([
                'current_password' => $current_password,
                'true'=>true,
             ], 200);

         }else{
            return response()->json([
                'current_password' => $current_password,
                'false' => false,
             ], 200);
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                // Update password

                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                session()->flash('success', 'Password Has Been Updated Succefully');
                return redirect()->back();
             }else{
                session()->flash('success', 'Password Is Incorrect');
                return redirect()->back();

             }
        }
    }

    public function logout()
    {
        auth()->guard('web')->logout();
        return redirect('front/login');
    }

    public function confirmAccount(Request $request ,$email,$code = null){
        $email = base64_decode($email);
        $userData = User::where(['email'=>$email])->count();
        if($userData > 0){
            $userData = User::where(['email'=>$email])->first();
            if($userData->status == 1){
                session()->flash('success', 'Your Email Is Already Activated , You Can Login Now');
                return redirect('front/login');
            }else{
                User::where(['email'=>$email])->update(['status'=>1]);

                $messageData = ['email'=>$email,'name'=>$userData->name];
                // Send Welcome Email
                Mail::send('emails.welcome',$messageData,function($message) use($email){
                     $message->to($email)->subject('Welcome To E-com Account');
                 });

                session()->flash('success', 'Your Email Is Activated , You Can Login Now');
                return redirect('front/login');
            }

        }else{
            abort(404);
        }

    }
}
