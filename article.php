<?php


    include_once  'function.php';
    $connection = mysqli_connect('localhost', 'root', '12345678', 'zyt76');
    mysqli_set_charset($connection, 'utf8');
    if (!$connection) {
        die('<h1>Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error() . '</h1>');
    }
    $sql = "select
	main.class,
	front_end_article_content.content,
	front_end_article_content.id,
	main.sub_title
    from main
    inner join front_end_article_content on main.id = front_end_article_content.id_parent
    where main.id = {$_GET['id']}
    order by front_end_article_content.id";
    $query = mysqli_query($GLOBALS['connection'], $sql);
    while ($rows = mysqli_fetch_assoc($query)) :
        $result[] = $rows;
    endwhile;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>zyt76</title>
        <link rel="stylesheet" href="/static/assets/css/base.css">
        <link rel="stylesheet" href="/static/assets/css/layout.css">
        <script src="/static/assets/js/main.js"></script>
    </head>
    <body>
        <header>
            <h1 class='logo'>
                <code>z</code><code>y</code><code>t</code><code>7</code><code>6</code>
            </h1>
        </header>
        <aside>
            <h1 class='logo'>
                <code>z</code><code>y</code><code>t</code><code>7</code><code>6</code>
            </h1>
            <?php
                show(0);
                mysqli_close($connection);
            ?>
        </aside>
        <div class="base_info" id="base_info">
            <code>WELCOME TO ZYT76'S BLOG</code>
            <code>==============================bio==============================</code>
            <code>blogger: zyt76;</code>
            <code>email: zyt768295828@163.com;</code>
            <code>phone: 13167085630;</code>
        </div>
        <div class="main" id="main">
            <div class="header">
                <div>
                    <span>Client</span>
                    <span>ESPN</span>
                </div>
                <div>
                    <span>
                        Case
                        <span></span>
                    </span>
                    <h2>
                        <!-- <span>ESPN</span>
                        <span>We The Fans</span> -->
                        <span><?php echo $result[0]['class'] ?></span>
                    </h2>
                </div>
                <div></div>
                <div></div>
            </div>
            <div class="subhead">
                <h3>
                    <?php echo $result[0]['sub_title'] ?>
                </h3>
                <div></div>
            </div>
            <div class="content">
                <div>
                    <?php foreach ($result as $item) : ?>
                    <p><?php echo $item['content']; ?></p>
                    <?php endforeach; ?>
                </div>
                <div></div>
            </div>
        </div>
        <footer>
            
        </footer>
</body>
<script>
    var oUl = document.getElementsByTagName("aside")[0].getElementsByTagName("ul")[0];
    oUl.onclick = function (e) {
        e = e || event;
        if (e.target.nodeName == "A") {
            e.preventDefault();
            // console.log(e.target.href);
            // console.log(e.target.getAttribute('href'));
            console.dir(e.target);
        }
    }
</script>
</html>