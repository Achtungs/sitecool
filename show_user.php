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
$first_name=$_POST['fst-username'];
$last_name=$_POST['lst-username'];
$email=$_POST['email'];
$vk_url=$_POST['VK'];
$username=$_POST['username'];
$password=$_POST['password'];

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
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $first_name ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $last_name ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $username?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $email ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" placeholder="<?php echo $vk_url ?>">
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
