<?php
/**
 * template name:Home
 * The template for displaying Home pages
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php endwhile; ?>



<?php

require 'vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = '123dfa';
$payload = [
    'iss' => 'localhost',
    'aud' => 'localhost',
    'username' => 'admin',
    'password' => 'admin'
];

$access_token_details = JWT::encode($payload, $key, 'HS256');
echo $access_token_details;
echo "</br>" . 123; 

$decoded = JWT::decode($access_token_details, new Key($key, 'HS256'));
print_r($decoded);



?>


<?php
get_footer();

