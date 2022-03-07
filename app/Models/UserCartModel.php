<?php 
namespace App\Models;
use CodeIgniter\Model;
class UserCartModel extends Model
{
    protected $table = 'user_cart_details';
    protected $primaryKey = 'id';


    protected $allowedFields=["user_id","cart_details",];
}

?>