<!DOCTYPE html>
<html>
<head>
    <title>Лабораторна робота 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        .country-info {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            background-color: #fafafa;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
        }
        input[type="text"] {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #5cb85c;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Інформація про країни</h1>
        <?php
        $filename = 'countries.txt';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newEntry = $_POST['country'] . ", " . $_POST['continent'] . ", " . $_POST['population'] . ", " . $_POST['area'] . ", " . $_POST['government'] . ", " . $_POST['language'] . "\n";
            file_put_contents($filename, $newEntry, FILE_APPEND);
        }

        $content = file_get_contents($filename);
        $countries = explode("\n", trim($content));
        foreach ($countries as $country) {
            if (!empty($country)) {
                echo '<div class="country-info">' . nl2br(htmlspecialchars($country)) . '</div>';
            }
        }
        ?>

        <h2>Додати нову країну</h2>
        <form method="post" action="">
            <label for="country">Країна:</label>
            <input type="text" id="country" name="country" required>
            <label for="continent">Континент:</label>
            <input type="text" id="continent" name="continent" required>
            <label for="population">Кількість населення:</label>
            <input type="text" id="population" name="population" required>
            <label for="area">Площа:</label>
            <input type="text" id="area" name="area" required>
            <label for="government">Форма правління:</label>
            <input type="text" id="government" name="government" required>
            <label for="language">Державна мова:</label>
            <input type="text" id="language" name="language" required>
            <input type="submit" value="Додати">
        </form>
        <footer>
            <p>Автор: Остафійчук Людмила Вікторівна, 302 група</p>
        </footer>
    </div>
</body>
</html>
