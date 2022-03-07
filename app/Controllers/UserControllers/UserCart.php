<?php

namespace App\Controllers\UserControllers;
use App\Models\UserCartModel;

class UserCart extends UserBaseController
{
    
   
    public function index()
    {
        $loged_in_user_id=$this->session->get('user_data')['id'];
        $user_cart_model = new UserCartModel();
        
        $data['main_content']='UserViews/user_cart';
        $data['header_title']='My Cart';
       
        $data['cart_details']=$this->get_cart_details($loged_in_user_id,$user_cart_model);
        return view('UserViews/user_main_page',$data);
    }

   
   private function get_cart_details($loged_in_user_id,  $user_cart_model )
   {
       
        $multiClause = array('user_id' =>$loged_in_user_id);
        return $user_cart_model->where($multiClause)->orderBy('id','desc')->findAll();
   }

   public function add_cart_item()
   {
        
        //$amount=$this->request->getPost('txt_add_amount');
        $loged_in_user_id=$this->session->get('user_data')['id'];
      $cart_details='';
        $user_cart_model = new UserCartModel();
       $user_cart_details= $this->get_cart_details($loged_in_user_id,$user_cart_model);

        $user_cart_data=array(
            "user_id"=>$loged_in_user_id,
            "cart_details"=> $cart_details,
            );
       if ( $user_cart_details)
       {
            if ( $user_cart_model->update($loged_in_user_id,$user_cart_data) )
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
   
}

?>