CREATE TABLE `admin_api`.`user` (`id` INT NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL ), `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ENGINE = InnoDB;

CREATE TABLE `admin_api`.`customer` (`id` INT NOT NULL , `name` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `gender` ENUM('male','female') NOT NULL , `address` VARCHAR(255) NOT NULL , `city` VARCHAR(255) NOT NULL , `phone_no` INT(10) NOT NULL , `profile_image` VARCHAR(255) NOT NULL ) ENGINE = InnoDB;

CREATE TABLE `admin_api`.`products` (`id` INT NOT NULL AUTO_INCREMENT , `product_name` VARCHAR(255) NOT NULL , `description` TEXT NOT NULL , `quantity` INT NOT NULL , `price` DECIMAL NOT NULL , `category_id` INT NOT NULL , `size` VARCHAR(255) NOT NULL , `product_image` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `admin_api`.`orders` (`id` INT NOT NULL , `customer_id` INT NOT NULL , `product_id` INT NOT NULL , `order_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `total` DECIMAL NOT NULL , `quantity` INT NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ) ENGINE = InnoDB;

<head>
    <title>Login</title>
    <link href="<?= base_url('public/assets/css/app.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

in apidog enter this url http://localhost/sneha/codeigniter/adminpanel_api/login method post enter email
admin@gmail.com

password  123456  why not login succrsfully why this error {
    "status": false,
    "message": ""
} proper code 