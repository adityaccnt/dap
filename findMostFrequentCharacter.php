<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Most Frequent Character</title>
</head>
<body>
    <h1>Find the Most Frequent Character in a Sentence</h1>
    
    <form action="" method="GET" autocomplete="off">
        <label for="sentence">Enter a sentence:</label><br>
        <input type="text" id="sentence" name="sentence" required><br><br>
        <input type="submit" value="Submit">
    </form>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['sentence'])) {

        /**
         * Finds the most frequent character in a given sentence.
         *
         * @param string $sentence The input sentence.
         * @return string A message indicating the most frequent character and its count.
         */
        function findMostFrequentCharacter($sentence) {
            // Remove spaces and convert to lowercase
            $sentence = str_replace(' ', '', strtolower($sentence));

            // Initialize an associative array to count character occurrences
            $charCount = [];

            // Count each character in the sentence
            for ($i = 0; $i < strlen($sentence); $i++) {
                $char = $sentence[$i];
                if (isset($charCount[$char])) {
                    $charCount[$char]++;
                } else {
                    $charCount[$char] = 1;
                }
            }

            // Find the character with the maximum count
            $maxChar = '';
            $maxCount = 0;
            foreach ($charCount as $char => $count) {
                if ($count > $maxCount) {
                    $maxChar = $char;
                    $maxCount = $count;
                }
            }

            return "Character '{$maxChar}' appears {$maxCount} times.";
        }

        // Get the input sentence from the GET request
        $sentence = $_GET['sentence'];

        // Call the function to find the most frequent character
        $result = findMostFrequentCharacter($sentence);

        // Display the result
        echo "<h2>Result</h2>";
        echo "<p>{$result}</p>";
    }
    ?>
</body>
</html>
