<?php

namespace App\Controllers\UserControllers;
use App\Models\UserModel;
use App\Models\UserCartModel;
use App\Models\OrdersModel;


class UserOrders extends UserBaseController
{

    public function index()
    {
        $loged_in_user_id=$this->session->get('user_data')['id'];
        $user_order_model = new OrdersModel();
        
        $data['main_content']='UserViews/my_orders';
        $data['header_title']='My Orders';
        $data['cart_details']=array();
        $data['total_details']=array();

        return view('UserViews/user_main_page',$data);

    }

    public function create_order_by_wallet()
    {
        
        $loged_in_user_id=$this->session->get('user_data')['id'];
        $user_cart_model = new UserCartModel();
        $user_cart_details= get_cart_details($loged_in_user_id,$user_cart_model);
        if (count( $user_cart_details)>0)
        {
            if ($user_cart_details[0]['cart_details']=='')
            {
                echo json_encode(array('status'=>500,'message'=>'There is no cart items'));
                    exit();
            }
            else{
                $cart_item_details=json_decode($user_cart_details[0]['cart_details']);
                 $total_details=final_prices ($cart_item_details);
            }
        }
        else{
            echo json_encode(array('status'=>500,'message'=>'There is no cart items'));
            exit();

        }

        $user_model = new UserModel();
        $multiClause = array('id' =>$loged_in_user_id);
        $user_data= $user_model->where($multiClause)->findAll();
        if (count($user_data)>0)
        {
            if ($total_details['grand_total']> $user_data[0]['w_balance'])
            {
                echo json_encode(array('status'=>500,'message'=>'There is no sufficinet balance'));
                exit();
            }
        }

        $order_data=array('user_id'=>$loged_in_user_id,
        "items_price"=>$total_details['items_price'],
        "order_dt"=>date('Y-m-d H:i'),
        "discount"=> $total_details['discount'],
        "tax_amount"=> $total_details['tax_amount'],
        "grand_total"=> $total_details['grand_total'],
        "tax_percent"=> TAX_PERCENTAGE,
        );

        
        
        $user_order_model = new OrdersModel();
        $user_order_model->create_order($order_data,$cart_item_details);
      

        

    }
    
   
}

?>