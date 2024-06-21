<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Anagram</title>
</head>
<body>
    <h1>Check If Two Sentences are Anagrams</h1>
    <form method="GET" action="" autocomplete="off">
        <label for="sentence1">Sentence 1:</label>
        <input type="text" id="sentence1" name="sentence1" required>
        <br>
        <label for="sentence2">Sentence 2:</label>
        <input type="text" id="sentence2" name="sentence2" required>
        <br>
        <input type="submit" value="Check">
    </form>

    <?php
    /**
     * Checks if two sentences are anagrams.
     *
     * @param string $sentence1
     * @param string $sentence2
     * @return bool
     */
    function checkAnagram($sentence1, $sentence2) {
        // Remove spaces and convert to lowercase
        $cleanedSentence1 = strtolower(str_replace(' ', '', $sentence1));
        $cleanedSentence2 = strtolower(str_replace(' ', '', $sentence2));

        // If lengths are not equal, they cannot be anagrams
        if (strlen($cleanedSentence1) !== strlen($cleanedSentence2)) {
            return false;
        }

        // Count character frequencies
        $charFrequency1 = count_chars($cleanedSentence1, 1);
        $charFrequency2 = count_chars($cleanedSentence2, 1);

        // Compare character frequencies
        return $charFrequency1 == $charFrequency2;
    }

    if (isset($_GET['sentence1']) && isset($_GET['sentence2'])) {
        $sentence1 = $_GET['sentence1'];
        $sentence2 = $_GET['sentence2'];

        $result = checkAnagram($sentence1, $sentence2);
        echo '<h2>Result:</h2>';
        echo $result ? 'True' : 'False';
    }
    ?>
</body>
</html>
