<?php

/* Copyright © 2021 Renat Gazizov. All rights reserved. */

function connect() {
    static $setConnect = null;
    if ($setConnect === null) {
        $setConnect = mysqli_connect('x', 'x', 'x', 'x') or die ('Connection error');
    }
    return $setConnect;
}

mysqli_set_charset(connect(), 'utf8');

function sqlQuery($filter = null) {
    if (!empty($filter) && is_array($filter)) {
        $newFilter = implode(',', array_filter($filter, 'is_numeric'));
        return mysqli_query(connect(), 'select fId, fName from tEdProgram where fId in ('.$newFilter.') order by fName');
    } else {
        return mysqli_query(connect(), 'select fId, fName from tEdProgram order by fName');
    }
}

function sqlResult($result) {
    if (!empty($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $tmp[] = $row;
        }
        return $tmp;
    }
}

?>
