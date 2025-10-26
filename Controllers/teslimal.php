<?php
    $maxReadingBook = 2;
    $basari = false;
    if (isset($_POST["okuBtn"]) && $_POST["okuBtn"] == "Kitabı Teslim Al"){
        $bookID = $_GET["bookID"]; // Seçilen kitap id.
        if (getCountBooksByID($_SESSION["member_id"]) >= $maxReadingBook){
            $teslimErr = "Zaten şuanda 2 tane okuduğunuz kitap bulunuyor. Haftalık 2 tane kitap teslim alabilirsiniz.";
            return;
        }
        $basari = true;
        $teslimErr = "Kitabı okumaya başladınız. lütfen 1 hafta içerisinde teslim edin.";
        addReadBook($bookID,$_SESSION["member_id"]);
    }


    function addReadBook($bookID,$memberID){
        require '../Models/connection.php';
        $sql = "INSERT INTO emanet(book_id,member_id,give_date) VALUES (?,?,?)";
        $now = date('Y-m-d H:i:s', strtotime('+1 week'));
        $stmt = mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"iis",$bookID,$memberID,$now);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);

    }

    function isReadingBookByMemberAndBookId($memberID,$bookID,$tip){
        require '../Models/connection.php';
        $sql = "SELECT * FROM emanet WHERE member_id=? AND book_id=?";
        $stmt = mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"ii",$memberID,$bookID);
        mysqli_stmt_execute($stmt);
        if ($tip=="select"){
            $count = mysqli_num_rows(mysqli_stmt_get_result($stmt));
            mysqli_stmt_close($stmt);
            mysqli_close($baglanti);
            if ($count>0){
                return true; //kitap okunuyor.
            }else{
                return false; //kitap okunmuyor.
            }
        }
        else{
             $result = mysqli_stmt_get_result($stmt);
             return $result;
        }
    }

    function getCountBooksByID($id){
        require '../Models/connection.php';
        $sql = "SELECT * FROM emanet WHERE member_id=?";
        $stmt =  mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
        return $count;
    }
?>