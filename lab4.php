<!DOCTYPE html>
<html>
<head>
    <title>Лабораторна робота 4</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        form {
            margin: 20px 0;
            text-align: center;
        }
        label {
            margin-right: 10px;
        }
        input[type="text"] {
            padding: 10px;
            width: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        .country-list {
            margin: 20px 0;
        }
        .country {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .country:nth-child(even) {
            background-color: #e9e9e9;
        }
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline-block;
            margin: 0 10px;
        }
        nav ul li a {
            text-decoration: none;
            color: #5cb85c;
            padding: 10px 20px;
            border: 2px solid #5cb85c;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        nav ul li a:hover {
            background-color: #5cb85c;
            color: white;
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
        <h1>Пошук країн за символами</h1>
        <form method="post" action="">
            <label for="chars">Введіть символи:</label>
            <input type="text" id="chars" name="chars"><br>
            <input type="submit" value="Шукати">
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $chars = $_POST['chars'];
            $filename = 'countries.txt';
            $countries = file($filename, FILE_IGNORE_NEW_LINES);

            echo "<h2>Країни, що містять '$chars':</h2>";
            echo '<div class="country-list">';
            foreach ($countries as $country) {
                if (strpos($country, $chars) !== false) {
                    echo '<div class="country">' . htmlspecialchars($country) . '</div>';
                }
            }
            echo '</div>';
        }
        ?>
        <footer>
            <p>Автор: Остафійчук Людмила Вікторівна, 302 група</p>
        </footer>
    </div>
</body>
</html>
