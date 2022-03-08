<?php

namespace App\Controllers\UserControllers;
use App\Models\UserCartModel;
use App\Models\FileCapacityModel;
use App\Models\StorageCapacityModel;
use App\Models\UnlimitedPlansModel;

class UserCart extends UserBaseController
{
    
   
    public function index()
    {
        $loged_in_user_id=$this->session->get('user_data')['id'];
        $user_cart_model = new UserCartModel();
        
        $data['main_content']='UserViews/user_cart';
        $data['header_title']='My Cart';
        $data['cart_details']=array();
        $data['total_details']=array();
       
        $user_cart_details=get_cart_details($loged_in_user_id,$user_cart_model);

        if (count( $user_cart_details)>0)
        {
            if ($user_cart_details[0]['cart_details']=='')
            {
               
            }
            else{
                $data['cart_details']=json_decode($user_cart_details[0]['cart_details']);
                 $data['total_details']=final_prices ($data['cart_details']);
            }
        }
        return view('UserViews/user_main_page',$data);
    }


    
  
   public function add_cart_item()
   {
        
        $plan_id=$this->request->getPost('plan_id');
        $capacity=$this->request->getPost('capacity');
        $validity=$this->request->getPost('validity');
        $f_type=$this->request->getPost('f_type');
        $price=$this->set_price( $plan_id,  $capacity, $validity,$f_type);
        if ( empty($price))
        {
            echo json_encode(array('status'=>200));
            exit();

        }

        $new_item=array(
                            "plan_id"=>$plan_id,
                            "capacity"=>$capacity,
                            "validity"=>$validity,
                            "f_type"=>$f_type,
                            "price"=>$price,
                         );
        

                         $db_data=array();
        $loged_in_user_id=$this->session->get('user_data')['id'];
      $cart_details='';
        $user_cart_model = new UserCartModel();
       $user_cart_details= get_cart_details($loged_in_user_id,$user_cart_model);
        if (count( $user_cart_details)>0)
        {
            if ($user_cart_details[0]['cart_details']=='')
            {
                $db_data[]=$new_item;
                
            }
            else{
                $db_data=json_decode($user_cart_details[0]['cart_details']);
                $db_data[]=$new_item;
            }
        }
        else{
            $db_data[]=$new_item;
        }
        $user_cart_data=array(
            "user_id"=>$loged_in_user_id,
            "cart_details"=> json_encode($db_data),
            );
       if ( $user_cart_details)
       {
            if ( $user_cart_model->update($user_cart_details[0]['id'],$user_cart_data) )
            { 
                echo json_encode(array('status'=>200));
                exit();
            }
            else{
                echo json_encode(array('status'=>500));
                exit();
            }
       }
        else{
            if (  $user_cart_model->insert( $user_cart_data) )
            { 
               echo json_encode(array('status'=>200));
               exit();
            }

            else{
                echo json_encode(array('status'=>500));
                exit();
            }
        }
          
         
        
   }
 
   public function remove_cart_item()
   {
        $loged_in_user_id=$this->session->get('user_data')['id'];
        $user_cart_model = new UserCartModel();
        $user_cart_details= get_cart_details($loged_in_user_id,$user_cart_model);
        $db_data=array();
                
        if (count( $user_cart_details)>0)
        {
            if ($user_cart_details[0]['cart_details']=='')
            {
               
            }
            else{
                $db_data=json_decode($user_cart_details[0]['cart_details']);
               
            }
        }
        $plan_id=$this->request->getPost('plan_id');
        $capacity=$this->request->getPost('capacity');
        $validity=$this->request->getPost('validity');
        $f_type=$this->request->getPost('f_type');
        $final_db=array();
        foreach($db_data as $d_rec)
        {
            if  (   ($d_rec->plan_id==$plan_id) &&
                    ($d_rec->capacity==$capacity) &&
                    ($d_rec->validity==$validity) &&
                    ($d_rec->f_type==$f_type) 
                ) 
            {
                
            }
            else
            {
                $final_db[]=$d_rec;
            }

        }
        $user_cart_data=array(
                    "user_id"=>$loged_in_user_id,
                    "cart_details"=> json_encode($final_db),
                    );
        if ( $user_cart_model->update($user_cart_details[0]['id'],$user_cart_data) )
            { 
                echo json_encode(array('status'=>200));
                exit();
            }
            else{
                echo json_encode(array('status'=>500));
                exit();
            }
       
      
   }
   private function ul_get_price($ul_model,$plan_id,$typ_ul,$validity)
   {
        $multiClause = array('id' =>$plan_id,'plan_name'=>$typ_ul);
        $ul_data=$ul_model->where($multiClause)->first();
        $ul_price=0;
        if ($ul_data)
        {
            if ( $validity=='Monthly')
            {
                $ul_price= $ul_data['m_amount'];
            }
            else{
                    $ul_price= $ul_data['y_amount'];
            }
        }
        return $ul_price;
    }
    private function set_price( $plan_id,  $capacity, $validity,$f_type)
    {
        $file_model=new FileCapacityModel();
        $storage_model=new StorageCapacityModel();
        $ul_model=new UnlimitedPlansModel();
        $f_price=0;
        if ($capacity=='Unlimited')
        {
            if ( $f_type=='GB')
            {
                $f_price= $this->ul_get_price($ul_model,$plan_id,'Storage',$validity);
            }
            else {
                $f_price= $this->ul_get_price($ul_model,$plan_id,'Files',$validity);
            }

        }
        else{
            if ( $f_type=='GB')
            {
                
                $f_price= $this->get_item_price($storage_model,$plan_id,$validity);
            }
            elseif ( $f_type=='Files')
            {
                            
                $f_price= $this->get_item_price($file_model,$plan_id,$validity);
            }

        }
         return $f_price;   

    }

    private function get_item_price($t_model,$plan_id,$validity)
    {
        $item_price=0;
         $multiClause = array('id' =>$plan_id);
         $ul_data=$t_model->where($multiClause)->first();
         if ($ul_data)
         {
             if ( $validity=='Monthly')
             {
                 $item_price= $ul_data['m_amount'];
             }
             else{
                     $item_price= $ul_data['y_amount'];
             }
         }
         return $item_price;
     }
   
}

?>