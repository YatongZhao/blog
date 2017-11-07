<?php
/**
 * 
 */
function show ($id) {
        $sql = "select * from main where parent_id = {$id}";
        $result = mysqli_query($GLOBALS['connection'], $sql);
        if (!($result->num_rows)) return;
?>
<ul>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <li>
            <?php
                echo "<a href='/article.php?id={$row['id']}'>{$row['class']}</a>";
                show($row['id']);
            ?>
        </li>
    <?php
        endwhile;
        mysqli_free_result($result);
    ?>
</ul>
<?php } ?>