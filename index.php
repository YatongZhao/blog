<?php
    $connection = mysqli_connect('localhost', 'root', '12345678', 'zyt76');
    mysqli_set_charset($connection, 'utf8');
    if (!$connection) {
        die('<h1>Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error() . '</h1>');
    }
    function show ($id) {
        $sql = "select * from main where parent_id = {$id}";
        $result = mysqli_query($GLOBALS['connection'], $sql);
        if (!($result->num_rows)) return;
        // var_dump($result);
?>
    <ul>
        <?php
            while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <li>
            <!-- <code> -->
            <?php
                echo "<code>{$row['class']}</code>";
                show($row['id']);
            ?>
            <!-- </code> -->
        </li>
        <?php
            endwhile;
            mysqli_free_result($result);
        ?>
    </ul>
<?php
    }
    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>zyt76</title>
        <link rel="stylesheet" href="./CSS/base.css">
        <link rel="stylesheet" href="./CSS/layout.css">
        <script src="./JS/main.js"></script>
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
        <div class="base_info">
            <code>WELCOME TO ZYT76'S BLOG</code>
            <code>==============================bio==============================</code>
            <code>blogger: zyt76;</code>
            <code>email: zyt768295828@163.com;</code>
            <code>phone: 13167085630;</code>
            <code></code>
            <code></code>
            <code></code>
            <code></code>
            <code></code>
            <code></code>
            <code></code>
        </div>
        <div class="main" id="main">

        </div>
        <footer>
            
        </footer>
</body>
</html>