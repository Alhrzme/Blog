function AjRequest(body,  topic_id, parent_id) {
    var params = "commentsBody=" + body + "&parent_id=" + parent_id + "&topic_id=" + topic_id;
    var request = new AjaxRequest();
    request.open("POST", "/Comments/SetNewComment", true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                if (this.responseText != null) {
                        printTree(JSON.parse(this.responseText));
                }
                else alert("Ошибка AJAX: Данные не получены")
            }
            else alert("Ошибка AJAX: " + this.statusText)
        }
    };
    request.send(params);

}

    function AjaxRequest() {
        try {
            var request = new XMLHttpRequest()
        }
        catch (e1) {
            try {
                request = new ActiveXObject("Msxml2.XMLHTTP")
            }
            catch (e2) {
                try {
                    request = new ActiveXObject("Microsoft.XMLHTTP")
                }
                catch (e3) {
                    request = false
                }
            }
        }
        return request
    }
