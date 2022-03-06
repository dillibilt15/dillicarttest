<?php

namespace App\Controllers\AdminControllers;

use App\Models\AdminUserModel;
class AdminDashboard extends AdminBaseController
{
    public $admin_user_model;
   
    public function index()
    {
        $data['main_content']='AdminViews/admin_dashboard';
        $data['header_title']='Dashboard';
        return view('AdminViews/admin_main_page',$data);
    }

   

   
}

?>