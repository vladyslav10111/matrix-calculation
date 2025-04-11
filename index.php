<?php

require 'vendor/autoload.php';

use Vladyslav10111\MatrixCalculator\Process;

$Process = new Process();

?>
<!DOCTYPE html>
<html lang='uk'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <script defer src="assets/js/formControl.js"></script>
    <script defer src="assets/js/urlHandler.js"></script>
    <script defer src="assets/js/formState.js"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <title>Matrix Calculator</title>
    <meta name="description" content="Matrix Calculator – tool for performing matrix operations: addition, subtraction, multiplication, and transposition.">
</head>
<body>

<section class="matrix-calculator">
    <div class="std-container">

        <h1 class="matrix-calculator__heading">
            Matrix Calculator
        </h1>
        <form id="main-form" class="matrix-calculator__main-form" method="POST">
            <div class="matrix-calculator__numbers">
                <div class="matrix-calculator__group">
                    <label for="first-number">Columns:</label>
                    <input type="number" name="first-number" id="first-number" min="1" max="10" required>
                </div>

                <div class="matrix-calculator__group">
                    <label for="second-number">Rows:</label>
                    <input type="number" name="second-number" id="second-number" min="1" max="10" required>
                </div>
            </div>

            <div class="matrix-calculator__radios">
                <label><input class="option1" type="radio" name="option" value="option1" required> Addition</label>
                <label><input class="option2" type="radio" name="option" value="option2"> Subtraction</label>
                <label><input class="option3" type="radio" name="option" value="option3"> Multiplication</label>
                <label><input class="option4" type="radio" name="option" value="option4"> Transposition</label>
            </div>

            <input type="hidden" name="main-form" value="main-form">

            <div class="matrix-calculator__submit-wrap">
                <button type="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Generate form
                </button>
                <button id="radio-clear2" class="matrix-calculator__clear" type="reset">Clear</button>
            </div>
        </form>
    </div>
</section>

<?php echo $Process->matrix_form_generate(); ?>
<?php echo $Process->matrix_tables_generate(); ?>
<?php echo $Process->result(); ?>

</body>
</html>
