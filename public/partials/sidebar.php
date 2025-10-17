<?php session_start();?>
<?php include 'header.php'?>
<head>
    <style>
        body{
            display: flex;
            margin:0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar{
            position:fixed;
            width: 18%;
            background: linear-gradient(90deg, #638dffff, #006effff);
            height: 100vh;
            margin-right: 80px;
        }
        .side-header{
            color:white;
            text-align: center;
            border-bottom: 1px grey solid;
        }
        .header-text{
            font-weight: 600;
            font-size: 20px;
        }
        
        .profile{
            border-radius: 50%;
        }
        ul{
            margin:0;
            padding: 0px 20px;
        }
        ul li a{
            text-decoration: none;
            display: block;
            color: white;
        }
        
        ul li{
            list-style: none;
            background: rgba(137, 137, 137, 0.5);
            margin: 10px 0px;
            padding:10px;
            border-radius: 15px;
            transition: all 0.33s ease-in-out;
        }

        ul li:hover{
            background: rgba(137, 137, 137, 0.4);
            transform: scale(1.14);
            padding-left:30px; /*YANLIŞLIKLA GÜZEL ANİM YAPTIM AW*/
        }

       .logout{
            text-decoration: none;
            display: block;
            padding: 10px;
            margin:0px 20px;
            background: #ff4d4d;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            text-align: center;
            margin-bottom:10px;
        }

        .logout:hover {
            background: #e63946;
            transform: scale(1.05);
        }
        .buttons{
            margin-top:180px;

        }
        </style>
</head>

<div class="sidebar">
    <div class="side-header">
        <?php if(isset($_SESSION["fullName"])):?>
            <p class="header-text">Hoşgeldin! <br><?php echo $_SESSION["fullName"];?></p>
        <?php else:?>
            <p>Merhaba Ziyaretçi!</p>
            <?php endif?>
    </div>
    <ul>
        <li><a href="../../kutuphane/index.php"><i class="fas fa-home"></i> Anasayfa</a></li>
        <li><a href="../../kutuphane/public/books.php"><i class="fas fa-book"></i> Kitaplar</a></li>
        <li><a href="#"><i class="fas fa-user"></i> Üyeler</a></li>
        <li><a href="#"><i class="fas fa-list"></i> Alım Geçmişi</a></li>
        <li><a href="#"><i class="fas fa-chart-line"></i> Raporlar</a></li>
    </ul>
    <div class="buttons">
        <?php if(isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == true):?>
        <a href="../../kutuphane/public/admin/adminpanel.php" class="logout" style="background-color:#fc6203">
            <i class="fa-solid fa-user-tie"></i> Admin Paneli
        </a>
        <?php endif?>
        <?php if(!isset($_SESSION["fullName"])):?>
        <a href="../../kutuphane/public/login.php" class="logout" style="background-color:#00cc00;">
            <i class="fa-solid fa-right-to-bracket"></i> Giriş Yap
        </a>
        <?php else:?>
        <a href="../../kutuphane/public/logout.php" class="logout" style="background-color:#ff3333;">
            <i class="fa-solid fa-right-from-bracket"></i> Çıkış Yap
        </a>
    <?php endif?>
    </div>
</div>

