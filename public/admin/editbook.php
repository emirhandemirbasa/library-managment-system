<?php $baslik = "Kitap Düzenle" ?>

<?php include '../partials/header.php' ?>
<?php include '../admin/sidebar.php' ?>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #121212, #1e1e1e);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .icerik {
            margin-left: 300px;
            width: 70%;
            max-width: 900px;
            background-color: #ffffff10;
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: fadeIn 0.8s ease;
        }

        .icerik h2 {
            color: #f8f9fa;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 500;
            letter-spacing: 1px;
        }

        .table-container {
            width: 100%;
            max-height: 500px;
            overflow-y: auto;
            border-radius: 10px;
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #212121;
        }

        thead {
            background-color: #006eff;
            color: white;
            position: sticky;
            top: 0;
        }

        thead th {
            padding: 15px;
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f1f3f5;
        }

        tbody tr:hover {
            background-color: #e3f2fd;
            transition: 0.2s;
        }

        td {
            padding: 12px 15px;
        }

        .duzenle, .sil {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            cursor: pointer;
            margin-right: 5px;
            transition: 0.3s;
            text-decoration: none;
        }

        .duzenle:hover, .sil:hover {
            background: linear-gradient(90deg, #0056b3, #003d80);
            transform: scale(1.05);
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }


        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: scale(1); }
            to { opacity: 0; transform: scale(0.9); }
        }        


        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .close {
            position: absolute;
            right: 15px;
            top: 10px;
            background: #ff4c4c;
            border: none;
            color: white;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            font-size: 22px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .close:hover {
            background: #b60000;
            transform: scale(0.95);
        }

    </style>
    <link rel="stylesheet" href="../css/modal.css">
</head>

<?php
    $editErr = "";
    $durum = false;
    if (isset($_POST["modalOnayla"]) && $_POST["modalOnayla"] == "Onayla"){
        if (empty($_POST["kitap_adi"]) || empty($_POST["yazar_adi"]) || empty($_POST["sayfa_sayisi"]) || empty($_POST["kitap_aciklama"])){
            $editErr = "Lütfen tüm alanları doldurun!";
        }
        if (!is_numeric($_POST["sayfa_sayisi"])){
            $editErr = "Lütfen sayfa sayısına sayısal değer girin!";
        }
        if(empty($editErr)){
            $durum = true;
            $editErr = "Başarılı bir şekilde #".$_POST["kitap_id"]." numaralı kitap güncellendi";
            bookUpdateById($_POST["kitap_id"],$_POST["kitap_adi"],$_POST["sayfa_sayisi"],$_POST["yazar_adi"],$_POST["kitap_aciklama"]);
        }
    }

    function bookUpdateById($id,$kitapAd,$sayfaSayisi,$yazarAdi,$aciklama){
        require '../../Models/connection.php';
        $sql = "UPDATE books SET book_name=?,page_count=?,writer_name=?,book_description=? WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"sissi",$kitapAd,$sayfaSayisi,$yazarAdi,$aciklama,$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }
?>
<?php
function getBooks() {
    require '../../Models/connection.php';
    $sql = "SELECT * FROM books";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result;
}

$kitap = getBooks();
?>
<?php if(mysqli_num_rows($kitap)>0):?>
<div class="icerik">
    <?php if ($durum):?>
        <div class="error success"><?php echo $editErr;?></div>
    <?php endif?>
    <h2>Kitap Düzenleme Arayüzü</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kitap Adı</th>
                    <th>Seçenekler</th>
                </tr>
            </thead>
            <tbody>
                <?php while($ktp = mysqli_fetch_assoc($kitap)): ?>
                    <tr>
                        <td><?php echo $ktp["id"]; ?></td>
                        <td><?php echo htmlspecialchars($ktp["book_name"]); ?></td>
                        <td>
                            <button class="duzenle duzenleyici" data-id="<?php echo $ktp['id']; ?>"
                            data-name="<?php echo htmlspecialchars($ktp['book_name']); ?>"
                            data-page="<?php echo htmlspecialchars($ktp['page_count']); ?>"
                            data-writer="<?php echo htmlspecialchars($ktp['writer_name']); ?>"
                            data-desc="<?php echo htmlspecialchars($ktp['book_description']); ?>">Düzenle</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else:?>
    <p style="font-size:20px;font-weight:700;color:red;">DÜZENLENECEK BİR KİTAP BULUNMUYOR, LÜTFEN KİTAP EKLEYİN!</p>
    <?php endif?>
<head>
    <style>
        input[name="kitap_id"]{
            color: red;
        }   
    </style>
    <link rel="stylesheet" href="../css/edit-groupbox.css">
    <link rel="stylesheet" href="../css/alerts.css">
</head>

<div id="modal" style="display:none;">
    <div class="modal-content">
        <p>Düzenleme Arayüzü</p>
        <?php if(!empty($editErr && $durum==false)):?>
            <div class="error danger"><?php echo $editErr;?></div>
            <?php echo '<script>document.getElementById("modal").style.display="flex";</script>'?>
        <?php endif?>
        <form action="" method="POST">
            <label class="group-box">
                <p>Kitap ID</p>
                <input type="text" name="kitap_id" class="form-control" readonly value="<?php echo isset($_POST['kitap_id']) ? htmlspecialchars($_POST['kitap_id']) : ''; ?>">
            </label>            
            <label class="group-box">
                <p>Kitap İsmi</p>
                <input type="text" name="kitap_adi" class="form-control" value="<?php echo isset($_POST['kitap_adi']) ? htmlspecialchars($_POST['kitap_adi']) : ''; ?>">
            </label>
            <label class="group-box">
                <p>Yazar Adı</p>
                <input type="text" name="yazar_adi" class="form-control" value="<?php echo isset($_POST['yazar_adi']) ? htmlspecialchars($_POST['yazar_adi']) : ''; ?>">
            </label>        
            <label class="group-box">
                <p>Sayfa Sayısı</p>
                <input type="text" name="sayfa_sayisi" class="form-control" value="<?php echo isset($_POST['sayfa_sayisi']) ? htmlspecialchars($_POST['sayfa_sayisi']) : ''; ?>">
            </label>         
            <label class="group-box">
                <p>Kitap Açıklaması</p>
                <textarea name="kitap_aciklama" class="form-control" rows="10"><?php echo isset($_POST['kitap_aciklama']) ? htmlspecialchars($_POST['kitap_aciklama']) : ''; ?></textarea>
            </label>                   
            <input type="submit" class="modalBtn duzenleBtn" name="modalOnayla" value="Onayla">
        </form>
        <div class="modalBtn" id="modalKapat"><p>Kapat</p></div>
    </div>
</div>

<script>
    const modal = document.getElementById("modal");
    const kapat = document.getElementById("modalKapat");
    const duzenleBtns = document.querySelectorAll(".duzenle");
    const kitapID = document.getElementsByName("kitap_id")[0];
    const kitapAd = document.getElementsByName("kitap_adi")[0];
    const kitapYazar = document.getElementsByName("yazar_adi")[0];
    const kitapSayfa = document.getElementsByName("sayfa_sayisi")[0];
    const kitapAciklama = document.getElementsByName("kitap_aciklama")[0];
    duzenleBtns.forEach(btn => {        
        btn.addEventListener("click",(e)=>{
            const id = e.target.dataset.id;
            const name = e.target.dataset.name;
            const count = e.target.dataset.page;
            const writer = e.target.dataset.writer;
            const desc = e.target.dataset.desc;
            modal.style.display = "flex";
            kitapID.value = id;
            kitapAd.value = name;
            kitapYazar.value = writer;
            kitapSayfa.value = count;
            kitapAciklama.value = desc;
        })
    });
    kapat.addEventListener("click",()=>{
        modal.style.display = "none";
    })
</script>