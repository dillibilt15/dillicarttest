<?php 
namespace App\Models;
use CodeIgniter\Model;
class UserWalletHistoryModel extends Model
{
    protected $table = ' wallet_balance_history';
    protected $primaryKey = 'id';


    protected $allowedFields=["user_id","amount","balance","type", "transaction_dt", "description"];
}

?>