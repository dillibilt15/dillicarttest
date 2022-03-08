<?php

namespace App\Controllers\UserControllers;
use App\Models\UserCartModel;
use App\Models\OrdersModel;
use App\Models\OrderDetailsModel;

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

    public function create_order()
    {
        $user_order_model = new OrdersModel();
        $user_order_details_model = new OrderDetailsModel();

    }
    
}

?>