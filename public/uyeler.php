<?php include '../public/partials/header.php'?>
<?php include '../public/partials/sidebar.php'?>

<head>
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        /*members */
        #members {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin-left: 500px; /* sidebar boşluğu */
            padding-top: 80px;
        }

        .members {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: #fff;
            padding: 40px;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
            width: 75%;
            max-width: 1000px;
        }

        .members p {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            text-align: center;
            margin-bottom: 40px;
        }

        .table-wrapper {
            display: flex;
            justify-content: center;
            width: 100%;
            overflow-x: auto;
        }

        table {
            display: flex;
            flex-direction: column;
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            display: flex;
            background: linear-gradient(135deg, #19c856, #3ca23e);
            color: white;
            border-radius: 8px 8px 0 0;
        }

        thead tr {
            display: flex;
            width: 100%;
            justify-content: space-between;
        }

        thead th {
            flex: 1;
            padding: 14px 0;
            text-align: center;
            font-weight: 600;
        }

        tbody {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        tbody tr {
            display: flex;
            justify-content: space-between;
            text-align: center;
            transition: background 0.3s ease;
        }

        tbody tr:nth-child(even) {
            background: #f3f3f3;
        }

        tbody tr:hover {
            background: #e9ffe9;
        }

        tbody td {
            flex: 1;
            padding: 12px 0;
        }

        button {
            background: #19c856;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        button:hover {
            background: #15a14c;
            transform: scale(1.05);
        }
    </style>
</head>

<div id="members">
    <div class="members">
        <p>Kütüphane Sisteminde bulunan Üyeler ve istatistikleri aşağıda bulunmaktadır.</p>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>İsim</th>
                        <th>Soy İsim</th>
                        <th>Okunan Kitap Sayısı</th>
                        <th>Seçenek</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $user = getUsers(); while($users = mysqli_fetch_assoc($user)): ?>
                        <tr>
                            <td><?php echo $users["id"]; ?></td>
                            <td><?php echo $users["name"]; ?></td>
                            <td><?php echo $users["surname"]; ?></td>
                            <td>1</td>
                            <td><button>Görüntüle</button></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
function getUsers(){
    require '../Models/connection.php';
    $sql = "SELECT * FROM members";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($baglanti);
    return $result;
}
?>

<?php include '../public/partials/footer.php'?>
