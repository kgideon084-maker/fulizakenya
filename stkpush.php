<?php
$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

// LOG KWA FILE
file_put_contents("payments.log", date('Y-m-d H:i:s')." - ".$payload."\n", FILE_APPEND);

if(isset($data['status']) && $data['status'] == 'Success'){
    // HAPA UPDATE DATABASE
    http_response_code(200);
    echo json_encode(["ResultCode" => 0]);
} else {
    http_response_code(200);
    echo json_encode(["ResultCode" => 1]);
}
?>
