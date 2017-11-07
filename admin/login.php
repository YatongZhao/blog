<?php
    $error = '';
    $focus = 'oUserName';
    $user_name = '';
    function login () {
        if (empty($_POST['username'])) return $GLOBALS['error'] = '用户名不能为空!';
        if (empty($_POST['password'])) return $GLOBALS['error'] = '密码不能为空!';
        $connection = mysqli_connect('localhost', 'root', '12345678', 'zyt76');
        mysqli_set_charset($connection, 'utf8');
        if (!$connection) return $GLOBALS['error'] = '连接数据库失败!';
        $query = mysqli_query($connection, "select count(1) from users_info where username = '{$_POST['username']}' && password = '{$_POST['password']}';");
        $result = mysqli_fetch_assoc($query);
        var_dump($result);
        if ($result['count(1)'] === '1') {
            session_start();
            $_SESSION['current_login_user'] = $_POST['username'];
            header('Location: /admin/post-add.php');
            exit();
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') login();
    // if (!empty($_REQUEST)) :
    //     if (empty($_REQUEST{'username'})) {
    //         $error = '用户名不能为空!';
    //     }
    //     $user_name = $_REQUEST{'username'};
    //     $user = explode("\n", $user_info);
    //     $user_isset = false;
    //     foreach ( $user as $value) :
    //         if ($value==='') continue;
    //         $user_all_info = explode(" | ", $value);
    //         $user_isset = ($_REQUEST{'username'} === $user_all_info[0]) || $user_isset; 
    //         if ($user_isset) {
    //             if ($_REQUEST{'password'} === $user_all_info[1]) {
    //                 $random = rand(1, 1000000);
    //                 while (strlen("$random")<=5) {
    //                     $random = '0'.$random;
    //                 }
    //                 date_default_timezone_set('PRC');
    //                 $now = time();
    //                 $logon_info = file_get_contents('logon_log.txt');
    //                 $logon_info_arr = explode("\n", $logon_info);
    //                 $new_logon_info = '';
    //                 foreach ($logon_info_arr as $value) {
    //                     $each_logon = explode(" | ", $value);
    //                     if ($each_logon[0] === $_REQUEST{'username'}) {
    //                         $each_logon[1] = $random;
    //                         $each_logon[2] = $now;
    //                     }
    //                     if ($value != '') {
    //                         $value_c = $each_logon[0].' | '.$each_logon[1].' | '.$each_logon[2]."\n";
    //                         $new_logon_info .= $value_c;
    //                     }
    //                 }
    //                 file_put_contents('logon_log.txt', $new_logon_info);
    //                 echo "<script>var url='index.php?username={$_REQUEST{'username'}}&index={$random}';window.open(url, '_self');</script>";
    //                 // include('index.php');
    //                 exit();
    //             } else {
    //                 $error = '密码输入错误！';
    //                 $focus = 'oPassword';
    //             }
    //         }
    //     endforeach;
    //     if (!$user_isset) {
    //         $error = '用户名不存在！';
    //         $focus = 'oUserName';
    //     }
    // endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
    }
    .clearFix:after {
        content: ".";
        visibility: hidden;
        display: block;
        height: 0;
        clear: both;
    }
    .clearFix {
        *zoom: 1;
    }
    form {
        width: 500px;
        margin: 200px auto 0;
    }
    label {
        display: block;
        width: 500px;
        margin: 0 auto;
        text-align: center;
        padding-bottom: 4px;
        background-color: black;
    }
    label:first-child {
        padding: 0;
    }
    label:first-child span {
        border-bottom: 2px solid black;
    }
    label span {
        float: left;
        width: 100px;
        height: 36px;
        line-height: 36px;
        /* text-align: left; */
        color: white;
    }
    label input {
        float: left;
        width: 400px;
        height: 36px;
        border: none;
        outline: none;
        font: 20px "arial";
        /* text-align: center; */
        text-indent: 10px;
    }
    input#submit {
        display: block;
        width: 500px;
        margin: 0 auto;
        height: 40px;
        border: none;
        outline: none;
        font: 20px/40px "arial";
        transition: 0.5s;
    }
    input#submit:hover {
        background-color: black;
        color: white;
    }
    .other {
        width: 500px;
        height: 18px;
        display: block;
        margin: 0 auto;
        background-color: rgba(0, 0, 0, 0.05);
        opacity: 1;
    }
    .other .logon {
        float: right;        
        border: none;
        outline: none;
        height: 18px;
        width: 50px;
        background-color: red;
        color: white;
        font: 12px/18px "Microsoft YaHei";
        cursor: pointer;
    }
    .other a {
        float: right;
        height: 18px;
        width: 100px;
        background-color: orange;
        font: 12px/18px "Microsoft YaHei";
        text-align: center;
        color: white;
        text-decoration: none;
    }
    .other .error {
        float: left;
        height: 18px;
        font: 12px/18px "Microsoft YaHei";
        color: red;
        overflow: hidden;
        text-indent: 2px;
    }
</style>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label class="clearFix">
            <span>用户名</span>
            <input type="text" name="username" id="username" autocomplete="off" spellcheck="false" autocorrect="false" autocapitalize="false">
        </label>
        <label class="clearFix">
            <span>密码</span>
            <input type="password" name="password" id="password">
        </label>
        <input type="submit" value="登陆" id="submit">
    </form>
    <div class="other clearFix">
        <a href="sign_in.php" class="logon">注册</a>
        <a href="#">找回密码</a>
        <span class="error" id="error"></span>
    </div>
</body>
<script>
    var oSpan = document.getElementById("error");
    var oUserName = document.getElementById("username");
    var oPassword = document.getElementById("password");
    oSpan.innerHTML = "<?php echo $error; ?>";
    oUserName.value = "<?php echo $user_name; ?>";
    <?php echo $focus; ?>.focus();
</script>
</html>