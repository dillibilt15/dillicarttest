<?php 
namespace App\Models;
use CodeIgniter\Model;
class OrderDetailsModel extends Model
{
    protected $table = 'user_order_details';
    protected $primaryKey = 'id';


    protected $allowedFields=["order_id","item_name","item_plan_type","transaction_dt","item_capacity","item_amount","qty"];
}

?>