<?
if (array_key_exists('name3', $_POST)) {
   $to = 'lozhkipovareshki@mail.ru';
   $subject = 'Новое сообщение с сайта [Обратный звонок]';
   $subject = "=?utf-8?b?". base64_encode($subject) ."?=";
   $message = "Имя: ".$_POST['name3']."\nТелефон: ".$_POST['phone3']."\nIP: ".$_SERVER['REMOTE_ADDR'];
   $headers = 'Content-type: text/plain; charset="utf-8"';
   $headers .= "MIME-Version: 1.0\r\n";
   $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";
   mail($to, $subject, $message, $headers);
   echo $_POST['name3'];
}
?>