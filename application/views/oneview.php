<html>
    <head>
        <meta charset="utf-8" />
        <title>jQuery UI Datepicker - Default functionality</title>
        <?= link_tag('jquery-ui.css') ?>
        <script src=<?= base_url() . "jquery-1.8.2.js" ?>></script>
        <script src=<?= base_url() . "jquery-ui.js" ?>></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />
        <script language="javaScript">
            function doEcho(i, j, k){
                document.getElementById("a").innerHTML = " ";
                var newValue = parseInt(j);
                $("#progressbar").progressbar({value: newValue});  
                document.getElementById("a").innerHTML += j;
                document.getElementById("a").innerHTML += "%";
                document.getElementById("a").innerHTML += "\n(Last modified on ";
                document.getElementById("a").innerHTML += k;
                document.getElementById("a").innerHTML += ")";
                document.getElementById("a").innerHTML += "<p>";
                document.getElementById("a").innerHTML += i;
                document.getElementById("a").innerHTML += "</p>";
            }
        </script>
        <?php echo smiley_js(); ?>
    </head>
    <body>
        <?php foreach ($query as $item): ?>
            <h2><i><?= $item->subject ?>
			<?php if ($login_user): ?>
				<?php if (!$author and $login_user != 'wind'): ?>
                <strong><?= anchor('app_controller/index/' . $item->id, ' [want to edit]') ?></strong>
				<?php elseif ($author == $login_user || $login_user == 'wind'): ?>
                <strong><?= anchor('edit_controller/index/' . $item->id, ' [edit]') ?></strong>
				<?php endif; ?>
			<?php endif; ?>
			</i></h2>
			
            <?php
            $sql = "SELECT * FROM version_ctrl WHERE entry_id = " . $item->id . " ORDER BY version_id;";
            $result = mysql_query($sql);

            echo "<i>Version : ";
            while ($row = mysql_fetch_assoc($result)) {
                echo '<a href ="javaScript:doEcho(\'' . $row['body'] . '\', \'' . $row['donepercent'] . '\',\'' . $row['dateposted'] . '\')" >[' . $row['version_id'] . '] </a>';
            }
            echo "</i>";
            ?>
			<?="<br /><br />"?>
			
            <i>
				<div id="progressbar"></div>
			    <div id="a"></div>
			</i>

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
