<!DOCTYPE html>
<html>
<head>
    <title>PHP Calculation Tutorial</title>
</head>
<body>
    <!-- Pulling in the logic file -->
    <?php include 'calc_logic.php'; ?>

    <h1>Calculation Results</h1>
    <p>Value 1: <b><?php echo $val1; ?></b></p>
    <p>Value 2: <b><?php echo $val2; ?></b></p>
    <hr>

    <ul>
        <li><strong>Sum (+):</strong> <?php echo $sum; ?></li>
        <li><strong>Difference (-):</strong> <?php echo $diff; ?></li>
        <li><strong>Product (*):</strong> <?php echo $product; ?></li>
        <li><strong>Division (/):</strong> <?php echo $div; ?></li>
        <li><strong>Modulus (%):</strong> <?php echo "The remainder of $val1 divided by 3 is $rem"; ?></li>
    </ul>

    <p><i>Total after assignment operation (Sum + 100): <?php echo $total; ?></i></p>
</body>
</html>
