<?php
$username= filter_var(trim($_POST['username']), FILTER_VALIDATE_REGEXP,
    array('options'=>array('regexp'=>'/^[\w]+$/')));
$cn=mysqli_connect('localhost', 'Axtung', '123', 'social_network') or handl_error("Возникла ошибка при подключении к базе данных", mysqli_connect_error($cn));
$stmt= mysqli_prepare($cn, 'SELECT id FROM user WHERE user_name=(?)');
mysqli_stmt_bind_param($stmt, 's', $username);
$answ= mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $id);
mysqli_stmt_fetch($stmt);
if ($id) {
    $result='false';
}
else {
    $result='true';
}
echo $result;?>

