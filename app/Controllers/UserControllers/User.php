<?php

namespace App\Controllers\UserControllers;

use App\Models\UserModel;
class User extends UserBaseController
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
        $this->session->remove('admin_user_data');
        $this->session->remove('user_data');
        $email=$this->request->getPost('email');
        $pwd=$this->request->getPost('pwd');
        $user_model = new UserModel();
        $multiClause = array('email' =>$email, 'pwd' => md5(  $pwd), 'is_active' => "1" );
        $data=$user_model->where($multiClause)->first();
        if ( $data)
        {
          
            $this->session->set('user_data',$data);
            return json_encode(array('status'=>200));
        }
        else{
            return json_encode(array('status'=>500));
        }
       
    }

    
    
    
    
    
    
    
    public function ci_default_page()
    {
        return view('welcome_message');
    }

   
}
