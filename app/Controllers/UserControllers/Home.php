<?php

namespace App\Controllers\UserControllers;

class Home extends UserBaseController
{
    public function index()
    {
        return view('UserViews/home_view');
    }

    public function login_view()
    {
        return view('UserViews/login_view');
    }

    public function login_check()
    {
        return view('welcome_message');
    }
    
    
    
    
    
    
    
    
    public function ci_default_page()
    {
        return view('welcome_message');
    }

   
}
