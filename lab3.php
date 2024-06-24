<!DOCTYPE html>
<html>
<head>
    <title>Лабораторна робота 3</title>
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
        <h1>Країни, відсортовані за кількістю населення</h1>

        <div class="country-list">
            <?php
            $filename = 'countries.txt';
            $countries = file($filename, FILE_IGNORE_NEW_LINES);
            $data = [];

            foreach ($countries as $country) {
                $details = explode(", ", $country);
                $data[] = [
                    'name' => $details[0],
                    'population' => (int)$details[2],
                    'area' => (int)$details[3]
                ];
            }

            usort($data, function($a, $b) {
                return $a['population'] - $b['population'];
            });

            $totalArea = 0;
            foreach ($data as $country) {
                echo '<div class="country">' . htmlspecialchars($country['name']) . ' - Населення: ' . htmlspecialchars(number_format($country['population'])) . ', Площа: ' . htmlspecialchars(number_format($country['area'])) . ' кв. км</div>';
                $totalArea += $country['area'];
            }

            echo '<h2>Загальна площа всіх країн: ' . number_format($totalArea) . ' кв. км</h2>';
            ?>
        </div>

        <footer>
            <p>Автор: Остафійчук Людмила Вікторівна, 302 група</p>
        </footer>
    </div>
</body>
</html>
