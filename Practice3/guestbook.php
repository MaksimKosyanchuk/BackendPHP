<?php
// TODO 1: PREPARING ENVIRONMENT: 1) session 2) functions
session_start();

// TODO 2: ROUTING

// TODO 3: CODE by REQUEST METHODS (ACTIONS) GET, POST, etc. (handle data from request): 1) validate 2) working with data source 3) transforming data

// TODO 4: RENDER: 1) view (html) 2) data (from php)

    function renderGuestBookComments($filePath = "data/comments.csv") {
        if (file_exists($filePath)) {
            $file = fopen($filePath, "r");

            fgetcsv($file);

            echo '<ul class="list-group">';
            while (($row = fgetcsv($file)) !== false) {
                $name = htmlspecialchars($row[0]);
                $email = htmlspecialchars($row[1]);
                $message = nl2br(htmlspecialchars($row[2]));

                echo '<li class="list-group-item">';
                echo "<strong>$name</strong> ($email)<br>";
                echo "<p>$message</p>";
                echo '</li>';
            }
            echo '</ul>';

            fclose($file);
        } else {
            echo "<p>Коментарі відсутні.</p>";
        }
    }

    function js_alert($message) {
        echo "<script>alert('" . addslashes($message) . "');</script>";
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (
            isset($_POST["name"]) && !empty(trim($_POST["name"])) &&
            isset($_POST["email"]) && !empty(trim($_POST["email"])) &&
            isset($_POST["message"]) && !empty(trim($_POST["message"]))
        ) {
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);
            $message = trim($_POST["message"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                js_alert("Некоректний email.");
                exit;
            }

            $name = str_replace('"', '""', $name);
            $email = str_replace('"', '""', $email);
            $message = str_replace('"', '""', $message);

            $dir = 'data';
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $filePath = $dir . "/comments.csv";
            $isNewFile = !file_exists($filePath);

            $file = fopen($filePath, "a");
            if ($file) {
                if ($isNewFile) {
                    fwrite($file, "\"Ім'я\",\"Email\",\"Повідомлення\"\n");
                }

                $row = "\"$name\",\"$email\",\"$message\"\n";
                fwrite($file, $row);
                fclose($file);
                js_alert("Дані успішно збережено.");
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                js_alert("Не вдалося відкрити файл для запису.");
            }

        } else {
            js_alert("Будь ласка, заповніть всі поля.");
        }
    }
?>

<!DOCTYPE html>
<html>

<?php require_once 'sectionHead.php' ?>

<body>

<div class="container">

    <!-- navbar menu -->
    <?php require_once 'sectionNavbar.php' ?>
    <br>

    <!-- guestbook section -->
    <div class="card card-primary">
        <div class="card-header bg-primary text-light">
            GuestBook form
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-sm-6">

                    <!-- TODO: create guestBook html form   -->

                    <form action="" method="post">
                        <label for="name">Имя:</label><br>
                        <input type="text" id="name" name="name" required><br><br>

                        <label for="email">Email:</label><br>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="message">Сообщение:</label><br>
                        <textarea id="message" name="message" rows="5" required></textarea><br><br>

                        <input type="submit" name="submit" value="Отправить">
                    </form>

                </div>
            </div>

        </div>
    </div>

    <br>

    <div class="card card-primary">
        <div class="card-header bg-body-secondary text-dark">
            Сomments
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">

                    <!-- TODO: render guestBook comments   -->
                    <?php
                        renderGuestBookComments();
                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
