<?php
$ch = curl_init("https://langame.ru/panel/comments/send-mails?s=!dw23@saf");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);
echo $data;
?>