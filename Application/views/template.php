<?php

use application\controllers\UserController;

?>
<html xmlns="http://www.w3.org/1999/html">
<head lang="en">
    <script src="/jsFiles/jquery-1.11.3.js"></script>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <link href="/images/chaos.ico" rel="shortcut icon" type="image/x-icon" />
    <script src="/jsFiles/AddComment.js"></script>
</head>
<body>
<header>
    <script>
    </script>
    <div id="sign">
        <img src="/images/Chaos1.jpg">
    </div>
    <div class="menu">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/Topic/CreateTopic"> Create New Topic</a></li>
            <li><a href="/Reg/Register"> Registration</a></li>
        </ul>
    </div>
    <div class="login">
        <?php
        $path = UserController::getLoginView();
        require_once $path;
        ?>
    </div>
    <form name="search" action="/Search/Index" method="get">
        <input type="text" class="butone" name="q" placeholder="Search"><button class="button1" type="submit">GO</button>
    </form>
</header>
<div class="wrapper">
<?php
require_once 'application/views/'.$content_view;
?>
</div>
<footer>
    Чатик имени меня
</footer>
</body>
</html>