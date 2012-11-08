<html>
    <head>
        <?php echo smiley_js(); ?>
    </head>
    <body>
        <script language="javaScript">
            function doEcho(i){
                document.getElementById("a").innerHTML = i;
            }
        </script>
        <?php foreach ($query as $item): ?>
            <h2><i><?= $item->subject ?></i></h2><br />
            <?php
            $sql = "SELECT * FROM version_ctrl WHERE entry_id = " . $item->id . " ORDER BY version_id;";
            $result = mysql_query($sql);

            while ($row = mysql_fetch_assoc($result)) {
                echo '<a href ="javaScript:doEcho(\'' . $row['body'] . '\')" >Version'. $row['version_id']. ' : </a>';
                $percentage = $row['donepercent'];
                $done = $percentage * 2;
                $notdone = 200 - $done;
                $pimg1 = base_url() . "pb1.jpg";
                $pimg2 = base_url() . "pb2.jpg";
                $pimg3 = base_url() . "pb3.jpg";
                echo "<img src = $pimg1>";
                for ($i = "1"; $i <= $done; $i++) {
                    echo"<img src= $pimg2>";
                }
                for ($i = "1"; $i <= $notdone; $i++) {
                    echo"<img src= $pimg3>";
                }
                echo"<img src=$pimg1>";
                echo '<span style = "color:red">', $percentage, '%</span>';
                echo "     ";
                echo "<i>";
                echo "(Last modified on ";
                echo $row['dateposted'];
                echo ")";
                echo "</i>";
                echo "<br /><br />";
            }
            ?>
            <div id="a"></div>
            <?php echo "<br />"; ?>
            <?php if ($login_user): ?>
                <?php if (!$author and $login_user != 'wind'): ?>
                    <strong><?= anchor('app_controller/index/' . $item->id, ' [want to edit]') ?></strong>
                <?php elseif ($author == $login_user || $login_user == 'wind'): ?>
                    <strong><?= anchor('edit_controller/index/' . $item->id, ' [edit]') ?></strong>
                <?php endif; ?>
            <?php endif; ?>

            <hr align=left width=45% />

            <h3><i><?= "Comments:" ?></i></h3>
            <?php $i = 1; ?>
            <p>
            <ul>
                <?php if (!$c_query): ?>
                    <i><?= "No comments!" ?></i>
                <?php endif; ?>

                <?php foreach ($c_query as $c_item): ?>
                    <li>
                        <i>
                            <?= "Comment#$i: by " ?><strong><?= $c_item->uname ?></strong><?= " on " ?>
                            <?= date("D jS F Y g.iA", strtotime($c_item->time)) ?>
                            <p>
                                <?= nl2br($c_item->body) ?>
                            </p>
                        </i>
                    </li>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </ul>
        </p>

        <hr align=left width=45% />

        <?php if ($login_user): ?>
            <h3><i><?= "Leave a comment?" ?></i></h3>
            <p>
                <?= form_open('comment_controller') ?>
                <?= form_hidden('eid', $item->id) ?>
            <table>
                <tr>
                    <td><i><?= "Username :" ?></i></td>
                    <td><input type="text" name="uname" id="uname" style="width:300px;"></td>
                </tr>
                <tr>
                    <td><i><?= "Comments :" ?></i></td>
                    <td><textarea name="body" id="body" cols="28" rows="4"></textarea><td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= form_submit('submit', 'Submit') ?></td>
                </tr>
            </table>
        </form>
        </p>
    <?php endif; ?>
<?php endforeach; ?>
<?php //echo $smiley_table; ?>
</body>
</html>
