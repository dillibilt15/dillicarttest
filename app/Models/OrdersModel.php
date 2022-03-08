<?php 
namespace App\Models;
use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'user_orders';
    protected $primaryKey = 'id';


    protected $allowedFields=["user_id","items_price","order_dt","discount","tax_amount","grand_total","tax_percent"];

public function create_order($order_data,$cart_item_details)
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
        
    
        if ($this->db->transStatus() === FALSE)	{
            $this->db->transRollback();
            
            return false;
        } else {
            $this->db->transCommit();
            
            return true;
        }
    }
    catch(\Exception $e) 
    {
        $this->db->transRollback();
    }
  
}

}

?>