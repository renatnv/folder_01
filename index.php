<?php

/* Copyright © 2021 Renat Gazizov. All rights reserved. */

require('sys.php');

$result = sqlQuery();
$edProgramList = sqlResult($result);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>folder_001</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>

    <h1>Выбор программы обучения</h1>

    <div id="menuButtonMain">
        <span>Выбрать</span>
        <span>&or;</span>
    </div>
    
    <div id="menuContainer" class="hide">
        <input type="text" placeholder="Поиск по списку...">
        <div>        
            <p class="menuSelectAll">
                <input type="checkbox">
                <span>Выбрать все</span>
            </p>
            <form>
                <?php
                if (!empty($edProgramList)) {
                    foreach ($edProgramList as $edProgramItem) {
                        ?>
                        <p class="menuSelectItem">
                            <input type="checkbox" name="edProgramItems[]" value="<?=$edProgramItem['fId']?>">
                            <span><?=$edProgramItem['fName']?></span>
                        </p>
                        <?php
                    }
                }
                ?>
            </form>
            <p class="menuMessage hide"></p>
        </div>
        <input id="menuButtonFilter" type="button" value="Фильтр">
    </div>

    <label for="menuButtonMain" id="menuLabelMain" class="hide"></label>

    <table>
        <thead>
            <tr>
                <td>№</td>
                <td>Программа</td>
            </tr>
        </thead>
        <tbody id="tableContent">
            <?php
            if (!empty($edProgramList)) {
                foreach ($edProgramList as $edProgramItem) {
                    ?>
                    <tr>
                        <td><?=++$edProgramItemNum?></td>
                        <td><?=$edProgramItem['fName']?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="/scripts.js"></script>

</body>
</html>
