<?php
// call api from apilayer
function getData( $base ='MYR'){

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/fixer/latest?base=" . $base,
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: xYyc015iqH5Cgq0e7glekzlWRkTFihS9"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $response = curl_exec($curl);


    if (curl_errno($curl)) {

        $error_message = curl_error($curl);
        curl_close($curl);
        return array('error' => true, 'message' => "cURL error: $error_message");
    }


    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($http_status >= 400) {
        curl_close($curl);
        return array('error' => true, 'message' => "HTTP error: $http_status");
    }

    curl_close($curl);

    $data = json_decode($response, true);

    return $data;
}

// according to wikipedia , A number is called "even" if it is an integer multiple of 2
function checkEven($num){
    if(!is_numeric($num)){
        return false;
    }

    if($num % 2 == 0){
        return true;
    }
    else{
        return false;
    }
}

// return Malaysia time format
function getFormattedTime($timestamp){

    if(!is_numeric($timestamp)){
        return false;
    }

    $dateTime = new DateTime("@$timestamp");

    $malaysiaTimeZone = new DateTimeZone('Asia/Kuala_Lumpur');
    $dateTime->setTimezone($malaysiaTimeZone);

    return $formattedTime = $dateTime->format('H:i:s');

}
?>