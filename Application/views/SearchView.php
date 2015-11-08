<?php
if(is_array($data)) {
    if(!empty($data[0])){
        foreach ($data as $value) {
                print '<a href="/Topic/GetTopic?id=' . $value['id'] . '">' . $value['title'] . '<a/><br>';
        }
    }
            else print 'Ничего не найдено.';
}
else print 'Пустой запрос';