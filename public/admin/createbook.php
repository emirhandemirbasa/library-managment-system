<?php require '../../Controllers/createbook.php'?>
<?php include '../admin/sidebar.php' ?>

<head>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #1e1e1eff, #000000ff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        #kitapEkle {
            background-color: #ffffff;
            border-radius: 20px;
            width: 540px;
            padding: 20px 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            animation: fadeIn 0.8s ease;
        }

        #kitapEkle:hover {
            transform: translateY(-3px);
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .title {
            border-bottom: 2px solid #00a000;
            padding-bottom: 10px;
            text-transform: uppercase;
            font-size: 24px;
            text-align: center;
            color: #111;
            margin-bottom: 20px;
        }

        .form-group {
            width: 100%;
        }

        .form-group h1 {
            font-size: 15px;
            color: #333;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            border-radius: 15px;
            border: 1px solid #ccc;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #00a000;
            box-shadow: 0 0 8px rgba(0, 160, 0, 0.4);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        textarea {
            resize: none;
            height: 100px;
        }

        input[type="submit"] {
            margin-top: 10px;
            border-radius: 20px;
            height: 45px;
            border: none;
            background: linear-gradient(135deg, #00b800, #008a00);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 160, 0, 0.3);
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(135deg, #008a00, #00b800);
            transform: scale(1.03);
        }

        @media screen and (max-width: 600px) {
            #kitapEkle {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
    <link rel="stylesheet" href="../css/alerts.css">
</head>

<div id="kitapEkle">
    <form action="" method="POST" enctype="multipart/form-data">
        <h1 class="title">Kitap Ekleme Arayüzü</h1>
        <?php if (!empty($kayitErr) && $basari == false):?>
        <div class="error danger"><?php echo $kayitErr;?></div>
        <?php elseif(!empty($kayitErr) && $basari == true):?>
        <div class="error success"><?php echo $kayitErr;?></div>
        <?php endif?>
        <label class="form-group">
            <h1>Kitap Adı</h1>
            <input type="text" placeholder="Kitap adı giriniz..." name="bookName" value="<?php echo $bookName;?>">
        </label>

        <label class="form-group">
            <h1>Yazar Adı</h1>
            <input type="text" placeholder="Yazar adı giriniz..." name="authorName" value="<?php echo $writerName;?>">
        </label>

        <label class="form-group">
            <h1>Sayfa Sayısı</h1>
            <input type="text" placeholder="Sayfa sayısı giriniz..." name="pageCount" value="<?php echo $pageCount;?>">
        </label>

        <label class="form-group">
            <h1>Kapak Fotoğrafı</h1>
            <input type="file" name="kapakResmi">
        </label>

        <label class="form-group">
            <h1>Kitap Açıklaması</h1>
            <textarea placeholder="Kısa bir açıklama girin..." name="description"><?php echo $aciklama;?></textarea>
        </label>

        <input type="submit" value="Kayıt Ekle" name="kayitEkle">
    </form>
</div>
