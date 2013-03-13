<html>
    <body>

        <?php foreach ($query as $item): ?>
            <?= form_open('edit_controller/update') ?>
            <?= form_hidden('id', $item->id) ?>
            <?php
            $sql = "SELECT * FROM version_ctrl WHERE entry_id = " . $item->id . " ORDER BY version_id DESC LIMIT 1;";
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
                    <td colspan="2">After this time, you will complete <input type ="int" size ="1" name ="donepercent">%.</td>
                </tr>
                <tr>
                    <td></td>
                    <td><?= form_submit('submit', 'Submit') ?></td>
                </tr>
            </table>
        </form>
    <?php endforeach; ?>
</body>
</html>
