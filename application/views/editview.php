<html>
    <body>

        <?php foreach ($query as $item): ?>
            <?= form_open('edit_controller/update') ?>
            <?= form_hidden('id', $item->id) ?>
            <?php
            $sql = "SELECT * FROM version_ctrl WHERE entry_id = " . $item->id . ";";
            $result = mysql_query($sql);
            $row = mysql_fetch_assoc($result);
            ?>
            <table>
                <tr>
                    <td><i><?= "Subject :" ?></i></td>
                    <td><?= form_input('subject', $item->subject) ?></td>
                </tr>
                <tr>
                    <td><i><?= "Body :" ?></i></td>
                    <td><?= form_textarea('body', $row['body']) ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= form_submit('submit', 'Submit') ?></td>
                </tr>
                <tr><td></td>
                    <td><?php
                $percentage = "45";
                $done = $percentage * 2;
                $notdone = 200 - $done;
                $pimg1 = base_url()."pb1.jpg";
                $pimg2 = base_url()."pb2.jpg";
                $pimg3 = base_url()."pb3.jpg";
                echo "<img src = $pimg1>";
                for ($i = "1"; $i <= $done; $i++) {
                    echo"<img src= $pimg2>";
                }
                for ($i = "1"; $i <= $notdone; $i++) {
                    echo"<img src= $pimg3>";
                }
                echo"<img src=$pimg1>";
                if ($percentage != "100")
                    echo '<span style = "color:red">You have completed ', $percentage, '%, get hard!</span>';
                else
                    echo '<span style = "color:red">You have completed the work, congratulations!</span>';
                ?></td>
                </tr>
            </table>
        </form>
    <?php endforeach; ?>
</body>
</html>
