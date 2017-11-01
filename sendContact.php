<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
require_once ('recaptchalib.php');

// secret key
$secret = $_POST['secret'];
$from   = $_POST['from'];
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
    $_SERVER["REMOTE_ADDR"],
    $_POST["g-recaptcha-response"]
    );
}

if ( isset($_POST['name']) &&  isset($_POST['email']) && isset($_POST['message']) ){
    $fullname   = trim(sanitize_text_field($_POST['name']));
    $phone      = trim(sanitize_text_field($_POST['phone']));
    $email      = trim(sanitize_email($_POST['email']));
    $theMessage = trim(sanitize_text_field($_POST['message']));


    $message  = "Name :" . $fullname ."\n <br/>";
    $message  = "Phone :" . $phone ."\n <br/>";
    $message .= "Email :" . $email     ."\n <br/>";
    $message .= "Message :\n<br />" . $theMessage  ."\n <br/>";

    //set the form headers

    $subject = 'Contact from your website';

    // get the info from the from the form
    $to = $_POST['to'];
    $body = $message;
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: '.$from.'');
    
    if ($response != null && $response->success){
        $success = false;
        $success = wp_mail( $to, $subject, $body, $headers );
        if($success){
            $response_array['status'] = 'success';  
        }else{
            $response_array['status'] = 'failure';
            
        }
    }else{
        $response_array['message'] = 'Problem with Captcha!';
    }
   
}else{
    $response_array['status'] = 'input_failure';
}
header('Content-type: application/json');
echo json_encode($response_array);

?>