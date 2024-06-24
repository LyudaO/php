<!DOCTYPE html>
<html>
<head>
    <title>Лабораторна робота 5</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
        form {
            margin: 20px 0;
        }
        form input[type="text"], form input[type="submit"] {
            padding: 10px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Лабораторна робота 5: Робота з базою даних</h1>
        <h2>Додати нову країну</h2>
        <form method="post" action="">
            <label for="country">Країна:</label>
            <input type="text" id="country" name="country" required><br>
            <label for="continent">Континент:</label>
            <input type="text" id="continent" name="continent" required><br>
            <label for="population">Кількість населення:</label>
            <input type="text" id="population" name="population" required><br>
            <label for="area">Площа:</label>
            <input type="text" id="area" name="area" required><br>
            <label for="government">Форма правління:</label>
            <input type="text" id="government" name="government" required><br>
            <label for="language">Державна мова:</label>
            <input type="text" id="language" name="language" required><br>
            <input type="submit" value="Додати">
        </form>

        <h2>Всі країни</h2>
        <table>
            <tr>
                <th>Країна</th>
                <th>Континент</th>
                <th>Населення</th>
                <th>Площа (кв. км)</th>
                <th>Форма правління</th>
                <th>Державна мова</th>
            </tr>
            <?php
            $filename = 'countries.txt';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['country'])) {
                $newEntry = $_POST['country'] . ", " . $_POST['continent'] . ", " . $_POST['population'] . ", " . $_POST['area'] . ", " . $_POST['government'] . ", " . $_POST['language'] . "\n";
                file_put_contents($filename, $newEntry, FILE_APPEND);
            }

            if (file_exists($filename)) {
                $countries = file($filename, FILE_IGNORE_NEW_LINES);
                $data = [];

                foreach ($countries as $country) {
                    $details = explode(", ", $country);
                    $data[] = [
                        'name' => $details[0],
                        'continent' => $details[1],
                        'population' => (int)$details[2],
                        'area' => (int)$details[3],
                        'government' => $details[4],
                        'language' => $details[5]
                    ];
                }

                // Вивід всіх країн у вигляді таблиці
                foreach ($data as $country) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($country['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['continent']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['population']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['area']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['government']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['language']) . "</td>";
                    echo "</tr>";
                }

                echo "</table>";

                // Сортування країн за кількістю населення
                usort($data, function($a, $b) {
                    return $a['population'] - $b['population'];
                });

                // Вивід відсортованих країн та загальної площі
                echo "<h2>Країни, відсортовані за кількістю населення</h2>";
                echo "<table>";
                echo "<tr>";
                echo "<th>Країна</th>";
                echo "<th>Континент</th>";
                echo "<th>Населення</th>";
                echo "<th>Площа (кв. км)</th>";
                echo "<th>Форма правління</th>";
                echo "<th>Державна мова</th>";
                echo "</tr>";

                $totalArea = 0;
                foreach ($data as $country) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($country['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['continent']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['population']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['area']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['government']) . "</td>";
                    echo "<td>" . htmlspecialchars($country['language']) . "</td>";
                    echo "</tr>";
                    $totalArea += $country['area'];
                }

                echo "</table>";
                echo "<h2>Загальна площа всіх країн: " . $totalArea . " кв. км</h2>";
            } else {
                echo "<tr><td colspan='6'>Файл countries.txt не знайдено.</td></tr>";
            }
            ?>
        </table>

        <h2>Пошук країн за символами</h2>
        <form method="post" action="">
            <label for="chars">Введіть символи:</label>
            <input type="text" id="chars" name="chars" required><br>
            <input type="submit" value="Шукати">
        </form>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['chars'])) {
            $chars = $_POST['chars'];
            $filename = 'countries.txt';
            $countries = file($filename, FILE_IGNORE_NEW_LINES);

            echo "<h2>Країни, що містять '$chars':</h2>";
            foreach ($countries as $country) {
                if (strpos($country, $chars) !== false) {
                    echo htmlspecialchars($country) . "<br>";
                }
            }
        }
        ?>

        <footer>
            <p>Автор: Остафійчук Людмила Вікторівна, 302 група</p>
        </footer>
    </div>
</body>
</html>
