<?php
    $registerErr = "";
    $basari=false;
    if (isset($_POST["olusturBtn"]) && $_POST["olusturBtn"] == "Hesabı Oluştur!"){
        if (empty($_POST["isim"])){
            $registerErr = "İsim kısmı boş bırakılamaz!";
            return;
        }
        if (empty($_POST["soyisim"])){
            $registerErr = "Soy isim kısmı boş bırakılamaz!";
            return;
        }        
        if (empty($_POST["kimlik"])){
            $registerErr = "Kimlik kısmı boş bırakılamaz!";
            return;
        }        
        if (empty($_POST["sifre"])){
            $registerErr = "Şifre kısmı boş bırakılamaz!";
            return;
        }        
        if (strlen($_POST["kimlik"])<11){
            $registerErr = "Kimlik bilginiz 11 karakterden küçük olamaz!";
            return;
        }
        if (strlen($_POST["kimlik"])>11){
            $registerErr = "Kimlik bilginiz 11 karakterden büyük olamaz!";
            return;
        }        
        if (strlen($_POST["sifre"])<8 || strlen($_POST["sifre"])>32){
            $registerErr = "Şifreniz 8-32 karakter arasında olmalı!";
            return;
        }
        $registerErr = "Başarılı bir şekilde ".$_POST["kimlik"]." kimlik numaralı kişi kayıt edildi";
        $basari=true;
        createAccount($_POST["isim"],$_POST["soyisim"],$_POST["kimlik"],$_POST["sifre"]);
    }

    function createAccount($isim,$soyisim,$kimlik,$sifre){
        require '../../Models/connection.php';
        $sql = "INSERT INTO members(tc_identify,name,surname,password,admin) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($baglanti,$sql);
        $adminlik = 0;
        $hashed = password_hash($sifre,PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt,"ssssi",$kimlik,$isim,$soyisim,$hashed,$adminlik);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }
?>