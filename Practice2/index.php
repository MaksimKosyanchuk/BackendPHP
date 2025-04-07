<?php
    $config = require 'config.php';
    $apiKey = $config['google_api_key'];
    $cx = $config['google_cx'];

    $search = isset($_GET['search']) ? urlencode($_GET['search']) : '';
    $urlInput = isset($_GET['url']) ? urlencode($_GET['url']) : '';

    if ($urlInput) {
        $search = $urlInput;
    }

    $url = "https://www.googleapis.com/customsearch/v1?key={$apiKey}&cx={$cx}&q={$search}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    $items = isset($data['items']) ? $data['items'] : [];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search Results</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Search Form</h2>
        <form method="GET" action="">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" value=""><br><br>
            <label for="url">URL (optional):</label>
            <input type="text" id="url" name="url" value=""><br><br>
            <input type="submit" value="Submit">
        </form>

        <h3>Search Results:</h3>
        <?php
            if (!empty($items)) {
                echo "<ul>";
                foreach ($items as $item) {
                    echo "<li>";
                    echo "<p class='link'>" . htmlspecialchars($item['link']) . "</p>";
                    echo "<a href='" . htmlspecialchars($item['link']) . "'target='_blank' class='title'>" . htmlspecialchars($item['title']) . "</a>";
                    echo "<p'>" . htmlspecialchars($item['snippet']) . "</p>";
                    echo "</li>";
                }
                echo "</ul>";
            } else {
                echo "No results found.";
            }
        ?>
    </body>
</html>
