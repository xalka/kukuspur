<?php

$user = json_decode(callAPI('PUT','customer/v1/update',$_POST, $headers),1);

print_j($user);