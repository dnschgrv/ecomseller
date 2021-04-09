<?php
$sendto = "d.chigarev@sellecom.ru";//! Замените на свой почтовый ящик
$usermail = $_POST['email'];
$username = $_POST['name'];
$userphone = $_POST['phone'];
$content = nl2br($_POST['msg']);


// Формирование заголовка письма
$subject = "Новое сообщение";
$headers = "From: " . strip_tags($usermail) . "\r\n";
$headers .= "Reply-To: ". strip_tags($usermail) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html;charset=utf-8 \r\n";
// Формирование тела письма
$msg = "<html><body style='font-family:Arial,sans-serif;'>";
$msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Новое сообщение</h2>\r\n";
$msg .= "<p><strong>Имя:</strong> ".$username."</p>\r\n";
$msg .= "<p><strong>Номер телефона:</strong> ".$userphone."</p>\r\n";
$msg .= "<p><strong>Почта:</strong> ".$usermail."</p>\r\n";
$msg .= "<p><strong>Сообщение:</strong> ".$content."</p>\r\n";
$msg .= "</body></html>";
$b24Url = "https://dtg.bitrix24.ru";
$b24UserID = "96";
$b24WebHook = "4tmwbpkxwi83oirb";

$queryURL = "https://dtg.bitrix24.ru/rest/96/4tmwbpkxwi83oirb/crm.lead.add.json";

//$arr = [172, 414, 90, 170, 92];
//shuffle($arr);
//$key = array_rand($arr);
$spec_id = 560;
$queryData = http_build_query(array(
  "fields" => array(
    "TITLE" => "Сайт SELLECOM.RU(FBS)",
	"COMMENTS" => $content,
    "NAME" => $username,

    'ASSIGNED_BY_ID' => $spec_id,
    'SOURCE_DESCRIPTION' => $url,
    'EMAIL' => Array(
      "n0" => Array(
        "VALUE" => $usermail,
        "VALUE_TYPE" => "WORK",
      ),
    ),

    "PHONE" => array(
      "n0" => array(
        "VALUE" =>  $userphone,
        "VALUE_TYPE" => "MOBILE",
      ),
    ),
  ),
  'params' => array("REGISTER_SONET_EVENT" => "Y")	// Y = произвести регистрацию события добавления лида в живой ленте. Дополнительно будет отправлено уведомление ответственному за лид.
));

// отправляем запрос в Б24 и обрабатываем ответ
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_POST => 1,
  CURLOPT_HEADER => 0,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_URL => $queryURL,
  CURLOPT_POSTFIELDS => $queryData,
));
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result,1);

// если произошла какая-то ошибка - выведем её
if(array_key_exists('error', $result))
{
  die("Ошибка при сохранении лида: ".$result['error_description']);
}

echo "Лид добавлен в CRM";
// отправка сообщения
if(@mail($sendto, $subject, $msg, $headers)) {
	echo "true";
} else {
	echo "false";
}
?>
<?php



?>