<?php

// $_GET['id] != $_POST['id']


$request = [
    'id' => validInt($_POST['id'])
];

print_j(json_decode(callAPI('DELETE','customer/v1/suspend',$request, $headers),1));