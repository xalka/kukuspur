<?php

require __dir__.'/../../.config/.config.php'; 
require __dir__.'/../../.core/.funcs.php';
// require __dir__.'/../../.config/.redis.php'; 
// require __dir__.'/../../.config/Redis/Connection.php'; 
// require __dir__.'/../../.config/Redis/Queue.php'; 
require __dir__.'/../../.core/.mongodb.php';
require __dir__.'/../../.core/.procedures.php';
require __dir__.'/../../.core/.mysql.php'; 

// POST request only
if(!ReqPost()) ReqBad();

$headers = getallheaders();

// 1. Receive json
$req = json_decode(file_get_contents('php://input'),1);

// 2. Validate

// 3. Check if title is exists
$dbdata = [
    'action' => 1,
    'customerId' => $headers['Customerid'],
    'groupId' => $headers['Groupid'],
    'title' => $req['title'],
    'message' => $req['message']
];

try {
    // 4. Save into mysql
    $return = PROC(Template($dbdata))[0][0];

    if($return['created']){

        $template = [
            '_id' => (int)$return['templateId'],
            'title' => $dbdata['title'],
            'message' => $dbdata['message'],
            'strlen' => (int)strlen($dbdata['message']),
            'groupId' => (int)$dbdata['groupId'],
            'created' => mongodate('NOW')
        ];

        $return2 = mongoInsert(CTEMPLATE,$template);

        if($return2){
            $response = [
                'status' => 201
            ];
        }    

    }

} catch (Exception $e) {
    $response = [
        'status' => 401,
        'error' => $e->getMessage()
    ];    
}

// 7. Respond with a json
print_j($response);