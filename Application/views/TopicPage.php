<script src="/jsFiles/CommentScripts.js"></script>
<div id="title">
    <?=$data['topic']['title'];?>
</div>

<div id="topic">
    <?=$data['topic']['body'];?>
</div>
<div>
    <?=$data['topic']['username'];?>
</div>
<?php
if($_SESSION['id'] == $data['topic']['user_id']){
    echo '<div><button  onclick="return foo()" >Изменить содержание топика</button><br></div>';
}
?>
<br>
<hr>
<br>
<div id="comments">
    <div id="printCom">
        <button onclick="printTree(arr, id);"> Показать комментарии</button> <br>
    </div>

<script>
    arr = <?=$data['comments']?>;
    id = <?=$_GET['id']?>;
</script>
</div>


<div>
    <form action="" method="post">
        <textarea placeholder="Пишите сюда своё никому ненужное мнение" id="comment0"  name="commentsBody" cols="150" rows="10 "></textarea><br>
        <button type="button" name="comments" onclick="addNewComment(0, <?=$_GET['id']?>)"> Написать </button>
    </form>
</div>
