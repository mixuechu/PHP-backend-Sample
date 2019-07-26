<?php
    function alertWidget($message,$type=true){
        if ($message!='') { 
            $class=($type)?"danger":"success";
            return '<div class="alert alert-'.$class.'" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>     
                        '.$message.'</div>';
        }else {return '';}
        
    }
    function logout($from='admin'){
        foreach ($_SESSION as $key=>$val){
            if(preg_match('/'.$from.'/', $key)){
                unset($_SESSION[$key]);
            }
        }
        
    }
   
    
    /**
 * check the array key and return the value 
 * 
 * @param array $array
 * @return extract array value safely
 */


    function get_array_value(array $array, $key) {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }
    }


    function checksalesmanagerLogin($from='salesmanager'){
        if(isset($_SESSION[$from.'_logged_in']) && $_SESSION[$from.'_logged_in']){ 
            return true;
        }else{redirect('staff/index');}
    }


    

/**
 * prepare a anchor tag for any js request
 * 
 * @param string $title
 * @param array $attributes
 * @return html link of anchor tag
 */


    function js_anchor($title = '', $attributes = '') {
        $title = (string) $title;
        $html_attributes = "";

        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $html_attributes .= ' ' . $key . '="' . $value . '"';
            }
        }

        return '<a href="#"' . $html_attributes . '>' . $title . '</a>';
    }




