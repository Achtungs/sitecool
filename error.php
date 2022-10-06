<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Ошибка</title>
    <link rel="stylesheet" href="style.css" />

</head>
<body>
<header style='color: black;'>Наша социальная сеть</header>
<h1 style='color: black;'>Произошла ошибка</h1>
<table><tr>
        <td><img src="error2.jpg" alt="Ошибка" class="center"></td>
        <td style='color: black;'>Уважаемый, Пользователь!<br>
            Наша система не смогла обработать Ваше последнее действие. Мы уже в курсе проблемы и предпримем все возможные действия, чтобы Вас не огорчать.<br>
            С уважением, группа поддержки.<br>
            Если хотите вернуться назад, то можете <a href="javascript:history.go(-1)">щелкнуть здесь</a><br>
            Обратиться лично: razvadilovolohov@mail.ru
    </tr></table><br>
<p>Технические детали:<br></p>
<?php
if (isset($_GET['error_message'])){
    $error_message=preg_replace("/\\\\/", '', $_GET['error_message']);}
else {
    $error_message="Вы здесь оказались из-за сбоя в программе.";}

if (isset($_GET['system_error_message'])){
    $system_error_message=preg_replace("/\\\\/", '', $_GET['system_error_message']);}
else {$system_error_message="Сообщения о системных ошибках отсутствуют";}
echo ("<p style='color: black;'>" . $error_message . "</p>");
echo("<p style='color: black;'>Было получено сообщение системного характера:</p>
 <b style='color: black;'>{$system_error_message}</b>");?>
<br><br>
<footer style='color: black;'>Белов, Янулявичус</footer>
</body>
</html>
