        <h2><i>
                <?php
                if ($flag) {
                    foreach ($array[0] as $item) {
                        if ($item->id == $id) {
                            echo $item->subject;
                            echo anchor('', ' [&larr;]');
                            if ($login_user == 'wind')
                                echo anchor('add_controller/index/' . $item->id, ' [+]');
                        }
                    }
                }
                else {
                    echo "Catalogus";
                    if ($login_user == 'wind')
                        echo anchor('add_controller/index/0', ' [Add Book]');
                }
                ?>
            </i></h2>

        <?php

        function list_print($id, $array, $login_user, $flag) {
            date_default_timezone_set("PRC");
            if (isset($array[$id])) {
	                $item = $array[$id];
                    echo "<ul>";
                    echo "<i><li>";
                    echo "<strong>";
                    echo anchor('one_controller/index/' . $item->id, $item->subject);
                    echo "</strong>";
                    if ($login_user == 'wind' and $item->deepth)
                        echo anchor('add_controller/index/' . $item->id, ' [+]');
                    echo "</li></i>";
                    if ($flag) {
                        list_print($item->cid, $array, $login_user, $flag);
                    }
                    echo "</ul>";
                
            }
        }

        list_print($id, $array, $login_user, $flag);
        ?>
        <ul>
