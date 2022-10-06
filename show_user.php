<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Данные пользователя</title>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript"src="Script.js"></script>
</head>
<body>
<header>Наша социальная сеть</header>
<?php
//mkdir("/path/to/profile", 0700);
require_once('app_config.php');//функция обработки ошибок
$cn=mysqli_connect('localhost', 'Axtung', '123', 'social_network') or handl_error("Возникла ошибка при подключении к базе данных", mysqli_connect_error($cn));
$image_fieldname="user_pic";//файл загружался с этой меткой в html форме
$php_errors=array(1 => 'Превышен максимальный размер файла',
    2 => 'Превышен максимальный размер файла',
    3 => 'Была отправлена только часть файла',
    4 => 'Файл для отправки не был выбран');//возможные ошибки

$first_name=filter_input(INPUT_POST, 'fst-username', FILTER_VALIDATE_REGEXP,
    array('options'=> array('regexp'=>'/(^[A-Za-z]+$)|(^[А-ЯЁа-яё]+$)/u'))) or
$error_message=true;

$last_name=filter_input(INPUT_POST, 'lst-username', FILTER_VALIDATE_REGEXP,
    array('options'=> array('regexp'=>'/(^[A-Za-z]+$)|(^[А-ЯЁа-яё]+$)/u'))) or
$error_message=true;

$email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) or
$error_message=true;

$vk_url=filter_input(INPUT_POST, 'VK', FILTER_VALIDATE_REGEXP,
        array('options'=> array('regexp'=>'/^(vk.com).{3,}$/')))or
$error_message=true;

$position=strpos($vk_url, "https://");
if ($position===false){$vk="https://" . $vk_url;}
$username=filter_input(INPUT_POST, 'username',FILTER_VALIDATE_REGEXP, array('options'=>array('regexp'=>'/^[\w]+$/'))) or $error_message=true;;
$password=$_POST['password'];


//Проверим загрузку файла и является ли он изображением
($_FILES[$image_fieldname]['error']==0) or
handl_error("Сервер не может получить выбранное Вами изображение", $php_errors[$_FILES[$image_fieldname]['error']]);
@is_uploaded_file($_FILES[$image_fieldname]['tmp_name']) or
handl_error("Укажите путь к файлу", "Неопределен путь" . $_FILES[$image_fieldname]['tmp_name']);
$b=@getimagesize($_FILES[$image_fieldname]['tmp_name']) or
handl_error("Вы выбрали файл, не являющийся изображением", $_FILES[$image_fieldname]['tmp_name'] . "is not image");
$password_hash= password_hash($_POST['password'], PASSWORD_DEFAULT);

//Проверка существования пользователя с таким же именем
$username= filter_input(INPUT_POST, 'username', FILTER_VALIDATE_REGEXP,
    array('options'=>array('regexp'=>'/^[\w]+$/')));
$stmt= mysqli_prepare($cn, 'SELECT id FROM user WHERE user_name=(?)');
mysqli_stmt_bind_param($stmt, 's', $username);
$answ= mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $user_id);
mysqli_stmt_fetch($stmt);
if (!$user_id==null){$error_message=true;}
if ($error_message===true){handl_error('Ошибка загрузки данных', "error=true");}
//есть данные непрошедшие через входной фильтр
$mysqli_set_charset = mysqli_set_charset($cn, "utf8");



// запись в базу
$mysqli_set_charset = mysqli_set_charset($cn, "utf8");
/*$inset_user="INSERT INTO user(first_name, last_name, password, email, vk_url, user_name)
 VALUES('{$first_name}', '{$last_name}', '{$password_hash}', '{$email}', '{$vk_url}', '{$user_name}')" ;*/
$stmt= mysqli_prepare($cn, 'INSERT INTO user(first_name, last_name, password, email, vk_url, user_name, photo) VALUES((?), (?), (?), (?), (?), (?), (?))') or handl_error("Возникла ошибка при подключении к таблице", mysqli_connect_error($stmt));
mysqli_stmt_bind_param($stmt, 'sssssss', $first_name, $last_name, $password_hash, $email, $vk_url,  $username, $upload_filename);
$answ= mysqli_stmt_execute($stmt) or handl_error('Ошибка добавления пользователя', mysqli_stmt_error($stmt));
$num=strval(mysqli_stmt_insert_id($stmt));

//Создадим имя файла и переместим в папку profile на сервере
$upload_filename='profile/avatar_' . $num . '_' . $_FILES[$image_fieldname]['name'];
//имя файла=avatar_ID_Имя загруженного файла
@move_uploaded_file($_FILES[$image_fieldname]['tmp_name'], $upload_filename) or
handl_error("Ошибка перемещения файла", "Ошибка доступа: " . $upload_filename);
$qery="UPDATE user set photo='{$upload_filename}' WHERE id={$num}";
$ans= mysqli_query($cn, $qery);




//перенагавление
header("Location: show_user2.php?id=" . $num);
?>
</body>
</html>
