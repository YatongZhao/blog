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
                        <span>ESPN</span>
                        <span>We The Fans</span>
                    </h2>
                </div>
                <div></div>
                <div></div>
            </div>
            <div class="subhead">
                <h3>
                We The Fans is a multiplatform storytelling project about life and love as a football fan. In collaboration with ESPN, we created a digital experience exploring the lives of Chicago Bears diehards.
                </h3>
                <div></div>
            </div>
            <div class="content">
                <div>
                    <p>Essential’s products are new, but the story is ancient. It would of course be extremely strange to compare it to the movie 300. So let’s do that. While King Leonidas is leading 300 spartans with Herculean bodies and sharp blades into the battle against the Persian army of 300.000 soldiers, Andy Rubin is leading 100 tech superstars with insane skills and sharp brains into an epic consumer tech battle. The Hollywood version is admittedly a bit more dramatic, but the people are essential. They are the difference between winning and losing.</p>
                    <p>This is why we decided to include them in the narrative and merge the qualities of a product site with the storytelling aspects of a blog. We literally made a rule that we’d never show glossy products without sharing the thoughts and the people behind them. We made 100 people the heroes on Essential.com because they are. Secondly, tech companies can easily become faceless giants, and Essential is a counteraction to this approach. The company is not about more or bigger. It’s about better.</p>
                    <p>We’re currently working with Essential to make Essential.com even better and prepare it for the launch of an intelligent home device. In other words, we’re doing everything we can to help Andy and his outnumbered team prove that it’s possible to make a big impact even though (and exactly because) they’re not big.</p>
                </div>
                <div></div>
            </div>
        </div>
        <footer>
            
        </footer>
</body>
</html>