<?php

/* Copyright © 2021 Renat Gazizov. All rights reserved. */

require('sys.php');

$result = sqlQuery($_POST['edProgramItems']);
$edProgramList = sqlResult($result);

if (!empty($edProgramList)) {
    foreach ($edProgramList as $edProgramItem) {
        ?>
        <tr>
            <td><?=++$edProgramItemNum?></td>
            <td><?=$edProgramItem['fName']?></td>
        </tr>
        <?php
    }
} else {
    ?>
    <tr>
        <td>-</td>
        <td>Ничего не найдено. Повторите запрос.</td>
    </tr>
    <?php
}

?>
