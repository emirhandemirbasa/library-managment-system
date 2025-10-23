<?php include 'sidebar.php' ?>

<head>
    <style>
        #deleteUser {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: fadeInn 0.8s ease;
        }

        .table-container {
            background-color: white;
            border-radius: 18px;
            max-height: 500px;
            overflow-y: auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: left;
        }

        thead {
            position: sticky;
            top: 0;
            background-color: red;
            color: white;
            z-index: 0;
        }

        th,
        td {
            padding: 14px 18px;
            border-bottom: 1px solid #4e4e4eff;
        }

        tbody td {
            padding: 15px 20px;
        }


        tbody tr:nth-child(even) {
            background-color: #DEDEDE;
        }

        tbody tr:hover {
            background-color: #cbcbcbff;
            transition: 0.2s ease;
        }

        @keyframes fadeInn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 10px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background-color: #aaa;
        }

        button[name="silBtn"] {
            background-color: #ff5a5aff;
            color: white;
            border-radius: 10px;
            width: 60px;
            border: none;
            height: 30px;
        }

        button[name="silBtn"]:hover {
            cursor: pointer;
            background-color: rgba(160, 0, 0, 1);
        }
        .hata{
            background-color: red;
            color: white;
            font-size: 15px;
            border-radius: 15px;
            border:none;
            text-align: center;
            display: none;
            padding: 5px;
            box-shadow: 0 0 0 10px red;
        }
    </style>
    <link rel="stylesheet" href="../css/modal.css">
</head>

<?php
    if(isset($_POST["silID"])){
        deleteMemberById($_POST["silID"]);
    }

    function deleteMemberById($id){
        require '../../Models/connection.php';
        $sql = "DELETE FROM members WHERE id=?";
        $stmt = mysqli_prepare($baglanti,$sql);
        mysqli_stmt_bind_param($stmt,"i",$id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($baglanti);
    }
    
function getMembers()
{
    require '../../Models/connection.php';
    $sql = "SELECT * FROM members";
    $stmt = mysqli_prepare($baglanti, $sql);
    mysqli_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($baglanti);
    return $result;
}
?>

<div id="deleteUser">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>T.C Kimlik</th>
                    <th>İSİM</th>
                    <th>SOYİSİM</th>
                    <th>Seçenek</th>
                </tr>
            </thead>
            <tbody>
                <?php $members = getMembers();
                while ($member = mysqli_fetch_assoc($members)): ?>
                    <tr>
                        <td><?php echo $member["tc_identify"]; ?></td>
                        <td><?php echo $member["name"]; ?></td>
                        <td><?php echo $member["surname"]; ?></td>
                        <td><button name="silBtn" id="silBtn"
                                data-id="<?php echo $member["id"] ?>"
                                data-fname="<?php echo $member["name"] . " " . $member["surname"]; ?>">Sil</button></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>

<div id="modal">
    <div class="modal-content">
        <p style="color:white;">Kullanıcı Silme Arayüzü</p>
        <div class="hata"></div>
        <p id="bilgi" style="color:white;font-size:16px;text-align:center;"></p>
        <input type="submit" class="modalBtn duzenleBtn" name="modalOnayla" value="Onayla">
        <div class="modalBtn" id="modalKapat">
            <p>Kapat</p>
        </div>
    </div>
</div>
<script>
    const modal = document.getElementById("modal");
    const kapat = document.getElementById("modalKapat");
    const silBtn = document.querySelectorAll("#silBtn");
    const onayla = document.getElementsByName("modalOnayla")[0]
    let id;
    silBtn.forEach(btn => {
        btn.addEventListener("click", (e) => {
            const fName = e.target.dataset.fname;
            id = e.target.dataset.id;
            modal.style.display = "flex";
            if (id==1){
                onayla.style.display="none";
                document.getElementById("bilgi").innerHTML = "Bu kullanıcı silinemez!";
                document.getElementById("bilgi").style.color = "red";
                document.getElementById("bilgi").style.fontSize = "21px";
            }else{
                document.getElementById("bilgi").innerHTML = "\""+fName+"\" adlı kullanıcıyı silmek istiyor musunuz?";
                onayla.style.display="flex";
            }
        })
    });

    kapat.addEventListener("click", () => {
        modal.style.display = "none";
        document.getElementById("bilgi").style.color = "white";
        document.getElementById("bilgi").style.fontSize = "16px";
    })

    onayla.addEventListener("click",()=>{
        const frm = new FormData();
        frm.append("silID",id);
        console.log("TIKLANDI!");
        fetch("",{
            method:"POST",
            body:frm
        })
        .then(()=>{
            document.getElementsByClassName("hata")[0].style.display = "flex";
            document.getElementsByClassName("hata")[0].innerHTML = id+" numaralı kayıt silindi!";
            onayla.setAttribute("disabled",true)
            kapat.setAttribute("disabled",true)
            setTimeout(() => {
                modal.style.display = "none";
                onayla.removeAttribute("disabled");
                kapat.removeAttribute("disabled");
                location.reload();
            }, 3000);
        })
    })
</script>