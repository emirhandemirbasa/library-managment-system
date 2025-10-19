<?php
    $loginErr = "";
    $basari = false;
    session_start();
    if(isset($_POST["girisBtn"]) && $_POST["girisBtn"] == "Giriş Yap"){
        $tc = $_POST["tcKimlik"];
        $sifre = $_POST["sifre"];
        if (empty($tc)){
            $loginErr = "Tc kimlik kısmı boş bırakılamaz!";
            return;
        }
        if (empty($sifre)){
            $loginErr = "Şifre kısmı boş bırakılamaz!";
            return;
        }
        if(!isHaveMember($tc)){
            $loginErr="Böyle bir kullanıcı bulunamadı!";
            return;
        }   
        if (!isCorrectPassword($tc,$sifre)){
            $loginErr = "Şifreler uyuşmuyor!";
            return;
        }
        $basari=true;
        if (empty($loginErr) && $basari==true){
            $basari = true;
            $_SESSION["isAdmin"] = isAdmin($tc);
            $_SESSION["fullName"] = getMemberDetailsByTC($tc)["name"]." ".getMemberDetailsByTC($tc)["surname"];
            $loginErr = "Giriş başarılı yönlendiriliyorsunuz!";
        }
    }

    function isHaveMember($tc){
        require '../Models/connection.php';
        $query = "SELECT * FROM members WHERE tc_identify = ?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"s",$tc);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        if (mysqli_num_rows($result)>0){
            return true;
        }else{
            return false;
        }
    }

    function isCorrectPassword($tc,$password){
        require '../Models/connection.php';
        $query = "SELECT * FROM members WHERE tc_identify = ?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"s",$tc);
        mysqli_stmt_execute($stmt);
        $hashed_Pass = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))["password"];
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);        
        if (password_verify($password,$hashed_Pass)){
            return true;
        }else{
            return false;
        }
    }
    function isAdmin($tc){
        require '../Models/connection.php';
        $query = "SELECT * FROM members WHERE tc_identify=?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"s",$tc);
        mysqli_stmt_execute($stmt);
        $isAdmin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))["admin"];
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        if ($isAdmin==1){
            return true;
        }else{
            return false;
        }
    }

    function getMemberDetailsByTC($tc){
        require '../Models/connection.php'; 
        $query = "SELECT * FROM members WHERE tc_identify = ?";
        $stmt = mysqli_prepare($baglanti,$query);
        mysqli_stmt_bind_param($stmt,"s",$tc);
        mysqli_stmt_execute($stmt);
        $assoc = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $assoc;
    }
?>