<?php include 'public/partials/header.php' ?>
<?php include 'public/partials/sidebar.php' ?>

<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
        }

        .kutuphane {
            margin-left: 600px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .homepage-header {
            text-align: center;
            padding: 50px 20px 30px 20px;
        }

        .homepage-header h1 {
            color: #006eff;
            font-size: 36px;
            margin: 0;
        }

        .homepage-header p {
            color: #555;
            font-size: 18px;
            margin-top: 10px;
        }

        .latest-books {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            padding: 20px 40px 60px 40px;
        }

        .book-card {
            background: #fff;
            width: 180px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .book-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .book-info {
            padding: 10px;
            text-align: center;
        }

        .book-info h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #006eff;
        }

        .book-info p {
            margin: 0;
            font-size: 13px;
            color: #555;
            height: 35px;
            overflow: hidden;
        }

        .book-info .author {
            font-weight: bold;
            margin-top: 5px;
        }

        @media(max-width: 768px) {
            .latest-books {
                justify-content: center;
            }
        }

        .latest-books a {
            text-decoration: none;
            color: black;
        }

        .card {
            background: linear-gradient(145deg, #ffffff, #e3e3e3);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            width: 270px;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            cursor: pointer;
            margin: 0px 20px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .card .icon {
            text-align: center;
            font-size: 17px;
            color: #d2d2d2ff;
            z-index: 2;
        }

        .card i {
            margin-bottom: 8px;
            font-size: 34px;
            color: #ffffffff;
            transition: transform 0.3s ease, color 0.3s ease;
        }


        .card .content {
            font-size: 22px;
            font-weight: bold;
            color: #d2d2d2ff;
            margin-top: 15px;
        }

        .kutuphane-content {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<div class="kutuphane">
    <div class="homepage-header">
        <h1>Sizin Kütüphaneniz</h1>
        <p>Kendi kütüphanenizi oluşturun!</p>
    </div>
    <div class="kutuphane-content">
        <div class="card" style="background: linear-gradient(145deg, #ff5d18ff, #ff9a27ff);">
            <div class="icon">
                <i class="fa-solid fa-book"></i><br>Kütüphanedeki kitap sayısı
            </div>
            <div class="content">
                <?php echo mysqli_num_rows(getBooks());?>
            </div>
        </div>
        <div class="card" style="background: linear-gradient(145deg, #7c18ffff, #a759ffff);">
            <div class="icon">
                <i class="fa-solid fa-users"></i><br>Kayıtlı Kullanıcı Sayısı
            </div>
            <div class="content">
                <?php echo mysqli_num_rows(getMembers());?>
            </div>
        </div>
    </div>
</div>

<?php
function getBooks()
{
    require __DIR__ . "../Models/connection.php";
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

function getMembers()
{
    require __DIR__ . "../Models/connection.php";
    $sql = "SELECT * FROM members ORDER BY id DESC";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
?>

<?php include 'public/partials/footer.php' ?>