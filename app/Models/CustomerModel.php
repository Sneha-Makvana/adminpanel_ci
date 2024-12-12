<?php
namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'email', 'gender', 'address', 'city', 'phone_no', 'profile_image'
    ];
}

?>