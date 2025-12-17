<?php

$productId = validInt($_GET['id']);

if(ReqGet()){

    $request = [
        'id' => $productId
    ];

    $product = json_decode(callAPI('GET', 'product/v1/detail', $request, $headers),1);

    $data = [
        'product' => [
            'detail' => $product[0][0],
            'images' => $product[1],
        ],
        // 'product' => json_decode(callAPI('GET', 'product/v1/detail', $request, $headers),1),
        'categories' => json_decode(callAPI('GET', 'category/v1/view', [], $headers),1)
    ];
    // $data['product'][0] = $data['product'][0][0];
    // echo "<pre>"; print_r($data); exit;
    // check $_GET['action'] action
    require BASE_DIR.'layout/account/product/update.php';

} elseif(ReqPost()){

    $_POST['productId'] = $productId;
    print_r($_POST); exit;

    $uploadDirectory = BASE_DIR.'/public/img/uploads/';

    // upload images
    // Create the upload directory if it doesn't exist
    if (!is_dir($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    $uploadedFiles = [];
    $failedUploads = [];

    // Count the number of files uploaded
    $numFiles = count($_FILES['imgs']['name']);

    // Loop through each file
    for ($i = 0; $i < $numFiles; $i++) {
        // Get file details
        $fileName = $_FILES['imgs']['name'][$i];
        $fileTmpName = $_FILES['imgs']['tmp_name'][$i];
        $fileSize = $_FILES['imgs']['size'][$i];
        $fileError = $_FILES['imgs']['error'][$i];
        $fileType = $_FILES['imgs']['type'][$i];

        // Get file extension
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // Allowed extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png'];

        if (in_array($fileActualExt, $allowedExtensions)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { // Check file size (e.g., less than 5MB)
                    $fileNameNew = str_replace(' ','-',$_POST['product']).'-'.$_POST['sku'].uniqid('',true) . "." . $fileActualExt;
                    $fileDestination = $uploadDirectory . $fileNameNew;

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $uploadedFiles[] = $fileNameNew;
                    } else {
                        $failedUploads[] = "Error uploading {$fileName}: Failed to move uploaded file.";
                    }
                } else {
                    $failedUploads[] = "Error uploading {$fileName}: File is too large.";
                }
            } else {
                $failedUploads[] = "Error uploading {$fileName}: Error code {$fileError}.";
            }
        } else {
            if (!empty($fileName)) { // Only add an error if a file was actually selected
                $failedUploads[] = "Error uploading {$fileName}: Invalid file type. Only JPG, JPEG, and PNG are allowed.";
            }
        }
    };

    // print_r($uploadedFiles);
    // print_r($failedUploads);

    // save into db
    

    $_POST['imgs'] = $uploadedFiles;
    $_POST['viewId'] = $sess['typeId'];
    $_POST['customerId'] = base64_decode($sess['id']);
    
    // print_r($_POST); exit;

    $return = json_decode(callAPI('PUT', 'product/v1/update', $_POST, $headers),1);
    print_j($return);    

}    