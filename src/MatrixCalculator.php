<?php

namespace Vladyslav10111\MatrixCalculator;

class MatrixCalculator
{
    // Generates an HTML form to input matrix values
    public function form_display($a, $b): string
    {
        $formHTML = '';
        $formHTML .= '<div class="std-container">';
        $formHTML .= '<form id="matrix-form" method="POST">';
        $formHTML .= '<input type="hidden" name="matrix-form" value="matrix-form">';
        $formHTML .= '<h2>Matrix Form 1</h2>';
        $formHTML .= '<table>';

        for ($i = 1; $i <= $b; $i++) {
            $formHTML .= '<tr>';
            for ($j = 1; $j <= $a; $j++) {
                $randomValue = rand(1, 100);
                $formHTML .= '<td><input type="number" min="1" max="100" name="table1_cell_' . $i . '_' . $j . '" value="' . $randomValue . '" /></td>';
            }
            $formHTML .= '</tr>';
        }
        $formHTML .= '</table>';

        $formHTML .= '<h2>Matrix Form 2</h2>';
        $formHTML .= '<table>';

        for ($i = 1; $i <= $b; $i++) {
            $formHTML .= '<tr>';
            for ($j = 1; $j <= $a; $j++) {
                $randomValue = rand(1, 100);
                $formHTML .= '<td><input type="number" min="1" max="100" name="table2_cell_' . $i . '_' . $j . '" value="' . $randomValue . '" /></td>';
            }
            $formHTML .= '</tr>';
        }
        $formHTML .= '</table>';
        $formHTML .= '<div class="matrix-calculator__submit-wrap">';
        $formHTML .= '<button type="submit" onclick="disableForm()">
<span></span>
                    <span></span>
                    <span></span>
                    <span></span>
Generate Matrix</button>';
        $formHTML .= '<button type="button" class="matrix-calculator__clear" onclick="clearMatrixForm()">Clear</button>';
        $formHTML .= '</div>';
        $formHTML .= '</form>';
        $formHTML .= '</div>';
        return $formHTML;
    }

    // Displays matrices in an HTML table format
    public function table_display($a, $b): string
    {
        $tableHTML = '';
        $tableHTML .= '<div class="std-container">';
        $tableHTML .= '<h2>Matrix 1</h2><table>';
        $tableHTML .= '<form id="matrix-table" method="POST">';
        $tableHTML .= '<input type="hidden" name="matrix-table" value="matrix-table">';
        foreach ($a as $rowIndex => $row) {
            $tableHTML .= '<tr>';
            foreach ($row as $colIndex => $cell) {
                $tableHTML .= '<td><input type="number" min="1" max="100" name="table1_cell_' . $rowIndex . '_' . $colIndex . '" value="' . htmlspecialchars($cell) . '" readonly></td>';
            }
            $tableHTML .= '</tr>';
        }
        $tableHTML .= '</table>';

        $tableHTML .= '<h2>Matrix 2</h2><table>';
        foreach ($b as $rowIndex => $row) {
            $tableHTML .= '<tr>';
            foreach ($row as $colIndex => $cell) {
                $tableHTML .= '<td><input type="number" min="1" max="100" name="table2_cell_' . $rowIndex . '_' . $colIndex . '" value="' . htmlspecialchars($cell) . '" readonly></td>';
            }
            $tableHTML .= '</tr>';
        }
        $tableHTML .= '</table>';

        $tableHTML .= '<input type="hidden" name="result-option" id="result-option">';
        $tableHTML .= '<div class="matrix-calculator__submit-wrap">';
        $tableHTML .= '<button id="calculate" type="submit" onclick="unblockForm()">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
Calculate</button>';
        $tableHTML .= '</div>';
        $tableHTML .= '</form>';
        $tableHTML .= '</div>';
        return $tableHTML;
    }

    // Adds two matrices together
    public function addMatrices($matrixA, $matrixB): string
    {
        $result = [];
        foreach ($matrixA as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$i][$j] = $value + $matrixB[$i][$j];
            }
        }
        return $this->generateTable($result, 'Result');
    }

    // Subtracts one matrix from another
    public function subtractMatrices($matrixA, $matrixB): string
    {
        $result = [];
        foreach ($matrixA as $i => $row) {
            foreach ($row as $j => $value) {
                $result[$i][$j] = $value - $matrixB[$i][$j];
            }
        }
        return $this->generateTable($result, 'Result');
    }

    // Multiplies two matrices
    public function multiplyMatrices($matrixA, $matrixB): string
    {

        $rowsA = count($matrixA);
        $colsA = count($matrixA[1]);  // Оскільки індексація з 1, використовуємо $matrixA[1]
        $rowsB = count($matrixB);
        $colsB = count($matrixB[1]);  // Теж індексація з 1 для матриці B


        if ($colsA != $rowsB) {
            return "<div class='std-container'><div class='error-message'>Matrices cannot be multiplied because the number of columns of the first matrix is not equal to the number of rows of the second.</div></div>";
        }

        $result = array_fill(1, $rowsA, array_fill(1, $colsB, 0));  // Ініціалізація також з індексацією з 1

        for ($i = 1; $i <= $rowsA; $i++) {
            for ($j = 1; $j <= $colsB; $j++) {
                for ($k = 1; $k <= $colsA; $k++) {
                    $result[$i][$j] += $matrixA[$i][$k] * $matrixB[$k][$j];
                }
            }
        }

        return $this->generateTable($result, 'Result');
    }

    // Transposes both matrices
    public function transposeMatrix($matrixA, $matrixB): string
    {
        $transposedA = [];
        foreach ($matrixA as $i => $row) {
            foreach ($row as $j => $value) {
                $transposedA[$j][$i] = $value;
            }
        }

        $transposedB = [];
        foreach ($matrixB as $i => $row) {
            foreach ($row as $j => $value) {
                $transposedB[$j][$i] = $value;
            }
        }

        $tableA = $this->generateTable($transposedA, 'Result Matrix 1');
        $tableB = $this->generateTable($transposedB, 'Result Matrix 2');

        return $tableA . '<br>' . $tableB;
    }

    // Generates an HTML table for a given matrix
    private function generateTable($matrix, $title): string
    {
        $tableHTML = '<div class="std-container">';
        $tableHTML .= "<h2>$title</h2><table style='border-collapse: collapse;' border='1px'>";
        foreach ($matrix as $row) {
            $tableHTML .= '<tr>';
            foreach ($row as $cell) {
                $tableHTML .= "<td style='padding: 5px; text-align: center;'>" . htmlspecialchars($cell) . "</td>";
            }
            $tableHTML .= '</tr>';
        }
        $tableHTML .= '</table>';
        $tableHTML .= '</div>';
        return $tableHTML;
    }
}
