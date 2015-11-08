function foo()
{
    var content = "<form action=\"\" name=\"topic\" method=\"post\">";
    content += "<label>Содержание топика</label><textarea cols=\"120\" rows=\"20\" name=\"topicBody\" placeholder=\"Содержание топика\">";
    content += document.getElementById('topic').innerHTML;
    content += "</textarea></label><br><br>";
    content += "<button type=\"submit\" name=\"editBody\">Изменить</button></form>";
    return document.getElementById('topic').innerHTML = content;
}
function getAnswerForm(id, topic_id)
{
    var form = '<form action="" method="post">';
    form += '<textarea id="comment' + id + '" placeholder="Пишите сюда своё никому ненужное мнение" name="commentsBody" cols="70" rows="5 "></textarea><br>';
    form += '<button type="button" onclick="addNewComment(' + id + ',' + topic_id + ')" name="comments"> Написать </button>';
    form += '</form>';
    return form;
}

function addNewComment(id, topic_id)
{
    var body = document.getElementById('comment' + id ).value;
    document.getElementById('comments').innerHTML = '';
    (AjRequest(body, topic_id, id));
    window.location.href="#bottom";
}
function printTree(arr, topic_id, parent_id, ots)
{
    parent_id = parent_id || 0;
    ots = ots || 0;
    ots++;
    for( var i in arr){
        if(arr[i].parent_id == parent_id){
            var thereDate =  (arr[i].date)*1000;
            var str = '';
            str += '<div class="comments" comment_id="' + arr[i].id + '" parent_id="' + arr[i].parent_id+'" style="margin-left:'+(ots*40-40) +'px">';
            str += '<div style="font-size:small; margin-bottom:5px"><a href="/PersonalPage/Index?id=' + arr[i].user_id +'">' + arr[i].username + '</a> ' + new Date(thereDate) + '</div>';
            str += '<div>' + arr[i].body + '</div><div>';
            str += '<button onclick="document.getElementById(' + arr[i].id + ').innerHTML=getAnswerForm(' + arr[i].id + ',' + topic_id + ')" ">Ответить</button>';
            str += '<div id="' + arr[i].id + '"></div></div></div>';
            var newDiv = document.createElement('div');
            newDiv.innerHTML = str;
            $('#comments').append(newDiv);
            printTree(arr, topic_id, arr[i].id, ots );
        }
    }
}