/**
 * prepare a anchor tag for modal 
 * 
 * @param string $url
 * @param string $title
 * @param array $attributes
 * @return html link of anchor tag
 */


    function modal_anchor($url, $title = '', $attributes = '') {
        $attributes["data-act"] = "ajax-modal";
        if (get_array_value($attributes, "data-modal-title")) {
            $attributes["data-title"] = get_array_value($attributes, "data-modal-title");
        } else {
            $attributes["data-title"] = get_array_value($attributes, "title");
        }
        $attributes["data-action-url"] = $url;

        return js_anchor($title, $attributes);
    }


    
    
    function checkLogin(){
      
        if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in']=='1')
        {
            return true;
        }
        // else
        // {
        //     redirect('/admin/index');
            
        // }
    }
    
    function checkSchoolLogin($from='school'){
        if(isset($_SESSION[$from.'_logged_in']) && $_SESSION[$from.'_logged_in']){ 
            return true;
        }else{redirect('/'.$from.'/index');}
    }

    function checkstaffLogin($from='staff'){
        if(isset($_SESSION[$from.'_logged_in']) && $_SESSION[$from.'_logged_in']){ 
            return true;
        }else{redirect('/'.$from.'/index');}
    }

    function setLogo($name,$path='images'){
        if($name!=''){
            $path=$path.'/';
            return base_url().UPLOAD_PATH.$path.$name;
        }else{
            return base_url().DEFAULT_IMAGE;
        }
        
    }
    function activeClass($method,$array){
        return (in_array($method, $array))?'active':'';
    }
    function deleteFile($file,$path=''){
        if($file!=''){if(file_exists(UPLOAD_PATH.$path.DIRECTORY_SEPARATOR.$file)){unlink(UPLOAD_PATH.$path.DIRECTORY_SEPARATOR.$file);}}
    }
    /*New File Upload Code START ---------------------------------------------------------------------------*/
    function validateFile($data,$setError=false,$session){
        foreach($data as $rule){
            $field=$rule[0];$title=$rule[1];$allowExt=$rule[2];
            $isRequired=(isset($rule[3]) && $rule[3])?true:false;
            if(isset($_FILES[$field]) && $_FILES[$field]['tmp_name']!=''){
                $file=$_FILES[$field];
                $name=explode('.',$file['name']);
                $ext=$name[count($name)-1];
                if(!empty($allowExt) && !in_array($ext,$allowExt)){
                    if($setError){$session->set_flashdata('error',$title.' File not valid.');}
                    return ['status'=>0,'message'=>$title.' File not valid.','field'=>$field,'title'=>$title];
                }
            }else{if($isRequired){
                if($setError){$session->set_flashdata('error',$title.' File is required.');}
                return ['status'=>0,'message'=>$title.' File is required.','field'=>$field,'title'=>$title];}}
        } return ['status'=>1];
    }

    function fileUpload($fieldName,$uploadPath='',$Old=''){
        if(isset($_FILES[$fieldName]) && $_FILES[$fieldName]['tmp_name']!=''){
            if($uploadPath==''){$uploadPath='images';}
            $fileResult=fileUploadByField($fieldName,$uploadPath);
            if($fileResult['status']==1){
                if($Old!=''){deleteFile($Old,$uploadPath);
                }return ['status'=>1,'fileName'=>$fileResult['fileName']];
            }else{return $fileResult;}
        }else{return false;}
    }

    function fileUploadByField($field,$uploadPath){
        $file=$_FILES[$field];
        $name=explode('.',$file['name']);
        $ext=$name[count($name)-1];
        $fileName=time().rand(0,100).rand(0,100).'.'.$ext;
        if(move_uploaded_file($file['tmp_name'],UPLOAD_PATH.$uploadPath.DIRECTORY_SEPARATOR.$fileName)){
            return ['status'=>1,'fileName'=>$fileName];
        }else{return ['status'=>0,'message'=>'File upload Error.'];}
    }
    /*New File Upload Code END ---------------------------------------------------------------------------*/
    
    //send sms
    function curlPost($url,$fields){
        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
        rtrim($fields_string, '&');
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
    }
    function sendSingleSms($mobile,$otpcode){
        error_log('Mobile SMS ------------------------------------------->');
        error_log(print_r([$mobile],1));
        send_sms($mobile,$otpcode);
    }
   /* function sendsmsGET($mobileNumber,$message)
    {
        $senderId="MINSPO";
        $routeId="1";
        $authKey="8a12841f6d5c47c94488e653838c810";
        $getData = 'mobileNos='.$mobileNumber.'&message='.urlencode($message).'&senderId='.$senderId.'&routeId='.$routeId;
        //API URL
        $url="http://sms.romin.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey."&".$getData;
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0

        ));
        //get response
        $output = curl_exec($ch);
        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }*/
    
    function send_sms($mobile,$otpcode)
    {
        $id = "AC0f855fd4f5aad240c3f777bf04aa095b";
        $token = "e5f0cddfbcbf9ab1709be2d70fac5b3c";
        $url = "https://api.twilio.com/2010-04-01/Accounts/$id/SMS/Messages";
        $from = "+15005550006";
        $to = $mobile;
        $to = preg_replace('/[^0-9]/', '', $to);
        $to = "+91".$to;
          // echo $to;exit;
         //$to = "+919974302262"; // twilio trial verified number
         //$link = rawurldecode('http://satewebdemo.com/feedback/survey.php');
         //$link = rawurldecode('http://bit.ly/2MmtJEw');
        
        $body = "Your Login Password is ".$otpcode;
        // echo $body;exit;
        // $body = "using twilio rest api from Fedrick";
        $data = array (
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        );
        $post = http_build_query($data);
        $x = curl_init($url );
        curl_setopt($x, CURLOPT_POST, true);
        curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($x, CURLOPT_USERPWD, "$id:$token");
        curl_setopt($x, CURLOPT_POSTFIELDS, $post);
        $y = curl_exec($x);
        //print_r($y);exit;
        curl_close($x);

         
    }
    
    function test_email($email,$subject,$message,$header='',$parameter='-finfo@jmrhomeservices.com')
    {
        if(isset($_SESSION['office_id']))
        {
            $email_bcc = $_SESSION['office_username'];
            $name = $_SESSION['office_name'];
        }
        elseif(isset($_SESSION['admin_id']))
        {
            $email_bcc = $_SESSION['admin_email'];
            $name = $_SESSION['admin_name'];        
        }
         elseif(isset($_SESSION['sales_id']))
        {
            $email_bcc = $_SESSION['sales_username']; 
            $name = $_SESSION['sales_name'];     
        }
        elseif(isset($_SESSION['projectmanager_id']))
        {
            $email_bcc = $_SESSION['projectmanager_username'];
            $name = $_SESSION['projectmanager_name'];   
        }
        elseif(isset($_SESSION['salesmanager_id']))
        {
            $email_bcc = $_SESSION['salesmanager_username'];   
            $name = $_SESSION['salesmanager_name'];   

        }
         elseif(isset($_SESSION['forman_id']))
        {
            $email_bcc = $_SESSION['forman_username'];
            $name = $_SESSION['forman_name'];        
        }


        $to = $email;
        $fecha = new DateTime();
        
        $headers = 'From: JMR Home Services <info@jmrhomeservices.com>' . "\r\n" .
            'Reply-To: info@jmrhomeservices.com' . "\r\n" ."Reply-To:".$email_bcc."\r\n".
            'X-Mailer: PHP/' . phpversion() . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";

        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $headers .= "BCC:".$email_bcc."\r\n";
        $headers .= "Reply-To:".$email_bcc."\r\n";

        $subject = $subject;
        
        $message = $message;
        
        ini_set('SMTP', "relay-hosting.secureserver.net");
        ini_set('smtp_port', "25");
        
        mail( $to,$subject,$message,$headers,$parameter);
        
       // $sent = explode('@',$to);
        
       // header('Location:test.php?sent=' . $sent[0]);
    }
    
   


    function send_mail2($email,$subject,$message,$filename,$path)
    {
          $mail_to = $email;
          $from_mail = "info@jmrhomeservices.com";
          $from_name = "JMR Home Services";
          $reply_to = "info@jmrhomeservices.com";
          $subject = $subject;
          $message = $message;
         
        /* Attachment File */
          // Attachment location
          $file_name = $filename;
          $path = $path;
   
          // Read the file content
          $file = $path.$file_name;
          $file_size = filesize($file);
          $handle = fopen($file, "r");
          $content = fread($handle, $file_size);
          fclose($handle);
          $content = chunk_split(base64_encode($content));
           
        /* Set the email header */
          // Generate a boundary
          $boundary = md5(uniqid(time()));
           
          // Email header
          $header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
          $header .= "Reply-To: ".$reply_to.PHP_EOL;
          $header .= "MIME-Version: 1.0".PHP_EOL;
           
          // Multipart wraps the Email Content and Attachment
          $header .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"".PHP_EOL;
          $header .= "This is a multi-part message in MIME format.".PHP_EOL;
          $header .= "--".$boundary.PHP_EOL;
           
          // Email content
          // Content-type can be text/plain or text/html
          $header .= "Content-type:text/plain; charset=iso-8859-1".PHP_EOL;
          $header .= "Content-Transfer-Encoding: 7bit".PHP_EOL.PHP_EOL;
          $header .= "$message".PHP_EOL;
          $header .= "--".$boundary.PHP_EOL;
           
          // Attachment
          // Edit content type for different file extensions
          $header .= "Content-Type: application/xml; name=\"".$file_name."\"".PHP_EOL;
          $header .= "Content-Transfer-Encoding: base64".PHP_EOL;
          $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"".PHP_EOL.PHP_EOL;
          $header .= $content.PHP_EOL;
          $header .= "--".$boundary."--";
           
          // Send email
          if (mail($mail_to, $subject, "", $header,$parameter='-fmarketing@jmrhomeservices.com')) {
            echo "Sent";
          } else {
            echo "Error";
          }
    }
    function mailer_mail_send($email_to,$subject,$message,$filename,$path)
    {
        echo "hiiiii";exit;
      
        echo site_url('PHPMailer/src/PHPMailer');
        echo site_url('PHPMailer/src/Exception');
      

        $email = new PHPMailer();
        $email->From      = 'info@jmrhomeservices.com';
        $email->FromName  = 'JMR Home Services';
        $email->Subject   = $subject;
        $email->Body      = $message;
        $email->AddAddress($email_to);

        $file_to_attach = $path;

        $email->AddAttachment( $file_to_attach , $filename );

        return $email->Send();
    }

    function test_email3($mailto,$subject,$message,$filename,$path)
    {   
        //echo $mailto;exit;
              // $to = $email;
              //   $fecha = new DateTime();
              //   $parameter='-fmarketing@jmrhomeservices.com';
                
              //   $headers = 'From: JMR Home Services <marketing@jmrhomeservices.com>' . "\r\n" .
              //       'Reply-To: marketing@jmrhomeservices.com' . "\r\n" .
              //       'X-Mailer: PHP/' . phpversion() . "\r\n";
              //   $headers .= "MIME-Version: 1.0\r\n";

              //   $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                
              //   $subject = $subject;
                
              //   $message = $message;
                
              //   ini_set('SMTP', "relay-hosting.secureserver.net");
              //   ini_set('smtp_port', "25");
                
              //   mail( $to,$subject,$message,$headers,$parameter);


            //  $file = $path.$filename;
            // // echo $file;exit;
            //  $file_size = filesize($file);
            //  $handle = @fopen($file, "r");
            //  $content = @fread($handle, $file_size);
            //  fclose($handle);
            //  $content = chunk_split(base64_encode($content));
            //  $uid = md5(uniqid(time()));
            //  $header = "From: ".$from_name." <".$from_mail.">\r\n";
            //  $header .= "Reply-To: ".$replyto."\r\n";
            //  $header .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
            //  $header .= "MIME-Version: 1.0\r\n";
            //  $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            //  $header .= "This is a multi-part message in MIME format.\r\n";
            //  $header .= "--".$uid."\r\n";
            //  $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
            //  $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            //  $header .= $message."\r\n\r\n";
            //  $header .= "--".$uid."\r\n";
            //  $header .= "Content-Type: application/pdf; name=\"".$filename."\"\r\n"; // use different content types here
            //  $header .= "Content-Transfer-Encoding: base64\r\n";
            //  $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
            //  $header .= $content."\r\n\r\n";
            //  $header .= "--".$uid."--";
             
            //  //  echo $subject;
            //  //   echo $mailto;

            //   //echo $header;exit;
            // ini_set('SMTP', "relay-hosting.secureserver.net");
            // ini_set('smtp_port', "25");
            //  if (mail($mailto, $subject, "", $header)) {
            //  echo "mail send ... OK"; // or use booleans here
            //  } else {
            //  echo "mail send ... ERROR!";
            //  }




 $file_path=$path.$filename;//// Path to the file
// $file_path_type = "application/pdf";
// $subject = "Testing File attachment";
// $headers = "From: ".$from_mail. "\r\n" .
// "CC: vivek@sateweb.com";
// //$from ="test@femqueen.com"; //From email.
// //$message = 'Download the attached pdf';
// $message = "Hello!!<br>";
// $to ="himanshi100000@gmail.com"; //To email
// $file_path_name=$filename;
// $file = fopen($file_path,'rb');
// $data = fread($file,filesize($file_path));
// fclose($file);
// $semi_rand = md5(time());
// $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
// //Headers
// $headers .= "\nMIME-Version: 1.0\n" .
// "Content-Type: multipart/mixed;\n" .
// " boundary=\"{$mime_boundary}\"";
// $message .= "This is a multi-part message in MIME format.\n\n" .
// "–{$mime_boundary}\n" .
// "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
// "Content-Transfer-Encoding: 7bit\n\n" .
// $message .= "\n\n";
// //convert the attachment into a base64 string
// $data = chunk_split(base64_encode($data));
// $message .= "–{$mime_boundary}\n" .
// "Content-Type: {$file_path_type};\n" .
// " name=\"{$file_path_name}\"\n" .
// "Content-Transfer-Encoding: base64\n\n" .
// "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n" .
// $data .= "\r\n" .
// "–{$mime_boundary}–\n";


// ini_set('SMTP', "relay-hosting.secureserver.net");
// ini_set('smtp_port', "25");
// $sent = mail($to, $subject, $message, $headers);
// if($sent) {
// echo "Sent Succesfully";
// } else {
// die("Email not Delivered");
// }



            $NameFile = $filename;
            $File = $file_path;
            $to =$mailto;
            $From = "info@jmrhomeservices.com";

            $from_mail = "info@jmrhomeservices.com";
           $from_name = "JMR Home Services";

            $openfile = fopen($File, "rb");
            $data = fread($openfile,  filesize( $File ) );
            fclose($openfile);
            $File = $data;

        $EOL = "\r\n"; 
        $boundary     = "--".md5(uniqid(time()));
       // echo $message;exit;
        $message =$message;

        //$subject= '=?utf-8?B?' . base64_encode($subject) . '?=';
        $subject= $subject;

        // $headers = 'From: JMR Home Services <marketing@jmrhomeservices.com>' . "\r\n" .
        // 'Reply-To: marketing@jmrhomeservices.com' . "\r\n" .
        // 'X-Mailer: PHP/' . phpversion() . "\r\n";

        $headers    = "MIME-Version: 1.0;$EOL";   
        $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL"; 

        $headers   .= 'From: JMR Home Services <marketing@jmrhomeservices.com>' ."\n". 'Reply-To: marketing@jmrhomeservices.com' . "\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n";  

        $multipart  = "--$boundary$EOL";   
        $multipart .= "Content-Type: text/html; charset=utf-8$EOL";   
        $multipart .= "Content-Transfer-Encoding: base64$EOL";   
        $multipart .= $EOL;
        $multipart .= chunk_split(base64_encode($message));   

        $multipart .=  "$EOL--$boundary$EOL";   
        $multipart .= "Content-Type: application/octet-stream; name=\"$NameFile\"$EOL";   
        $multipart .= "Content-Transfer-Encoding: base64$EOL";   
        $multipart .= "Content-Disposition: attachment; filename=\"$NameFile\"$EOL";   
        $multipart .= $EOL; 
        $multipart .= chunk_split(base64_encode($File));   

        $multipart .= "$EOL--$boundary--$EOL";   
        ini_set('SMTP', "relay-hosting.secureserver.net");
        ini_set('smtp_port', "25");
        if(!mail($to, $subject, $multipart, $headers)){
            
            echo 'Mail not send';
            //die();
        }  
        else{
           echo 'Mail send';
      
        }


        }


    // function test_email3($to,$subject,$body,$filename,$path)
    // {
    
    //     if(isset($_SESSION['office_id']))
    //     {
    //         $email = $_SESSION['office_username'];
    //         $name = $_SESSION['office_name'];
    //     }
    //     elseif(isset($_SESSION['projectmanager_id']))
    //     {
    //         $email = $_SESSION['projectmanager_username'];
    //         $name = $_SESSION['projectmanager_name'];   
    //     }
    //     elseif(isset($_SESSION['salesmanager_id']))
    //     {
    //         $email = $_SESSION['salesmanager_username'];   
    //         $name = $_SESSION['salesmanager_name'];   

    //     }
    //     elseif(isset($_SESSION['sales_id']))
    //     {
    //         $email = $_SESSION['sales_username']; 
    //         $name = $_SESSION['sales_name'];     
    //     }
    //     elseif(isset($_SESSION['admin_id']))
    //     {
    //         $email = $_SESSION['admin_username'];
    //         $name = $_SESSION['admin_name'];        
    //     }
        
    //     $file = $path.$filename;
    //    // echo $file;exit;
    //     $message_array = array(
    //                      "headers" => array(
    //                          "Reply-To"=> "bansi@sateweb.com",
    //                          ),
    //                     "html" => $body,
    //                     "text" => $body, 
    //                     "subject" => $subject, 
    //                     "from_email" => 'support@jmrhomeservices.com', 
    //                     "track_opens" => true,
    //                     "track_clicks" => true,
    //                     "from_name"=>$name,
    //                     "to" => array(
    //                             0 => array(
    //                                 "email" => $to
    //                                 )),
    //                     "attachments" => array(
    //                                 array(
    //                                      "type"=> "application/pdf",
    //                                      "name"=>$filename,
    //                                      "content"=>base64_encode(file_get_contents($file)),
    //                                     )
    //                         ),


    //                    // "bcc" =>"himanshi@sateweb.com",
    //                    // "cc" =>"himanshi100000@gmail.com",
                        
    //                     );
    //                     //"headers":{
    //     //             "Reply-To":"message.reply@example.com"
    //     //         },
                        

    //           //  print_r( $message_array);exit;            

    //     $params = array("key" => "0EMzfCcq5L9aV6sm16niAQ", "message" =>$message_array, "async"=> true);
    // // print_r($params);exit;
    //     $params = json_encode($params);
    //     $messages_api_end_point = "https://mandrillapp.com/api/1.0/messages/send.json";
    //     $ch = curl_init($messages_api_end_point);
    //     curl_setopt($ch, CURLOPT_POST, TRUE);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //     'Content-Type: application/json',
    //     'Content-Length: ' . strlen($params))
    //     );
    //     $response = curl_exec($ch);
    //     $info = curl_getinfo($ch);
    //     $curl_error = curl_errno($ch);
    //     if ($info['http_code'] != 200) {
    //         $error_text = '';
    //         if (preg_match('/<title>(.*?)<\/title>/s', $response, $match)) {
    //             $error_text = $match[0];
    //         }
    //         return FALSE;
    //     }
    //     curl_close($ch);
    //    // print_r($response);
    // }


     
     

    function reply_email($to,$subject,$body)
    {
    //echo"heeeeeeeeeeeeeeeeeeeeeeellllllllllllllllllllllllllllllll";exit;
        // curl -A 'Mandrill-Curl/1.0' 
        // -d '{
        //     "key":"example key",
        //     "message":{
        //         "html":"<p>Example HTML content<\/p>",
        //         "text":"Example text content",
        //         "subject":"example subject",
        //         "from_email":"message.from_email@example.com",
        //         "from_name":"Example Name",
        //         "to":[{
        //             "email":"recipient.email@example.com",
        //             "name":"Recipient Name",
        //             "type":"to"
        //         }],
        //         "headers":{
        //             "Reply-To":"message.reply@example.com"
        //         },
        //         "important":false,
        //         "track_opens":null,
        //         "track_clicks":null,
        //         "auto_text":null,
        //         "auto_html":null,
        //         "inline_css":null,
        //         "url_strip_qs":null,
        //         "preserve_recipients":null,
        //         "view_content_link":null,
        //         "bcc_address":"message.bcc_address@example.com",
        //         "tracking_domain":null,
        //         "signing_domain":null,
        //         "return_path_domain":null,
        //         "merge":true,
        //         "merge_language":"mailchimp",
        //         "global_merge_vars":[{
        //                 "name":"merge1",
        //                 "content":"merge1 content"
        //             }],
        //         "merge_vars":[{
        //             "rcpt":"recipient.email@example.com",
        //             "vars":[{
        //                     "name":"merge2",
        //                     "content":"merge2 content"
        //                 }]
        //             }],
        //         "tags":[
        //             "password-resets"
        //             ],
        //         "subaccount":"customer-123",
        //         "google_analytics_domains":["example.com"],
        //         "google_analytics_campaign":"message.from_email@example.com",
        //         "metadata":{
        //                 "website":"www.example.com"
        //                 },
        //         "recipient_metadata":[{
        //                 "rcpt":"recipient.email@example.com",
        //                 "values":{
        //                         "user_id":123456
        //                         }
        //                 }],
        //         "attachments":[{
        //                 "type":"text\/plain",
        //                 "name":"myfile.txt",
        //                 "content":"ZXhhbXBsZSBmaWxl"
        //                 }],
        //         "images":[{
        //                 "type":"image\/png",
        //                 "name":"IMAGECID",
        //                 "content":"ZXhhbXBsZSBmaWxl"
        //                 }]},
        //         "async":false,
        //         "ip_pool":"Main Pool",
        //         "send_at":"example send_at"
        //         }' 'https://mandrillapp.com/api/1.0/messages/send.json';
        // if(isset($_SESSION['office_id']))
        // {
        //     $email = $_SESSION['office_username'];
        //     $name = $_SESSION['office_name'];
        // }
        // elseif(isset($_SESSION['projectmanager_id']))
        // {
        //     $email = $_SESSION['projectmanager_username'];
        //     $name = $_SESSION['projectmanager_name'];   
        // }
        // elseif(isset($_SESSION['salesmanager_id']))
        // {
        //     $email = $_SESSION['salesmanager_username'];   
        //     $name = $_SESSION['salesmanager_name'];   

        // }
        // elseif(isset($_SESSION['sales_id']))
        // {
        //     $email = $_SESSION['sales_username']; 
        //     $name = $_SESSION['sales_name'];     
        // }
        // elseif(isset($_SESSION['admin_id']))
        // {
        //     $email = $_SESSION['admin_username'];
        //     $name = $_SESSION['admin_name'];        
        // }
        

        $message_array = array(
                         "headers" => array(
                             "Reply-To"=> "bansi@sateweb.com",
                             ),
                        "html" => $body,
                        "text" => $body, 
                        "subject" => $subject, 
                        "from_email" => "vivek@jmrhomeservices.com", 
                        "from_name"=>"vivek",
                        "to" => array(
                                0 => array(
                                    "email" => $to
                                    )),
                        "bcc_address" =>"himanshi100000@gmail.com",
                        );
                        //"headers":{
        //             "Reply-To":"message.reply@example.com"
        //         },
                        

                //print_r( $message_array);exit;            

        $params = array("key" => "0EMzfCcq5L9aV6sm16niAQ", "message" =>$message_array, "async"
        => true,"bcc_address" =>"himanshi100000@gmail.com");
    // print_r($params);exit;
        $params = json_encode($params);
        $messages_api_end_point = "https://mandrillapp.com/api/1.0/messages/send.json";
        $ch = curl_init($messages_api_end_point);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($params))
        );
        $response = curl_exec($ch);
        $info = curl_getinfo($ch);
        $curl_error = curl_errno($ch);
        if ($info['http_code'] != 200) {
            $error_text = '';
            if (preg_match('/<title>(.*?)<\/title>/s', $response, $match)) {
                $error_text = $match[0];
            }
            return FALSE;
        }
        curl_close($ch);
       // print_r($response);
    }

    

?>