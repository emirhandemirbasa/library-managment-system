<?php $baslik = "Admin Paneli"?>
<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1c1c1cff, #111111ff);
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 17%;
            height: 100vh;
            background: linear-gradient(180deg, #1f1f1f, #151515);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            overflow: scroll;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background-color: #ff000066;
            border-radius: 10px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        
        
        .sidebar-brand {
            color: #770000ff;
            font-size: 22px;
            font-weight: 700;
            text-align: center;
            letter-spacing: 1px;
            padding: 30px 10px;
            border-bottom: 1px solid #333;
            text-shadow: 0 0 8px #ff000055;
        }
        
        ul {
            margin: 0;
            padding: 0;
            padding-bottom:20px;
            list-style: none;
            flex: 1;
        }
        
        ul li {
            margin: 8px 0;
        }
        
        ul h3 {
            margin: 25px 0 10px 20px;
            padding-left: 10px;
            border-left: 3px solid #00ffff;
            font-size: 16px;
            color: #ddd;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        ul li a {
            display: block;
            padding: 10px 20px;
            color: #bbb;
            text-decoration: none;
            font-size: 15px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        ul li a:hover{
            background-color: #ff7070ff;
            color:white;
        }
        .active{
            background-color: #0077ffff;
            color: white;
        }
        </style>
        <title><?php echo $baslik ?? "";?></title>
</head>
<?php include '../partials/header.php'?>

<div class="sidebar">
    <a href="adminpanel" style="text-decoration:none;"><h2 class="sidebar-brand">Kütüphane<br>Admin Paneli</h2></a>
    <ul>
        <h3>Kitap İşlemleri</h3>
        <li><a href="createbook"class="<?= basename($_SERVER['PHP_SELF']) == 'createbook.php' ? 'active' : '' ?>"><i class="fa-solid fa-plus"></i> Kitap Ekle</a></li>
        <li><a href="editbook"class="<?= basename($_SERVER['PHP_SELF']) == 'editbook.php' ? 'active' : '' ?>"><i class="fa-solid fa-file-pen"></i> Kitap Düzenle</a></li>
        <li><a href="deletebook" class="<?= basename($_SERVER['PHP_SELF']) == 'deletebook.php' ? 'active' : '' ?>"><i class="fa-solid fa-trash"></i> Kitap Sil</a></li>
        <h3>Kullanıcı İşlemleri</h3>
        <li><a href="createuser" class="<?= basename($_SERVER['PHP_SELF']) == 'createuser.php' ? 'active' : '' ?>"><i class="fa-solid fa-user-plus"></i> Kullanıcı Ekle</a></li>
        <li><a href="edituser" class="<?= basename($_SERVER['PHP_SELF']) == 'edituser.php' ? 'active' : '' ?>"><i class="fa-solid fa-user-pen"></i> Kullanıcı Düzenle</a></li>
        <li><a href="deleteuser" class="<?= basename($_SERVER['PHP_SELF']) == 'deleteuser.php' ? 'active' : '' ?>"><i class="fa-solid fa-trash"></i> Kullanıcı Sil</a></li>
        <h3>Emanet Seçenekleri</h3>
        <li><a href=""><i class="fa-solid fa-circle-info"></i> Teslim Alınan Kitaplar</a></li>
        <li><a href=""><i class="fa-solid fa-circle-info"></i> Teslim Edilen Kitaplar</a></li>
        <h3>Diğer</h3>
        <li><a href="../../index"><i class="fa-solid fa-right-from-bracket"></i> Admin Panelinden Çık</a></li>
    </ul>
</div>