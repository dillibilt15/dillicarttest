<?php 
namespace App\Models;
use CodeIgniter\Model;
class OrdersModel extends Model
{
    protected $table = 'user_orders';
    protected $primaryKey = 'id';


    protected $allowedFields=["user_id","items_price","order_dt","discount","tax_amount","grand_total","tax_percent"];
}

?>