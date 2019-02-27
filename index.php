<?php
require 'includes/helpers.php';
// matches https://github.com/susanBuck/dwa15-php/blob/master/form-flow/version-c/foobooks.php
require 'logic.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Body Surface Area Formula</title>
    <meta name="description" content="Body Surface Area Formula">
    <meta name="author" content="Bob Dobbs">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<div class="container">
    <div class="row">
        <h1>Body Surface Area Calculator</h1>
        <p>Greetings! This is a body surface area calculator based on the Schlich formula (a gender-based formula among
        <a href='http://www.bmi-calculator.net/bsa-calculator/'>a variety of formulas used</a>). Enter your gender, weight,
        and height, and we will calculate your estimated body surface area. Body surface area (BSA) can be useful in medical
        settings, where it can offer a better indication of the body's requirement for energy than weight itself.
        </p>
    </div>
    <form method='GET' action='/calculate.php'>
        <div class="row">
            <div class="five columns">
                <div class="right">
                    <label for="genderInput">Gender *</label>
                </div>
            </div>
            <div class="seven columns">
                <input type='radio'
                       id='genderInput'
                       value='Male' <?php if (isset($calculate) and $gender == 'Male') echo 'checked' ?>> Male
                <input type='radio'
                       id='genderInput'
                       value='Female' <?php if (isset($calculate) and $gender == 'Female') echo 'checked' ?>> Female
            </div>
        </div>
        <div class="row">
            <div class="five columns">
                <div class="right">
                    <label for="weightInput">Body Weight *</label>
                </div>
            </div>
            <div class="seven columns">
                <input type="number"
                       id="weightInput"
                       value="<?php if (isset($calculate) and $pounds) echo sanitize($calculate["pounds"]) ?>"
                       min="0"> Pounds
            </div>
        </div>
        <div class="row">
            <div class="five columns">
                <div class="right">
                    <label for="heightFeet">Height *</label>
                </div>
            </div>
            <div class="seven columns">
                <select id='heightFeet' name='heightFeet'>
                    <option value='0' <?php if (isset($calculate) and $feet == '0') echo 'selected' ?>>0</option>
                    <option value='1' <?php if (isset($calculate) and $feet == '1') echo 'selected' ?>>1</option>
                    <option value='2' <?php if (isset($calculate) and $feet == '2') echo 'selected' ?>>2</option>
                    <option value='3' <?php if (isset($calculate) and $feet == '3') echo 'selected' ?>>3</option>
                    <option value='4' <?php if (isset($calculate) and $feet == '4') echo 'selected' ?>>4</option>
                    <option value='5' <?php if (isset($calculate) and $feet == '5') echo 'selected' ?>>5</option>
                    <option value='6' <?php if (isset($calculate) and $feet == '6') echo 'selected' ?>>6</option>
                    <option value='7' <?php if (isset($calculate) and $feet == '7') echo 'selected' ?>>7</option>
                </select>
                Feet
                <select id='heightInches' name='heightInches'>
                    <option value='0' <?php if (isset($calculate) and $inches == '0') echo 'selected' ?>>0</option>
                    <option value='1' <?php if (isset($calculate) and $inches == '1') echo 'selected' ?>>1</option>
                    <option value='2' <?php if (isset($calculate) and $inches == '2') echo 'selected' ?>>2</option>
                    <option value='3' <?php if (isset($calculate) and $inches == '3') echo 'selected' ?>>3</option>
                    <option value='4' <?php if (isset($calculate) and $inches == '4') echo 'selected' ?>>4</option>
                    <option value='5' <?php if (isset($calculate) and $inches == '5') echo 'selected' ?>>5</option>
                    <option value='6' <?php if (isset($calculate) and $inches == '6') echo 'selected' ?>>6</option>
                    <option value='7' <?php if (isset($calculate) and $inches == '7') echo 'selected' ?>>7</option>
                    <option value='8' <?php if (isset($calculate) and $inches == '8') echo 'selected' ?>>8</option>
                    <option value='9' <?php if (isset($calculate) and $inches == '9') echo 'selected' ?>>9</option>
                    <option value='10' <?php if (isset($calculate) and $inches == '10') echo 'selected' ?>>10</option>
                    <option value='11' <?php if (isset($calculate) and $inches == '11') echo 'selected' ?>>11</option>
                </select>
                Inches
            </div>
        </div>
        <div class="center">
            <br/>
            <input class="button-primary" type="submit" value="Calculate">
            <p>* All fields are required.</p>
        </div>
    </form>
    <?php if (isset($calculate) && ($calculate["errors"] == false)): ?>
        <div class="result">
            Your estimated body surface area is: <?= round($bsa, 2) ?> in square meters and <?= round($bsaSquareFeet, 2) ?> in square feet.
            That is equal to the area of <?= round($basketballs, 2) ?> NBA regulation basketballs.
            <br/>
            <br/>
        </div>
        <br/>
    <?php endif ?>
    <?php if (isset($calculate["errors"]) && $calculate["errors"]) : ?>
        <div class='alert'>
            <ul>
                <?php foreach ($calculate["errors"] as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
