<?php
define('token', "668920983:AAH5OAvntJoUGWEDjE9CKQ9P4nQdY5MybxI");

include 'execute.php';

if ($text == "/start") {
    send($cid, 'Benvenuto sul bot');
}