<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Superadmin;

class LoginController extends Controller
{
    public function login(Request $request){
        $this->getIp();
    	$h = new Hotel;
    	$s = new Superadmin;
    	if($request->username == "admin"){
    		$result = $s->where('username', $request->username)->where('password', $request->password)->first();
    		if(!$result){
                session()->flash('alerttype', 'alert alert-danger');
                session()->flash('alertmessage', 'Invalid username or password');
    			return redirect('/login');
    		}else{
    			session()->put('status', 1);
    			session()->put('username', $request->username);
    			session()->put('type', 'superadmin');
                session()->put('id', $result->id);
    			return redirect('/');
    		}
    	}else{
    		$result = $h->where('username', $request->username)->where('password', $request->password)->first();
    		if(!$result){
                session()->flash('alerttype', 'alert alert-danger');
                session()->flash('alertmessage', 'Invalid username or password');
    			return redirect('/login');
    		}else{
    			echo "Right";
    			session()->put('status', 1);
    			session()->put('username', $request->username);
    			session()->put('type', 'hoteladmin');
                session()->put('id', $result->id);
    			return redirect('/');
    		}
    	}
    }

    public function logout(){
    	session()->flush();
        session()->flash('alerttype', 'alert alert-info');
        session()->flash('alertmessage', 'Logout Successful');
    	return redirect('/login');
    }

    public function getIp(){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
            session()->put('myIP', $ipAddress);
        } else {
            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
                session()->put('myIP', $ipAddress);
            }
        }
    }
}
