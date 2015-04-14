<?php

class HomeController extends BaseController {

	public function getIndex(){
		/*user_data = Auth::user();
		if($user_data->role == 'admin' || $user_data->role=='modulator'){

			return Redirect::to('/admin');
		}

		if($user_data->role=='user'||$user_data->role=='gopro'){
			return Redirect::to('/user');
		}*/
	}

	public function showLogin()
	{
		// show the form
		return View::make('login');
	}

	public function doLogin()
	{
        /* Get the login form data using the 'Input' class */
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
		
		//var_dump($userdata);
        /* Try to authenticate the credentials */
        if(Auth::attempt($userdata)) 
        {
            // we are now logged in, go to admin
			$type = Auth::user()->type;
			/*if($type==1){
				return Redirect::to('usermanage');
			}
			else
			{
				return Redirect::to('userprofile');
			}*/
			//echo "ok";
			$year = date('Y');
			return Redirect::to('report/year/'.($year+543));
        }
        else
        {
            return Redirect::to('login');
			//echo "fail";
        }
	}

}
