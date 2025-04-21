<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        .container {
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
        
        .input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        label {
            font-weight: bold;
            color: #ecf0f1;
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

        .radio-container {
            display: flex;
            justify-content: flex-end; /* Menempatkan radio group di sebelah kanan */
        }

        .radio-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin: 10px 0;
            background: #34495e; /* Tambahkan background untuk kotak */
            padding: 10px; /* Tambahkan padding untuk kotak */
            border-radius: 8px; /* Tambahkan border-radius untuk kotak */
            border: none; /* Hapus border untuk kotak */
        }
        
        .radio-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #ecf0f1; /* Warna teks untuk radio item */
        }
        
        input[type="radio"] {
            accent-color: #3498db; /* Warna radio button */
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
        
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #34495e;
            border-radius: 8px;
            text-align: center;
            color: #ecf0f1;
            font-size: 18px;
        }
        
        .result span {
            color: #2ecc71;
            font-weight: bold;
        }

        .error {
            color: #ff0000;
            padding: 10px;
            background-color: #ffe6e6;
            border: 1px solid #ff0000;
            border-radius: 5px;
            margin-top: 15px;
        }

        ::placeholder {
            color: #bdc3c7;
        }
    </style
</head>
<body>
    <div class="container">
        <h2>Kalkulator Diskon</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="input-group">
                <label for="harga">Harga Barang (Rp)</label>
                <input type="number" id="harga" name="harga" step="any" required>
            </div>
            
            <div class="input-group">
                <label>Pilih Diskon:</label>
                <div class="radio-group">
                    <?php $discounts = [0, 10, 20, 30, 40, 50]; ?>
                    <?php foreach($discounts as $d): ?>
                        <div class="radio-item">
                            <input type="radio" id="diskon<?php echo $d; ?>" 
                                   name="diskon" 
                                   value="<?php echo $d; ?>" 
                                   <?php echo ($d == 0) ? 'checked' : ''; ?>>
                            <label for="diskon<?php echo $d; ?>"><?php echo $d; ?>%</label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <button type="submit" name="submit">Hitung Diskon</button>
        </form>

        <?php
        $harga = 0;
        $diskon = 0;
        $total_diskon = 0;
        $total_bayar = 0;
        $eror = '';

        if (isset($_POST['submit'])) {
            $harga = floatval($_POST['harga']);
            $diskon = isset($_POST['diskon']) ? floatval($_POST['diskon']) : 0;

            // Validasi input
            if ($harga <= 0) {
                $eror = "Harga harus lebih dari 0!";
            } elseif ($diskon < 0 || $diskon > 100) {
                $eror = "Diskon tidak valid!";
            } else {
                $total_diskon = $diskon * $harga / 100;
                $total_bayar = $harga - $total_diskon;
            }
        }
        ?>

        <?php if ($eror): ?>
            <div class="error"><?php echo $eror; ?></div>
        <?php elseif (isset($_POST['submit'])): ?>
            <div class="result">
                <h3>Detail Pembayaran:</h3>
                <p>Harga Asli: Rp <?php echo number_format($harga, 0, ',', '.'); ?></p>
                <p>Diskon (<?php echo $diskon; ?>%): Rp <?php echo number_format($total_diskon, 0, ',', '.'); ?></p>
                <p style="font-weight: bold; color: #4CAF50; font-size: 1.2em;">
                    Total Bayar: Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>