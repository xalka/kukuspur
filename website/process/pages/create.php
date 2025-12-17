<?php

if(!isset($_GET['type'])) $_GET['type'] = null;

switch ($_GET['type']) {

    case 'file':
        $upload = uploadContactsFile($_FILES['file'],$_POST['title']);

        if(isset($upload['status']) && $upload['status'] == 400){
            print_j($upload);
            exit;
        }

        $request = [
            'title' => $_POST['title'],
            'contacts' => $upload
        ];
        break;
        
    default:
        $_POST = json_decode(file_get_contents('php://input'),1);
        
        foreach ($_POST['contacts'] as &$contact) {
            $parts = explode(' ', trim($contact['names']), 2);
            $contact['fname'] = $parts[0] ?? '';
            $contact['lname'] = $parts[1] ?? '';
            unset($contact['names']);
            $contact['phone'] = validPhone($contact['phone']);
            $contacts[] = $contact;
        }
        
        $request = [
            'title' => $_POST['title'],
            'contacts' => $contacts
        ];
        break;
}

print_j(json_decode(callAPI('POST','group/v1/create',$request, $headers),1));