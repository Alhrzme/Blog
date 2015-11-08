<div id="title">
    <?=$data['personal']['username']?>
</div>
<?php
echo 'Ваше имя: ', $data['personal']['realname'], '<br>';
echo 'Ваша почта: ', $data['personal']['email'], '<br>';?>
<br>
<div>
    Список топиков:
</div>
<div>
    <?php
    foreach($data['topics'] as $val){
        print '<a href="/Topic/GetTopic?id='.$val['id'].'">'.$val['title'].'</a><br>';
    }
    ?>
</div>