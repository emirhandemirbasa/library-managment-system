<?php include './partials/sidebar.php'?>
<?php
    $id = $_GET["bookID"];
    $kitap = mysqli_fetch_assoc(getBookById($id));
?>
<head>
    <style>

.book-detail {
    margin-left: 300px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-radius: 20px;
    max-width: 900px; /* sabit genişlik yerine dinamik */
    width: 80%;       /* ekran genişliğine göre */
    margin-top: 100px;
    display: flex;
    background: #fff;
    padding: 20px;
}

        .book-cover img{
            margin: 20px;
            height: 350px;
            width: 250px;
            object-fit:fill;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);            
        }

        .book-details {
    flex: 1;
    overflow-wrap: break-word; /* uzun kelimeler satırda taşmasın */
}

        .book-details h2{
            margin: 0;
            margin:20px;
            color: #006eff;
        }

        .book-details p{
            margin: 5px 0;
            color: #333;
        }
        .label{
            font-weight: bold;
            
        }

        .label span{
            font-weight: 400;
        }
        .kitapOku{
            width: 100%;
            height: 30px;
            border-radius: 10px;
            border:none;
            background-color: #15d915ff;
            color: white;
            font-weight: 500;
            font-size: 14px;
            margin-top:20px;
            box-shadow: 1px 4px 10px rgba(0, 255, 51, 0.2);
            transition: all 0.33s ease-in-out;
        }

        .kitapOku:hover{
            cursor: pointer;
            background-color: #1e9a1eff;
            transform: scale(0.95);
        }
    </style>
</head>

<div class="book-detail">
    <div class="book-cover">
        <img class="card-img" src="../public/images/coverImages/<?php echo $kitap["cover_photo"]?>" alt="">
    </div>
    <div class="book-details">
        <h2><?php echo htmlspecialchars($kitap['book_name']); ?></h2>
        <p class="label">Yazar Adı: <?php echo htmlspecialchars($kitap["writer_name"]);?></p>
        <p class="label">Sayfa Sayısı: <?php echo htmlspecialchars($kitap["page_count"]);?></p>
        <p class="label">Açıklama: <span><?php echo htmlspecialchars($kitap["book_description"]);?></span></p>
        <form action="" method="POST">
            <?php if(isset($_SESSION["fullName"])):?>
            <input type="submit" class="kitapOku" name="okuBtn" value="Kitabı Teslim Al">
            <?php else:?>
            <a href="login" class="kitapOku" style="background-color:red; text-decoration:none; width:100%; text-align:center;
            display:block;"><p style="color:white;margin-top:5px;display:inline-block">Bu kitabı teslim almak için giriş yapın!</p></a>
            <?php endif?>
        </form>
    </div>
</div>

<?php
    function getBookById($id){
        require __DIR__.'/../Models/connection.php';
        $sql = "SELECT * FROM books WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $result;
    }
?>