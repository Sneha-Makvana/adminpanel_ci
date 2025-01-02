<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'category_id', 'event_name', 'description', 'location', 'start_date', 'end_date', 'booking_ticket',
         'no_of_tickets','event_images'
    ];
}
?>

