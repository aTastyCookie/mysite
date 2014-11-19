<?php

require 'PHPMailer/PHPMailerAutoload.php';


  if (isset($_POST['submit'])) { 
   	$name    = (isset($_POST['name'])) ? filter_var(input_check($_POST['name']), FILTER_SANITIZE_STRING):'';
   	$email   = (isset($_POST['email'])) ? filter_var(input_check($_POST['email']), FILTER_SANITIZE_EMAIL):'';
   //	$phone   = (isset($_POST['phone'])) ? filter_var(input_check($_POST['phone'] ), FILTER_SANITIZE_STRING):'';
   	$message = (isset($_POST['message'])) ? filter_var(input_check($_POST['message']), FILTER_SANITIZE_STRING):'';
   	

   	      	$errors = array();
      	$output = array();
   	    if(empty($name) || strlen($name) < 2){
			//name error
		   $errors[] = array('error' => 'Name field cannot be empty','target'=>'name');        		
		}
   	 	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
         //email error
          $errors[] = array('error' => 'Please enter a valid email!','target'=>'email');        
	       } 
        
       // if(!is_numeric($phone)){
			//phone error
		//}
		
		if(empty($message) || strlen($message) < 4){			//message error
		
				 $errors[] = array('error' => 'Name field cannot be empty','target'=>'name');        			
		}
		
		if(count($errors) > 0){
		  $output['errors'] = $errors;
		}else{
			//add phpmailer call 
			$mail = new PHPMailer;


            $mail->isMail();     
            //$mail->isSMTP();                                      // Set mailer to use SMTP
            //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
            //$mail->SMTPAuth = true;                               // Enable SMTP authentication
            //$mail->Username = 'user@example.com';                 // SMTP username
            //$mail->Password = 'secret';                           // SMTP password
            //$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
 
            $mail->From = $email;
            $mail->FromName =  $name;
            $mail->addAddress('ant1freezeca@gmail.com','Roman');               // Name is optional
            $mail->addReplyTo($email, $name);
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
 
            $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //$mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'Email Sent From Your Website';
            $mail->Body    = $message;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			if(!$mail->send()) {
             $output['errors'][] = array('error' => 'Message could not be sent. Please, try again later.','target'=>'result');
              // echo 'Mailer Error: ' . $mail->ErrorInfo;
             } else {
             $output['success'] = array('message'=>'Message has been sent');
           }
		}
		
		echo json_encode($output);
		exit;
          	
   }
   
   
  function input_check($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data); 
    
  return $data;
  }
   	
?>