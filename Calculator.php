<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Calculator</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        .calculator {
            background-color: #2c3e50;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            width: 320px;
        }

        h2 {
            color: #ecf0f1;
            text-align: center;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="number"] {
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #34495e;
            color: #ecf0f1;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input[type="number"]:focus {
            outline: none;
            box-shadow: 0 0 0 2px #3498db;
        }

        select {
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #34495e;
            color: #ecf0f1;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        button {
            padding: 15px;
            border: none;
            border-radius: 8px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-weight: bold;
        }

        button:hover {
            background-color: #2980b9;
        }

        .result-box {
            background-color: #34495e;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            color: #ecf0f1;
            font-size: 18px;
        }

        .result-box span {
            color: #2ecc71;
            font-weight: bold;
        }

        ::placeholder {
            color: #bdc3c7;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h2>Kalkulator Sederhana</h2>
        <form method="post">
            <input type="number" step="any" name="num1" required placeholder="Angka Pertama">
            <select name="operator">
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input type="number" step="any" name="num2" required placeholder="Angka Kedua">
            <button type="submit" name="calculate">Hitung</button>
        </form>
        <?php
        if (isset($_POST['calculate'])) {
            $num1 = (float)$_POST['num1'];
            $num2 = (float)$_POST['num2'];
            $operator = $_POST['operator'];
            $result = '';

            switch ($operator) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    if ($num2 == 0) {
                        $result = "Error: Pembagian Dengan Nol!";
                    } else {
                        $result = $num1 / $num2;
                    }
                    break;
                default:
                    $result = "Operator Tidak Valid";
                    break;
            }
            echo "<div class='result-box'>Hasil: $result</div>";
        }
        ?>
    </div>
</body>
</html>