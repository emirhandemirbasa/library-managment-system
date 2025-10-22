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
            max-height: 500px; /* yaklaşık 10 kayıt */
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
            background-color: #ff0000ff;
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

        /* Scrollbar tasarımı */
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
        @keyframes fadeInn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        } 
        </style>
        <link rel="stylesheet" href="../css/alerts.css">
        <link rel="stylesheet" href="../css/modal.css">
</head>

<?php
$basari = "";
    if (isset($_POST["secili_id"])){
        require '../../Models/connection.php';
        $id = intval($_POST['secili_id']);
        $sql = "DELETE FROM books WHERE id = ?";
        $sql2 = "SELECT * FROM books WHERE id=?";
        $stmt2 = mysqli_prepare($baglanti,$sql2);
        mysqli_stmt_bind_param($stmt2,"i",$id);
        mysqli_stmt_execute($stmt2);
        $cover = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2))["cover_photo"];
    if($cover && file_exists('../images/coverImages/'.$cover)){
        unlink('../images/coverImages/'.$cover);
    }
        $stmt = mysqli_prepare($baglanti, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmt2);        
        $basari = $id." Numaralı kayıt başarıyla silindi!";
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
    <h2>Kitap Silme Arayüzü</h2>
        <div class="error danger" style="display:none;"></div>
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
                            <button class="sil" style="background: linear-gradient(90deg, #dc3545, #a71d2a);"
                            data-id="<?php echo $ktp["id"]; ?>"
                            data-name="<?php echo htmlspecialchars($ktp["book_name"]);?>">Sil</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else:?>
<p style="font-size:20px;font-weight:700;color:red;">SİLİNECEK BİR KİTAP BULUNMUYOR, LÜTFEN KİTAP EKLEYİN!</p>
<?php endif?>

<div id="modal" style="display:none;">
    <div class="modal-content">
        <p>Kitap Silme Arayüzü</p>
        <p id="eminMisin"></p>
        <button class="modalBtn duzenleBtn" name="modalOnayla">Sil</button>
        <div class="modalBtn" id="modalKapat"><p>Kapat</p></div>
    </div>
</div>

<script>
    const silBtn = document.querySelectorAll(".sil");
    const modal = document.getElementById("modal");
    const kapat = document.getElementById("modalKapat");
    let id;
    silBtn.forEach(btn => {
        btn.addEventListener("click",(e)=>{
            id = e.target.dataset.id;
            const name = e.target.dataset.name;
            modal.style.display="flex";
            document.getElementById("eminMisin").innerHTML= "\""+name+"\" adlı kitabı silmek istiyor musunuz?";
            document.getElementById("eminMisin").style.fontSize = "17px";
        });
    });
    kapat.addEventListener("click",()=>{
        modal.style.display="none";
    })
document.querySelector('button[name="modalOnayla"]').addEventListener("click", ()=>{
    const formdata = new FormData();
    formdata.append("secili_id", id);

    fetch("", {
        method: "POST",
        body: formdata
    })
    .then(() => {
        modal.style.display = "none";
        const alertBox = document.getElementsByClassName("error")[0];
        alertBox.style.display = "flex";
        alertBox.innerHTML = `${id} numaralı kayıt başarıyla silindi!`;
        setTimeout(() => location.reload(), 3000);
    });
});

</script>