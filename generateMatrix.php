<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2D Array Generator</title>
</head>
<body>
    <form method="GET" action="">
        <label for="size">Enter the size of the matrix (n):</label>
        <input type="number" id="size" name="size" min="1" required>
        <button type="submit">Generate</button>
    </form>

    <?php
    if (isset($_GET['size'])) {
        $size = intval($_GET['size']);
        generateMatrix($size);
    }

    /**
     * Function to generate a 2D matrix with the specified size
     *
     * @param int $size Size of the matrix
     */
    function generateMatrix($size) {
        echo "<h2>Generated {$size}x{$size} Matrix:</h2>";
        echo "<pre>";
        
        // Initialize and fill the matrix
        $matrix = [];
        for ($i = 0; $i < $size; $i++) {
            $matrix[$i] = array_fill(0, $size, 0);
            $matrix[$i][$i] = $size; // Set diagonal elements
        }

        // Display the matrix
        foreach ($matrix as $row) {
            echo implode(" ", $row) . "\n";
        }

        echo "</pre>";
    }
    ?>
</body>
</html>
