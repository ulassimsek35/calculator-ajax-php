<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Hesap Makinesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <div class="calculator text-center">
        <div class="display">0</div>
        <div class="d-flex justify-content-center flex-wrap">
            <button class="btn btn-light">7</button>
            <button class="btn btn-light">8</button>
            <button class="btn btn-light">9</button>
            <button class="btn btn-light">/</button>
            <button class="btn btn-light">4</button>
            <button class="btn btn-light">5</button>
            <button class="btn btn-light">6</button>
            <button class="btn btn-light">*</button>
            <button class="btn btn-light">1</button>
            <button class="btn btn-light">2</button>
            <button class="btn btn-light">3</button>
            <button class="btn btn-light">-</button>
            <button class="btn btn-light">0</button>
            <button class="btn btn-light">.</button>
            <button class="btn btn-light">C</button>
            <button class="btn btn-light">+</button>
            <button class="btn btn-save" style="background-color: #31d2f2;">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" viewBox="0 0 16 16">
                    <path d="M11 2H9v3h2zM1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z"/>
                </svg>
            </button>
            <button class="btn btn-light">=</button>
        </div>
    </div>

    <div class="custom-table-container mt-5">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>İşlem</th>
                    <th>Sonuç</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conn.php';

                $stmt = $conn->query("SELECT numbers, result FROM calculated");
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($rows) {
                    foreach ($rows as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['numbers'] . "</td>";
                        echo "<td>" . $row['result'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Veri bulunamadı</td></tr>";
                }
                ?>
            </tbody>
        </table>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/main.js"></script>
</body>
</html>
