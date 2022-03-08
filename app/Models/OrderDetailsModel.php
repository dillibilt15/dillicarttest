<?php 
namespace App\Models;
use CodeIgniter\Model;
class OrderDetailsModel extends Model
{
    protected $table = 'user_order_details';
    protected $primaryKey = 'id';


    protected $allowedFields=["order_id","item_name","validity","transaction_dt","item_capacity","item_amount","qty"];
}

?>