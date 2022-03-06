<?php

namespace App\Controllers\AdminControllers;
use App\Models\AdminUserModel;
class AdminUser extends AdminBaseController
{
    public $admin_user_model;
   
    public function index()
    {
        return view('AdminViews/login_view');
    }

    public function admin_login_view()
    {
        return view('AdminViews/login_view');
    }
    public function admin_login_check()
    {
        $this->session->remove('admin_user_data');
        $this->session->remove('user_data');
        $email=$this->request->getPost('email');
        $pwd=$this->request->getPost('pwd');
        $this->admin_user_model = new AdminUserModel();
        $multiClause = array('user_email' =>$email, 'pwd' => md5(  $pwd), 'is_active' => "1" );
        $data=$this->admin_user_model->where($multiClause)->first();
        if ( $data)
        {
            $data['is_admin']=1;
            $this->session->set('admin_user_data',$data);
            return json_encode(array('status'=>200));
        }
        else{
            return json_encode(array('status'=>500));
        }
       
    }

   
}
?>