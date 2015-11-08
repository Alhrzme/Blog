<div id="title">
    Существующие топики
</div>
<?php
foreach($data as $id => $title) {
    print '<a href="http://example/Topic/GetTopic?id='.$id.'">'.$title.'</a><br>';
}
?>
<br>
<form method="post" action="">
    <button name="delete" >Удалить все топики!</button>
</form>