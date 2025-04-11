<?php

namespace Vladyslav10111\MatrixCalculator;

class Process
{

    // Generates the matrix input form based on user input
    public function matrix_form_generate(): string
    {
        $matrix = [];
        $MatrixCalculator = new MatrixCalculator();

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["main-form"])) {
            $matrix[] = $_POST["first-number"];
            $matrix[] = $_POST["second-number"];
            return $MatrixCalculator->form_display($matrix[0], $matrix[1]);
        }
        return '';
    }

    // Processes the submitted matrix data and prepares the display tables
    public function matrix_tables_generate(): string
    {
        $matrix_table_1 = [];
        $matrix_table_2 = [];
        $MatrixCalculator = new MatrixCalculator();

        if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($_POST["result-option"]) && isset($_POST["matrix-form"])) {

            foreach ($_POST as $key => $value) {
                if (preg_match('/^table1_cell_(\d+)_(\d+)$/', $key, $matches)) {
                    $row = (int)$matches[1];
                    $col = (int)$matches[2];

                    if (!isset($matrix_table_1[$row])) {
                        $matrix_table_1[$row] = [];
                    }
                    $matrix_table_1[$row][$col] = (int)$value;
                }

                if (preg_match('/^table2_cell_(\d+)_(\d+)$/', $key, $matches)) {
                    $row = (int)$matches[1];
                    $col = (int)$matches[2];

                    if (!isset($matrix_table_2[$row])) {
                        $matrix_table_2[$row] = [];
                    }
                    $matrix_table_2[$row][$col] = (int)$value;
                }
            }
            return $MatrixCalculator->table_display($matrix_table_1, $matrix_table_2);
        }
        return '';
    }

    // Processes matrix operations (addition, subtraction, multiplication, or transposition)
    public function result(): string
    {
        $matrix_table_1 = [];
        $matrix_table_2 = [];
        $result = '';
        $MatrixCalculator = new MatrixCalculator();

        if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["result-option"]) && isset($_POST["matrix-table"])) {

            foreach ($_POST as $key => $value) {
                if (preg_match('/^table1_cell_(\d+)_(\d+)$/', $key, $matches)) {
                    $row = (int)$matches[1];
                    $col = (int)$matches[2];
                    $matrix_table_1[$row][$col] = (int)$value;
                }
                if (preg_match('/^table2_cell_(\d+)_(\d+)$/', $key, $matches)) {
                    $row = (int)$matches[1]; // Віднімаємо 1
                    $col = (int)$matches[2]; // Віднімаємо 1
                    $matrix_table_2[$row][$col] = (int)$value;
                }
            }

            $result = match ($_POST["result-option"]) {
                'option1' => $MatrixCalculator->addMatrices($matrix_table_1, $matrix_table_2),
                'option2' => $MatrixCalculator->subtractMatrices($matrix_table_1, $matrix_table_2),
                'option3' => $MatrixCalculator->multiplyMatrices($matrix_table_1, $matrix_table_2),
                'option4' => $MatrixCalculator->transposeMatrix($matrix_table_1, $matrix_table_2),
                default => "Error: Invalid operation selected.",
            };
        }
        return $result;
    }
}
