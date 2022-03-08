<?php

namespace App\Controllers\UserControllers;

use App\Models\FileCapacityModel;
use App\Models\StorageCapacityModel;
use App\Models\UnlimitedPlansModel;
use App\Models\UserCartModel;
class Plans extends UserBaseController
{
    
   
    public function index()
    {
        $file_model=new FileCapacityModel();
        $storage_model=new StorageCapacityModel();
        $ul_model=new UnlimitedPlansModel();
        $user_cart_model = new UserCartModel();
        $data['main_content']='UserViews/plans';
        $data['header_title']='Plans';
        $data['cart_details']=array();
       
        $loged_in_user_id=$this->session->get('user_data')['id'];
       
        $user_cart_details=get_cart_details($loged_in_user_id,$user_cart_model);
        if (count( $user_cart_details)>0)
        {
            if ($user_cart_details[0]['cart_details']=='')
            {
               
            }
            else{
                $data['cart_details']=json_decode($user_cart_details[0]['cart_details']);
               
            }
        }
 
       

        $data['files_pl_data']= $file_model->findAll();
        $data['storage_pl_data']= $storage_model->findAll();
        $data['unlimited_pl_data']= $ul_model->findAll();

        return view('UserViews/user_main_page',$data);
    }
    
 
   

   
}

?>