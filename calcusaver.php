<?php
header('Content-Type: application/json');
include 'conn.php';

class Calculator {
    private $numbers;
    private $operators;
    private $validChars;

    public function __construct($numbers) {
        $this->numbers = $numbers;
        $this->operators = ['+', '-', '*', '/'];
        $this->validChars = array_merge(range('0', '9'), $this->operators, ['.']);
    }

    private function calculate($input) {
        $input = $this->prioritizedOperations($input);
        return $this->basicOperations($input);
    }

    private function prioritizedOperations($input) {
        $result = '';
        $number = '';
        $current_operator = '';
        $pending_number = null;

        for ($i = 0; $i < strlen($input); $i++) {
            $char = $input[$i];

            if (is_numeric($char) || $char === '.') {
                $number .= $char;
            }

            if (in_array($char, $this->operators) || $i == strlen($input) - 1) {
                if ($current_operator === '*' || $current_operator === '/') {
                    if ($pending_number !== null) {
                        $pending_number = $current_operator === '*' 
                            ? $pending_number * floatval($number)
                            : $pending_number / floatval($number);
                    }
                } else {
                    if ($pending_number !== null) {
                        $result .= $pending_number;
                    }
                    $pending_number = floatval($number);
                    if ($current_operator) {
                        $result .= $current_operator;
                    }
                }

                $current_operator = $char;
                $number = '';
            }
        }

        if ($pending_number !== null) {
            $result .= $pending_number;
        }

        return $result;
    }

    private function basicOperations($input) {
        $result = 0.0;
        $number = '';
        $current_operator = '+';
        $isFirst = true;

        for ($i = 0; $i < strlen($input); $i++) {
            $char = $input[$i];

            if (is_numeric($char) || $char === '.') {
                $number .= $char;
            }

            if (in_array($char, $this->operators) || $i == strlen($input) - 1) {
                if ($isFirst && $number != '') {
                    if ($current_operator == '-') {
                        $result = -floatval($number);
                    } else {
                        $result = floatval($number);
                    }
                    $isFirst = false;
                } else {
                    if ($current_operator == '+') {
                        $result += floatval($number);
                    } elseif ($current_operator == '-') {
                        $result -= floatval($number);
                    }
                }

                $current_operator = $char;
                $number = '';
            }
        }

        return $result;
    }

    public function processExpression() {
        $input = implode('', $this->numbers);

        for ($i = 0; $i < strlen($input); $i++) {
            if (!in_array($input[$i], $this->validChars)) {
                return ['error' => 'Geçersiz karakterler içeriyor'];
            }
        }

        $result = $this->calculate($input);

        if ($result === FALSE) {
            return ['error' => 'Hesaplama hatası'];
        }

        return ['result' => $result];
    }

    public function saveResult($numbers, $result, $conn) {
        $stmt = $conn->prepare("INSERT INTO calculated (numbers, result) VALUES (:numbers, :result)");
        $stmt->bindParam(':numbers', $numbers);
        $stmt->bindParam(':result', $result);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

function saveCalculation($conn, $expression, $result) {
    $stmt = $conn->prepare("INSERT INTO calculated (numbers, result) VALUES (:numbers, :result)");
    $stmt->bindParam(':numbers', $expression);
    $stmt->bindParam(':result', $result);
    if ($stmt->execute()) {
        return ['status' => 'success', 'message' => 'Hesaplama kaydedildi'];
    } else {
        return ['status' => 'error', 'message' => 'Hesaplama kaydedilemedi'];
    }
}

if (isset($_POST['numbers'])) {
    $numbers = $_POST['numbers'];
    $calculator = new Calculator($numbers);
    $response = $calculator->processExpression();
    echo json_encode($response);
} elseif (isset($_POST['save']) && $_POST['save'] == 'true') {
    $expression = $_POST['expression'];
    $result = $_POST['result'];
    $response = saveCalculation($conn, $expression, $result);
    echo json_encode($response);
}
?>
