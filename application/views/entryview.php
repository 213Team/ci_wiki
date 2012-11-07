<html>
    <body>
        <h1>
            Catalogus
            <?php if ($login_user == 'wind'): ?>
                <?= anchor('add_controller/index/0', ' [Add Book]') ?>
            <?php endif; ?>
        </h1>

        <?php

        function list_print($id, $array, $login_user) {
            date_default_timezone_set("PRC");
            if (isset($array[$id])) {
                echo "<ul><i>";
                foreach ($array[$id] as $item) {
                    switch ($item->deepth) {
                        case 0: echo "<h2>";
                            break;
                        case 1: echo "<h3>";
                            break;
                    }
                    echo anchor('one_controller/index/' . $item->id, $item->subject);
                    $deadline = $item->deadline;
                    $nowDate = date("Y-m-d", time());
                    $startdate = strtotime($nowDate);
                    $enddate = strtotime($deadline);
                    $days = round(($enddate - $startdate) / 3600 / 24);
                    echo "($days days before the deadline!)";
                    if ($login_user == 'wind')
                        echo anchor('add_controller/index/' . $item->id, ' [+]');
                    switch ($item->deepth) {
                        case 0: echo "</h2>";
                            break;
                        case 1: echo "</h3>";
                            break;
                    }
                    echo "<li>";
                    list_print($item->cid, $array, $login_user);
                    echo "</li>";
                }
                echo "</i></ul>";
            }
        }

        list_print(0, $array, $login_user);
        ?>
    </body>
</html>
