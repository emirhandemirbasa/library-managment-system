<?php

    $editErr = "";
    $newPass = "";
    $basari = false;
    if (isset($_POST["modalOnayla"]) && $_POST["modalOnayla"] == "Onayla"){
        if (empty($_POST["user_name"])){
            $editErr = "Kullanıcı ismi boş bırakılamaz!";
            return;
        }
        if (empty($_POST["user_surname"])){
            $editErr = "Kullanıcı soyadı boş bırakılamaz!";
            return;
        }
        if (empty($_POST["user_kimlik"])){
            $editErr = "Kullanıcı Kimlik kısmı boş bırakılamaz!";
            return;
        }     
        if (strlen($_POST["user_kimlik"])<11 || strlen($_POST["user_kimlik"])>11){
            $editErr = "Kimlik bilgisi 11 karakterden oluşmalı!";
            return;
        }   

        if(!is_numeric($_POST["user_kimlik"])){
             $editErr = "Kimlik bilgisi sadece rakamlardan oluşmalı!!";
            return;
        }
        if (isset($_POST["isPassChange"])){
            if (empty($_POST["user_password"])){
                $editErr = "Şifre kısmını boş bırakmayın!";
                return;
            }
            if (strlen($_POST["user_password"])<8 || strlen($_POST["user_password"])>32){
                $editErr = "Şifre en az 8 en fazla 32 karakterden oluşabilir!";
                return;
            }
            $newPass = password_hash($_POST["user_password"],PASSWORD_DEFAULT);
            memberUpdate($_POST["user_id"],$_POST["user_name"],$_POST["user_surname"],$_POST["user_kimlik"],$newPass);
            $basari = true;
        }
            memberUpdate($_POST["user_id"],$_POST["user_name"],$_POST["user_surname"],$_POST["user_kimlik"],$newPass);
            $basari = true;

    }
    function memberUpdate($id,$name,$surname,$kimlik,$pass){
        require '../../Models/connection.php';
        if (!empty($pass)){
            $sql = "UPDATE members SET name=?,surname=?,tc_identify=?,password=? WHERE id=?";
            $stmt = mysqli_prepare($baglanti,$sql);
            mysqli_stmt_bind_param($stmt,"ssssi",$name,$surname,$kimlik,$pass,$id);
        }else{
            $sql = "UPDATE members SET name=?,surname=?,tc_identify=? WHERE id=?";
            $stmt = mysqli_prepare($baglanti,$sql);
            mysqli_stmt_bind_param($stmt,"sssi",$name,$surname,$kimlik,$id);
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }
?>