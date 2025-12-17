<?php

// $_GET['id] != $_POST['id']

$request = [
    'id' => $_POST['id']
];

$deleted = json_decode(callAPI('DELETE','group/v1/delete',$request, $headers),1);

print_j($deleted);