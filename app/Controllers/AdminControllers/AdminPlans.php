<?php

namespace App\Controllers\AdminControllers;

use App\Models\FileCapacityModel;
use App\Models\StorageCapacityModel;
use App\Models\UnlimitedPlansModel;
class AdminPlans extends AdminBaseController
{
    public $admin_user_model;
   
    public function index()
    {
        $data['main_content']='AdminViews/admin_plans';
        $data['header_title']='Plans';
       
        $file_model=new FileCapacityModel();
        $storage_model=new StorageCapacityModel();
        $ul_model=new UnlimitedPlansModel();

        $data['files_pl_data']= $file_model->findAll();
        $data['storage_pl_data']= $storage_model->findAll();
        $data['unlimited_pl_data']= $ul_model->findAll();



        return view('AdminViews/admin_main_page',$data);
    }

   

   
}

?>