<?php

use application\controllers\TopicController;

TopicController::actionCreateTopicInput();
?>

<div id="title">
    Создать новый топик.
</div>
    <div>
        <form action="" name="topic" method="post">
            <label>Название топика<br><input type="text" placeholder="Название топика" name="title"></label> <br><br>
            <label>Содержание топика<br> <textarea cols="70" rows="30" name="topicBody" placeholder="Содержание топика"></textarea></label><br><br>
            <input type="submit" name="submit">
        </form>
    </div>

