<?php 
namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'user_orders';
    protected $primaryKey = 'id';


    protected $allowedFields=["user_id","items_price","order_dt","discount","tax_amount","grand_total","tax_percent"];

public function create_order($order_data,$cart_item_details,$cuurent_balance,&$order_id, $cart_main_id)
{
    try{
        $this->db->transBegin();
        $this->insert($order_data);
    
        $user_order_detail_model = new OrderDetailsModel();

        $order_id=$this->getInsertID();
        foreach($cart_item_details as $rec)
        {
            $item_name='Files';

            if ($rec->f_type=='GB')
            {
                $item_name='Storage';
            }
            $order_details_data=array(
                'order_id'=>$order_id,
                "item_name"=>$item_name,
                "transaction_dt"=>date('Y-m-d H:i'),
                "validity"=> $rec->validity,
                "item_capacity"=> $rec->capacity. ' '.$rec->f_type,
                "item_amount"=> $rec->price,
                "qty"=> 1,
                );
            $user_order_detail_model->insert($order_details_data);

        }
        
        $user_model=new UserModel();

        $balance=$cuurent_balance - $order_data['grand_total'];
        $user_model->update($order_data['user_id'],array('w_balance'=>$balance));

        $user_cart_model=new UserCartModel();
        $user_cart_model->delete( $cart_main_id);
    
        if ($this->db->transStatus() === FALSE)	{
            $this->db->transRollback();
            
            return false;
        } else {
            $this->db->transCommit();
            $_SESSION['user_data']['w_balance'] =$balance;
            return true;
        }
    }
    catch(\Exception $e) 
    {
        $this->db->transRollback();
          
        return false;
    }
  
}

}

?>