<?php

function dd($variable){
    echo '<pre>';
    die(var_dump($variable));
    echo '</pre>';
}