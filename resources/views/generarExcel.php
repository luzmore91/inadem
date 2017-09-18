<?php

Excel::create('Filename', function($excel) {

    // Our first sheet
    $excel->sheet('First sheet', function($sheet) {

    });

    // Our second sheet
    $excel->sheet('Second sheet', function($sheet) {

    });

})->export('xls');

?>