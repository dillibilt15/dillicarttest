<?php 
namespace App\Models;
use CodeIgniter\Model;
class AdminUserModel extends Model
{

    protected $table = 'admin_users';
    public function admin_login_check()
    {
       
        return json_encode(array('status'=>200));
    }

}

?>