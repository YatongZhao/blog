<?php
$connection = mysqli_connect('localhost', 'root', '12345678', 'zyt76');
mysqli_set_charset($connection, 'utf8');
if (!$connection) exit('连接数据库失败!');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode($_POST['pre']);
    $query = mysqli_query($connection, "delete from front_end_article_content where id_parent = 0");
    foreach ($data as $item) {
        $query = mysqli_query($connection, "insert into front_end_article_content values (null, '{$item}', 0)");
    }
    exit('数据更新成功!');
}

$query = mysqli_query($connection, "select content from front_end_article_content where id_parent = 0");
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row['content'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        #box {
            position: absolute;
            background-color: white;
            overflow:hidden;
            outline: none;
        }
        #box code {
            font-family: consolas;
            font-size: 12px;
        }
        #content {
            position: relative;
            margin: 50px auto;
            width: 300px;
            height: 400px;
            overflow: auto;
            border: 1px solid gray;
            padding: 1px;
        }
        #box {
            counter-reset: number;
        }
        #box>div {
            position: relative;
            font-family: consolas;
            font-size: 12px;
            width: 300px;
        }
        #box>div::before {
            counter-increment: number;
            content: counter(number);
            display: inline-block;
            font-family: consolas;
            font-size: 12px;
            color: gray;
            width: 50px;
            top: 0;
            width: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="content">
        <div contenteditable id="box" spellcheck="false" autocomplete="off" autocorrect="false" autocapitalize="false">
            <?php foreach ($data as $item) : ?>
            <div><?php echo ($item === "\n" || $item === '') ? '<br/>' : $item; ?></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div id="message"></div>
    <button id="btn">submit</button>
</body>
<script>
    var oBox = document.getElementById("box");
    var oBtn = document.getElementById("btn");
    var oMessage = document.getElementById("message");
    console.log(oBox);
    var arr = [];
    oBox.onkeyup = function (e) {
        e = e || event;
        console.log(e.key);
        arr = [];
        for (var i = 0; i < oBox.children.length; i++) {
            arr[i] = oBox.children[i].innerText;
        }
        if (e.key === 'Enter') {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'post-add.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(`pre=${JSON.stringify(arr)}`);
            oMessage.innerHTML = '数据上传中...';
            xhr.onreadystatechange = function () {
                if (this.readyState !== 4) return;
                oMessage.innerHTML = this.responseText;
            }
        }
    }
    oBtn.onclick = function () {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'post-add.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(`pre=${JSON.stringify(arr)}`);
        oMessage.innerHTML = '数据上传中...';
        xhr.onreadystatechange = function () {
            if (this.readyState !== 4) return;
            oMessage.innerHTML = this.responseText;
        }
    }
</script>
</html>