<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <style type="text/css">
       .talk_con{
            width:600px;
            height:480px;
            border:1px solid #f9f9f9;
            margin:50px auto 0;
            background:#f9f9f9;
        }
        .talk_show{
            width:580px;
            height:420px;
            /*border:1px solid #666;*/
            background:#fff;
            margin:10px auto 0;
            overflow:auto;
        }
        .talk_input{
            width:580px;
            margin:10px auto 0;
        }
        .whotalk{
            width:80px;
            height:30px;
            float:left;
            outline:none;
        }
        .talk_word{
            width:500px;
            height:23px;
            padding:0px;
            float:left;
            margin-left:0px;
            outline:none;
            text-indent:10px;
        }        
        .talk_sub{
            width:60px;
            height:30px;
            float:left;
            margin-top:5px;
            margin-left:10px;
        }
        .atalk{
           margin:10px; 
        }
        .atalk span{
            display:inline-block;
            background:#0181cc;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
        .btalk{
            margin:10px;
            text-align:right;
        }
        .btalk span{
            display:inline-block;
            background:#ef8201;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
    </style>

    <?php
        $class = $_COOKIE["class"];
        
        $class = htmlspecialchars($class, ENT_QUOTES);
        if ($class != "student") {
            echo "<script type='text/javascript'>";
            echo "window.location.href='error.php?error=1';";
            echo "</script>";
        }
    ?>

    <?php
        function isNotFriend($from, $to) {
            #$con = new mysqli("127.0.0.1","Sol","1102","pj5.8");
            $con = new mysqli("127.0.0.1","root","12345","Proj");
            if (!$con) {
                echo "Wrong Database Connection!<br>";
            } else {
                $sql = "select * from friend where (sid1 = ? and sid2 = ?)or(sid1 = ? and sid2 = ?)";
                $query = $con->prepare($sql);
                $query->bind_param('ssss',$from, $to, $to, $from);
                $query->execute();
                $results = $query->get_result();
                $rows = $results->fetch_all();
                if (count($rows) == 0) {
                    return 1;
                } else {
                    return 0;
                }
            }
        }
    ?>
    <?php
        $to = $_GET["toid"];
        $userid = $_COOKIE["userid"];
        $userid = htmlspecialchars($userid, ENT_QUOTES);
        $to = htmlspecialchars($to, ENT_QUOTES);
        if ($userid == NULL) {
            echo "<script type='text/javascript'>";
            echo "window.location.href='error.php?error=1'";
            echo "</script>";
        } else if (isNotFriend($to,$userid)){ //TODO：使用database判断to和userid是否为好友
            echo "<script type='text/javascript'>";
            echo "window.location.href='error.php?error=2'";
            echo "</script>";
        }
        echo "<script type='text/javascript'>";
        echo "var to = ".$to.";";
        echo "</script>";

    ?>

    <script type="text/javascript">

    function $(c) { return document.getElementById(c); }

    //var numMsg = 0;
    jQuery.noConflict();
    jQuery("div p").hide();
    jQuery.get("oldMsg.php?fid="+to, function(data, status) {
        if (data.errcode != '1') {
            var showWords = $("showwords");
            var n = data.data.length;
            var str = "";
            for (var i = 0; i < n; i++) {
                if (data.data[i][0] == to) {
                    str = str + '<div class="atalk"><span>' + data.data[i][1] +'</span></div>';
                } else {
                    str = str + '<div class="btalk"><span>' + data.data[i][1] +'</span></div>';
                }
            }
            showWords.innerHTML = showWords.innerHTML + str;
            showWords.scrollTop = showWords.scrollHeight;
            //numMsg = data.num;
        }
    });

    function poll() {
        jQuery.noConflict();
        jQuery("div p").hide();
        setTimeout(function() {
            jQuery.get("receiveMsg.php?fromid="+to/*+"&num="+numMsg*/, function(data, status) {
                if (data.errcode != '1') {
                    //alert(data.data);
                    var showWords = $("showwords");
                    var n = data.data.length;
                    var str = "";
                    for (var i = 0; i < n; i++) {
                        str = str + '<div class="atalk"><span>' + data.data[i] +'</span></div>';
                    }
                    //var str = '<div class="atalk"><span>' + data.data[0] +'</span></div>'
                    showWords.innerHTML = showWords.innerHTML + str;
                    showWords.scrollTop = showWords.scrollHeight;
                    //numMsg = data.num;
                }
                poll();
            });
        }, 1000);
    }
    poll();
    </script>

    <script type="text/javascript">   

        function MyFunction() { 

                var words = $("talkwords").value;
                if(words == ""){ alert("Empty Input!"); return; }

                str = "";
                str = '<div class="btalk"><span>' + words +'</span></div>'; 

                var showWords = $("showwords");
                showWords.innerHTML = showWords.innerHTML + str;
                showWords.scrollTop = showWords.scrollHeight;

                jQuery.noConflict();
                jQuery("div p").hide();
                jQuery.ajax({
                    type: "POST",
                    url: "sendMsg.php",
                    data: { msg: words, toid: to},
                }).done(function(msg){});
        }

    </script>
</head>

<body>
    <div class="talk_con">
        <div class="talk_show" id="showwords">
        </div>
        <div class="talk_input">
            <input type="text" class="talk_word" id="talkwords">
            <input type="button" value="Send" class="talk_sub" id="talksub" onClick = "MyFunction()">
        </div>
    </div>
</body>
</html>