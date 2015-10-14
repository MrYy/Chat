<?php
require 'conn.inc';
session_start();
if(empty($_SESSION['username'])){
    header("HTTP/1.1 303 See Other");
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>PHP+ajax������������</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="jquery-1.6.min.js"></script>
    <script>
        $(function(){
            $("#post").click(function(){

                var content=$("#content").val();
                if(!$.trim(content)){
                    alert('����д����');
                    return false;
                }
                $("#content").val("");
                $.post("ajax.php", {content:content});});
        })

        function getData(msg){
            if(msg == undefined){
                msg = '';
            }
            $.post("get.php",{"msg":msg},function(data){
                //var myjson = eval("("+data+")");
                if(data){
                    var chatcontent = '';
                    var obj = eval('('+data+')');
                    $.each(obj,function(key,val){
                        chatcontent += "<div class='username'>"+val['username']+" ˵:</div>";
                        chatcontent += "<div class='content'>"+val['content']+"</div>";
                    })
                    $("#chatshow").html(chatcontent);
                }

                getData();
            })
        }

        function getUser(msg){
            if(msg == undefined){
                msg = '';
            }
            $.post("getuser.php",{"msg":msg},function(data){
                //var myjson = eval("("+data+")");
                if(data){
                    var chatcontent = '';
                    var obj = eval('('+data+')');
                    $.each(obj,function(key,val){
                        chatcontent += "<div class='username'>"+val['username']+" ˵:</div>";
                        chatcontent += "<div class='content'>"+val['content']+"</div>";
                    })
                    $("#chatshow").html(chatcontent);
                }

                getData();
            })
        }

        getData("one");



        $(function(){
            $("#userlist p").click(function(){
                $("#content").val("@"+$(this).text()+" ");
            })
        })

        $(function(){
            $(document).keypress(function(e){
                if(e.ctrlKey && e.which == 13 || e.which == 10) {

                    var content=$("#content").val();
                    if(!$.trim(content)){
                        alert('����д����');
                        return false;
                    }
                    $("#content").val("");
                    $.post("ajax.php", {content:content});
                }
            })
            //alert(event.clientX+document.body.clientWidth);
        })


    </script>
    <style>
        #chat{margin:0 auto;}
        #chatshow{width:500px;height:400px;overflow:auto;border:1px solid #ccc;float:left;}
        #userlist{width:100px;height:400px;overflow:auto;border:1px solid #ccc;float:left;margin-right:2px;}
        #userlist p{color:#0F0; cursor:pointer;}
        .clearboth{clear:both;}
        .username{font-weight:bold;color:#00F;font-size:12px;margin-bottom:3px;margin-top:8px;}
    </style>
</head>
<body>
<div id="chat">
    <div id="userlist">
        <div style="font-size:12px;font-weight:bold;">�����û��б�</div>
        <div class="userlist">
            <?php
            $sql = "select * from member where islogin = '1'";
            $res = mysql_query($sql);
            while($row = mysql_fetch_assoc($res)){
                echo '<p>'.$row['username'].'</p>';
            }
            ?>
        </div>
    </div>
    <div id="chatshow"></div>
</div>
<div class="clearboth"></div>
<div>
    <textarea name="content" id="content" style="width:600px;height:100px"></textarea>
    <input type='button' name='tj' id="post" value='����' >
</div>
</body>
</html>