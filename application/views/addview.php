<html>
    <head>
        <meta charset="utf-8" />
        <title>jQuery UI Datepicker - Default functionality</title>
        <?=link_tag('jquery-ui.css')?>
        <script src=<?=base_url()."jquery-1.8.2.js"?>></script>
        <script src=<?=base_url()."jquery-ui.js"?>></script>
        <link rel="stylesheet" href="/resources/demos/style.css" />
        <script>
            $(function() {
                $( "#datepicker" ).datepicker();
            });
        </script>
    </head>
    <body>
    <?= form_open('edit_controller/insert') ?>
    <?php if ($add_book): ?>
        <?= form_hidden('fid', 0) ?>
        <?= form_hidden('fdeepth', -1) ?>
    <?php else: ?>
        <?php foreach ($query as $item): ?>
            <?= form_hidden('fid', $item->id) ?>
            <?= form_hidden('fdeepth', $item->deepth) ?>
        <?php endforeach; ?>
    <?php endif; ?>
    <table>
        <tr>
            <td><strong><?= "Subject :" ?></strong></td>
            <td><?= form_input('subject') ?></td>
        </tr>
        <tr>
            <td><strong><?= "Body :" ?></strong></td>
            <td><?= form_textarea('body') ?></td>
        </tr>
        <tr>
            <td><strong><?= "Deadline :"?></strong></td>
            <td><input type ="date" name ="deadline"  id="datepicker"></td>
        </tr>
        <tr>
            <td></td>
            <td><?= form_submit('submit', 'Add') ?></td>
        </tr>
    </table>
</form>
</body>
</html>
