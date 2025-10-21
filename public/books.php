<?php include './partials/sidebar.php'; ?>

<head>
    <style>
        #books{
            display: flex;
            flex-wrap: wrap;
            margin-left:300px;
        }
        .card{
            margin:60px;
            transition: all 0.33s ease-in-out;
        }
        .card img {
            width: 180px;
            height: 280px;
        }

        .card:hover{
            transform: scale(1.1);
        }
        .card-footer{
            font-size: 8px;
        }
        .writerName{
            font-size: 10px;
            font-weight: 400;
        }

        .writerName span{
            font-size: 11px;
            font-weight: 500;
        }

        .card-footer a{
            display: block;
            background:linear-gradient(135deg, #0082f3ff, #c5c5c5ff);
            text-decoration: none;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            font-weight: 500;
            color:white;
            transition: all 0.33s ease-in-out;
        }

        .card-footer a:hover{
            transform: scale(1.1);
        }
    </style>
</head>

<div id="books">
    <?php $kitaplar = getBooks();while($assoc = mysqli_fetch_assoc($kitaplar)): ?>
        <div class="card">
            <div class="card-body">
                <img src="../public/images/coverImages/<?php echo htmlspecialchars($assoc['cover_photo']); ?>" alt="">
            </div>
            <div class="card-footer">
                <h1 class="writerName">Yazar: <span><?php echo $assoc["writer_name"];?></span></h1>
                <a href="./bookdetail.php?bookID=<?php echo $assoc["id"];?>">Kitabı Görüntüle</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php
function getBooks(){
    require __DIR__."/../Models/connection.php";
    $sql = "SELECT * FROM books ORDER BY id DESC";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}
?>
