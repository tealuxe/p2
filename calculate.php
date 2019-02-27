<?php

require 'Form.php';

use DWA\Form;

// conversion formulas

function poundsToKilograms($pounds)
{
    return $pounds / 2.2046;
}

function heightToCentimeters($feet, $inches)
{
    return ($feet * 30.46) + ($inches * 2.54);
}

function squareMetersToSquareFeet($squaremeters)
{
    return ($squaremeters * 10.7639);
}

session_start();

// use teacher-provided form class to access and validate form
$form = new Form($_GET);

// https://github.com/susanBuck/dwa15-php/blob/master/validation-logic.php
$submitted = $form->isSubmitted();

if ($submitted) {
    $errors = $form->validate(
        [
            'weightInput' => 'required|digit|min:1',
            'heightFeet' => 'required|digit|min:1',
            'heightInches' => 'required|digit|min:0',
            'genderInput' => 'required'
        ]
    );
}

$gender = $form->get('genderInput');
$pounds = $form->get('weightInput');
$feet = $form->get('heightFeet');
$inches = $form->get('heightInches');

// hard-coded Schlich BSA formula
if ($gender == "Male") {
    $bsa = 0.000579479 * (poundsToKilograms($pounds) ** 0.38) * (heightToCentimeters($feet, $inches) ** 1.24);
} else {
    $bsa = 0.000975482 * (poundsToKilograms($pounds) ** 0.46) * (heightToCentimeters($feet, $inches) ** 1.08);
}

$_SESSION['area'] = [
    'bsa' => $bsa,
    'bsaSquareFeet' => squareMetersToSquareFeet($bsa),
    'gender' => $gender,
    'pounds' => $pounds,
    'feet' => $feet,
    'inches' => $inches,
    'errors' => $errors,
    'basketballs' => $bsa / 0.1787151264
];

// return to main page after calculation
header('Location: index.php');