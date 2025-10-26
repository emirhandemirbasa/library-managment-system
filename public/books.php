<?php include './partials/sidebar.php'; ?>

<head>
    <style>
        #books {
            display: flex;
            flex-wrap: wrap;
            margin-left: 300px;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            margin: 60px;
            width: 200px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            transition: all 0.35s ease;
            cursor: pointer;
            position: relative;
        }

        .card::before {
            content: "";
            position: absolute;
            background: linear-gradient(135deg, rgba(0, 110, 255, 0.15), rgba(0, 200, 255, 0.15));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .card:hover::before {
            opacity: 1;
        }

        .card img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            transition: transform 0.35s ease;
        }

        .card:hover img {
            transform: scale(1.05);
        }

        .card-footer {
            padding: 12px;
            background: #f8f8f8;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .writerName {
            font-size: 12px;
            color: #444;
            margin-bottom: 10px;
        }

        .writerName span {
            font-weight: 600;
            color: #006eff;
        }

        .card-footer .kitap {
            display: block;
            background: linear-gradient(135deg, #0082f3ff, #c5c5c5ff);
            text-decoration: none;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            font-weight: 500;
            color: white;
            transition: all 0.33s ease-in-out;
        }

        #books a{
            text-decoration: none;
        }
    </style>
</head>

<div id="books">
    <?php $kitaplar = getBooks();
    while ($assoc = mysqli_fetch_assoc($kitaplar)): ?>
        <a href="./bookdetail?bookID=<?php echo $assoc["id"]; ?>">
            <div class="card">
                <div class="card-body">
                    <img src="../public/images/coverImages/<?php echo htmlspecialchars($assoc['cover_photo']); ?>" alt="">
                </div>
                <div class="card-footer">
                    <h1 class="writerName">Yazar: <span><?php echo $assoc["writer_name"]; ?></span></h1>
                    <a href="./bookdetail?bookID=<?php echo $assoc["id"]; ?>" class="kitap">Kitabı Görüntüle</a>
                </div>
            </div>
        </a>
    <?php endwhile; ?>
</div>

<?php
function getBooks()
{
    require __DIR__ . "/../Models/connection.php";
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
?>