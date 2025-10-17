<?php include 'public/partials/header.php'?>
<?php include 'public/partials/sidebar.php'?>

<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
        }
        .kutuphane{
            margin-left: 400px;
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
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

        @media(max-width: 768px){
            .latest-books {
                justify-content: center;
            }
        }

        .latest-books a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<div class="kutuphane">
    <div class="homepage-header">
        <h1>Sizin Kütüphaneniz</h1>
        <p>Kendi kütüphanenizi oluşturun!</p>
    </div>
    
    <div class="latest-books">
        <?php
            require 'Models/connection.php';
            $result = mysqli_query($baglanti, "SELECT * FROM books ORDER BY id DESC LIMIT 5");
            while($book = mysqli_fetch_assoc($result)):
        ?>
            <a href="public/bookdetail.php?bookID=<?php echo $book["id"];?>">
        <div class="book-card">
            <img src="public/images/coverImages/<?php echo htmlspecialchars($book['cover_photo']); ?>" alt="Kitap Kapağı">
                <div class="book-info">
                <h3><?php echo htmlspecialchars($book['book_name']); ?></h3>
                <div class="author"><?php echo htmlspecialchars($book['writer_name']); ?></div>
            </div>                
        </div>
    </a>
        <?php endwhile; ?>
    </div>
</div>


<?php include 'public/partials/footer.php'?>