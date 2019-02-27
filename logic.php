<?php

session_start();

$calculate = $_SESSION['area'] ?? null;
$gender = $calculate["gender"];
$pounds = $calculate["pounds"];
$feet = $calculate["feet"];
$inches = $calculate["inches"];
$bsa = $calculate["bsa"];
$bsaSquareFeet = $calculate["bsaSquareFeet"];
$basketballs = $calculate["basketballs"];

session_unset();