<?php

//Username: vWKWiV5SAU
//Database name: vWKWiV5SAU
//Password: BVGfGXxhj0
//Server: remotemysql.com
//Port: 3306

function getPDOconn(){

    $host = 'remotemysql.com';
    $dbname = 'vWKWiV5SAU';
    $user = 'vWKWiV5SAU';
    $password = 'BVGfGXxhj0';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

function runPDOQuery($query){

    $conn = getPDOconn();
    $result = array();
    foreach ($conn->query($query) as $row) {
        $result[] = $row;
    }
    $conn = null;
    return $result;
}


function apiRequest($metodo)
{
    $req = file_get_contents(api . $metodo);
    return $req;
}

function send($id, $text)
{
    if (strpos($text, '\n')) {
        $text = urlencode($text);
    }
    return apiRequest("sendMessage?text=$text&parse_mode=HTML&chat_id=$id");
}

function getDataOdierna()
{
    $mese = date('F');
    $mese = getMesiIta($mese);

    return date('d') . " " . $mese . " " . date('Y');
}

function getTurni($year, $week)
{

    $turni = [
        '2019' => [
            '20' => 'team1', '21' => 'team2', '22' => 'team3', '23' => 'team4',
            '24' => 'team1', '25' => 'team2', '26' => 'team3', '27' => 'team4',
            '28' => 'team1', '29' => 'team2', '30' => 'team3', '31' => 'team4',
            '32' => 'team1', '33' => 'team2', '34' => 'team3', '35' => 'team4',
            '36' => 'team1', '37' => 'team2', '38' => 'team3', '39' => 'team4',
            '40' => 'team1', '41' => 'team2', '42' => 'team3', '43' => 'team4',
            '44' => 'team1', '45' => 'team2', '46' => 'team3', '47' => 'team4',
            '48' => 'team1', '49' => 'team2', '50' => 'team3', '51' => 'team4',
            '52' => 'team1'
        ],
        '2020' => [
            '1' => 'team2', '2' => 'team3', '3' => 'team4', '4' => 'team1',
            '5' => 'team2', '6' => 'team3', '7' => 'team4', '8' => 'team1',
            '9' => 'team2', '10' => 'team3', '11' => 'team4', '12' => 'team1',
            '13' => 'team2', '14' => 'team3', '15' => 'team4', '16' => 'team1',
            '17' => 'team2', '18' => 'team3', '19' => 'team4', '20' => 'team1',
            '21' => 'team2', '22' => 'team3', '23' => 'team4', '24' => 'team1',
            '25' => 'team2', '26' => 'team3', '27' => 'team4', '28' => 'team1',
            '29' => 'team2', '30' => 'team3', '31' => 'team4', '32' => 'team1',
            '33' => 'team2', '34' => 'team3', '35' => 'team4', '36' => 'team1',
            '37' => 'team2', '38' => 'team3', '39' => 'team4', '40' => 'team1',
            '41' => 'team2', '42' => 'team3', '43' => 'team4', '44' => 'team1',
            '45' => 'team2', '46' => 'team3', '47' => 'team4', '48' => 'team1',
            '49' => 'team2', '50' => 'team3', '51' => 'team4', '52' => 'team1'
        ],
    ];
    return $turni[$year][$week];
}


function getDay($d)
{
    $day = [
        'Tuesday' => '1',
        'Thursday' => '2',
        'Saturday' => '3',
        'Sunday' => '3'
    ];
    return $day[$d];
}
function getDayNoParam()
{
    $day = [
        'Tuesday' => '1',
        'Thursday' => '2',
        'Saturday' => '3',
        'Sunday' => '3'
    ];
    return $day;
}

function getTeam($team)
{

    $squadre = [
        'team1' => [
            '1' => 'Bruno',
            '2' => 'Giovanni',
            '3' => 'Tutti'
        ],
        'team2' => [
            '1' => 'Rocco',
            '2' => 'Bruno',
            '3' => 'Giovanni'
        ],
        'team3' => [
            '1' => 'Tutti',
            '2' => 'Rocco',
            '3' => 'Bruno'
        ],
        'team4' => [
            '1' => 'Giovanni',
            '2' => 'Tutti',
            '3' => 'Rocco'
        ],
    ];
    return $squadre[$team];
}

function getPulizie($day)
{

    $tipo_pulizia = [
        '1' => 'Bagno',
        '2' => 'Bagno e Cucina',
        '3' => 'Tutta la Casa'
    ];
    return $tipo_pulizia[$day];
}


function getDayIta($day)
{

    $traslate = [
        'Monday' => 'Lunedì',
        'Tuesday' => 'Martedì',
        'Wednesday' => 'Mercoledì',
        'Thursday' => 'Giovedì',
        'Friday' => 'Venerdì',
        'Saturday' => 'Sabato',
        'Sunday' => 'Domenica'
    ];
    return $traslate[$day];
}

function getTagPartecipanti($nome)
{

    $partecipanti = [
        'Giovanni' => [
            'id' => '354008242',
            'chat_name' => '@jenko_11'
        ],
        'Tutti' => [
            'chat_name' => 'all'
        ],
    ];
    return $partecipanti[$nome]['chat_name'];
}
function getAllPartecipanti()
{

    $partecipanti = [
        'Giovanni' => [
            'id' => '354008242',
            'chat_name' => '@jenko_11'
        ],
    ];
    return $partecipanti;
}

function getPartecipanti($nome)
{

    $partecipanti = [
        'Giovanni' => [
            'id' => '354008242',
            'chat_name' => '@jenko_11'
        ],
        'Tutti' => [
            'chat_name' => 'all'
        ],
    ];
    return $partecipanti[$nome]['id'];
}

function getMesiIta($mese){

    $traslate = [
        'January' => 'Gennaio',
        'February' => 'Febbraio',
        'March' => 'Marzo',
        'April' => 'Aprile',
        'May' => 'Maggio',
        'June' => 'Giugno',
        'July' => 'Luglio',
        'August' => 'Agosto',
        'September' => 'Settembre',
        'October' => 'Ottobre',
        'November' => 'Novembre',
        'December' => 'Dicembre'
    ];
    return $traslate[$mese];
}
