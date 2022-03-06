<?php

namespace App\Controllers\UserControllers;


class UserDashboard extends UserBaseController
{
    
   
    public function index()
    {
        $data['main_content']='UserViews/user_dashboard';
        $data['header_title']='Dashboard';
        return view('UserViews/user_main_page',$data);
    }

   

   
}

?>