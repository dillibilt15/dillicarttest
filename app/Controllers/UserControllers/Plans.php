<?php

namespace App\Controllers\UserControllers;

use App\Models\FileCapacityModel;
use App\Models\StorageCapacityModel;
use App\Models\UnlimitedPlansModel;
class Plans extends UserBaseController
{
    
   
    public function index()
    {
        $data['main_content']='UserViews/plans';
        $data['header_title']='Plans';

 
        $file_model=new FileCapacityModel();
        $storage_model=new StorageCapacityModel();
        $ul_model=new UnlimitedPlansModel();

        $data['files_pl_data']= $file_model->findAll();
        $data['storage_pl_data']= $storage_model->findAll();
        $data['unlimited_pl_data']= $ul_model->findAll();

        return view('UserViews/user_main_page',$data);
    }

   

   
}

?>