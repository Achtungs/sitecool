<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>Данные пользователя</title>
    <link rel="stylesheet" href="style.css" />
    <script type="text/javascript" src="Script.js"></script>
</head>
<body>
<header>Наша социальная сеть</header>
<?php
$user_id=$_GET['id'];
$select_query="SELECT * FROM user WHERE id=" . $user_id;//* означает выбрать все
$cn=mysqli_connect('localhost', 'Axtung', '123', 'social_network')
or handl_error("Возникла ошибка при подключении к базе данных", mysqli_connect_error($cn));
mysqli_set_charset($cn, "utf8");
$result=mysqli_query($cn, $select_query);
//die(($user_id));
if ($result) {
    $row=mysqli_fetch_array($result);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $vk_url = $row['vk_url'];
    $username = $row['user_name'];
    $password = $row['password'];
    $image_fieldname = $row['photo'];
}
?>
<div class="sing-log-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="form-area">
                    <div class="form-sing">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation">Наша социальная сеть. Ваши данные</li>
                        </ul>

                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <form>
                                        <div class="form-bor">
                                            <div class="form-input-group">
                                                <div class="row">
                                                    <label for="">Имя</label>
                                                    <div class="col-md-6">

                                                        <input type="text" placeholder="<?php echo $first_name ?>" readonly="readonly">
                                                    </div>
                                                    <br>
                                                    <label for="">Фамилия</label>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $last_name ?>" readonly="readonly">
                                                    </div>
                                                    <br>
                                                    <label for="">Никнейм</label>
                                                    <div class="col-md-6">

                                                        <input type="text" placeholder="<?php echo $username?>" readonly="readonly">
                                                    </div>
                                                    <br>
                                                    <label for="">Email</label>
                                                    <div class="col-md-6">

                                                        <input type="text" placeholder="<?php echo $email ?>" readonly="readonly">
                                                    </div>
                                                    <br>
                                                    <label for="">VK</label>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $vk_url ?>" readonly="readonly">
                                                    </div>
                                                    <br>
                                                    <label for="">Image</label>
                                                    <div class="col-md-6">
                                                        <img src="<?php echo "http://mysite7.rus/".$image_fieldname ?>" class="ImgSize">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
