<?php
    $kayitErr = "";
    $bookName = $writerName = $pageCount = $kapakImage = $aciklama = "";
    $basari = false;
    if (isset($_POST["kayitEkle"]) && $_POST["kayitEkle"] == "Kayıt Ekle"){
        $bookName = $_POST["bookName"];
        $writerName = $_POST["authorName"];
        $pageCount = $_POST["pageCount"];
        $aciklama = $_POST["description"];
        if (empty($bookName)){
            $kayitErr = "Kitap adı boş bırakılamaz.";
            return;
        }
        if (empty($writerName)){
            $kayitErr = "Yazar adı boş bırakılamaz";
            return;
        }
        if (empty($pageCount)){
            $kayitErr = "Sayfa sayısı kısmı boş bırakılamaz";
            return;
        }
        if (empty($aciklama)){
            $kayitErr = "Kitap açıklama kısmı boş bırakılamaz!";
            return;
        }

        if (isset($_FILES["kapakResmi"]) && $_FILES["kapakResmi"]["error"] == 0) {
            $kapakImage = $_FILES["kapakResmi"];
            
            // İsteğe bağlı: Dosya türü kontrolü
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            if (!in_array($kapakImage["type"], $allowedTypes)) {
                $kayitErr = "Yalnızca JPG, PNG veya WEBP formatında resim yükleyebilirsiniz.";
                return;
            }
            
            $dosyaAdi = $kapakImage["name"];
            $dosyaPath = $kapakImage["tmp_name"];
            $dosyaAyir = explode(".",$dosyaAdi);
            $dosyaUzanti = end($dosyaAyir);
            $dosyaAdiYeni = implode(".",array_slice($dosyaAyir,0,-1));
            $dosyaAdiDegistir = md5(time().$dosyaAdiYeni.rand(1,999999999999)).".".$dosyaUzanti;
            $gonder = "../../public/images/coverImages/".$dosyaAdiDegistir;
            if (move_uploaded_file($dosyaPath,$gonder)){
                $kayitErr = "Başarılı bir şekilde kitap eklendi!";
                createBook($bookName,$writerName,$pageCount,$dosyaAdiDegistir,$aciklama);
                $basari = true;
            }else{
                $kayitErr = "HATA!";
            }
        } else {
            $kayitErr = "Lütfen bir kapak resmi seçin!";
            return;
        }

        
    }

    function createBook($kitapAdi,$yazarAdi,$sayfaSayisi,$fotograf,$aciklama){
       require __DIR__ . '/../Models/connection.php';
        $sql = "INSERT INTO books(book_name, writer_name, page_count, book_description, cover_photo) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"sssss",$kitapAdi,$yazarAdi,$sayfaSayisi,$aciklama,$fotograf);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }
?>