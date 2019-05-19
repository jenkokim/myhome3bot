<?php

function getDataOdierna()
{
    $mese = date('F');
    $mese = getMesiIta($mese);

    return date('d') . " " . $mese . " " . date('Y');
}