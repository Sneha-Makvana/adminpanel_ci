<?php
namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'event_id', 'customer_id', 'total', 'qty'
    ];
}
?>

