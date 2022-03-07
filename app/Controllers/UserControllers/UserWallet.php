<?php

namespace App\Controllers\UserControllers;
use App\Models\UserModel;
use App\Models\UserWalletHistoryModel;

class UserWallet extends UserBaseController
{
    
   
    public function index()
    {
        $loged_in_user_id=$this->session->get('user_data')['id'];
        $user_wale_his_model = new UserWalletHistoryModel();
        if ($this->request->getPost('btn_add_amount'))
        {
            $this->add_wallet($loged_in_user_id,  $user_wale_his_model);
        }
        $data['main_content']='UserViews/user_wallet';
        $data['header_title']='My Wallet';
       
        $data['wallet_history']=$this->get_wallet_history($loged_in_user_id,$user_wale_his_model);
        return view('UserViews/user_main_page',$data);
    }

   
   private function get_wallet_history($loged_in_user_id,  $user_wale_his_model )
   {
       
        $multiClause = array('user_id' =>$loged_in_user_id);
        return $user_wale_his_model->where($multiClause)->orderBy('id','desc')->findAll();
   }

   private function add_wallet($loged_in_user_id,  $user_wale_his_model)
   {
        
        $amount=$this->request->getPost('txt_add_amount');
        if ($amount<=0)
        {
            return;
        }
        $balance=$this->session->get('user_data')['w_balance']+ $amount;
        $user_model = new UserModel();
        $multiClause = array('id' =>$loged_in_user_id);
        $user_bal_data=array("w_balance"=>  $balance);
        if ( $user_model->update($loged_in_user_id,$user_bal_data) )
        {
          
            $user_his_data=array(
                                    "user_id"=>$loged_in_user_id,
                                    "amount"=>  $amount,
                                    "balance"=>  $balance,
                                    "type"=>"Added To Wallet",
                                    "transaction_dt"=>date('Y-m-d H:i'),
                                    "description" =>"Amount Added Wallet"
                                );
            $user_wale_his_model->insert( $user_his_data);
         
           $_SESSION['user_data']['w_balance'] =$balance;
         
        }
   }
   
}

?>