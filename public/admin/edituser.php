<?php include 'sidebar.php'?>
<?php require '../../Controllers/edituser.php'?>
<head>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #editUser {
            width: 90%;
            max-width: 800px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
            animation:fadeInn 0.8s ease;
        }

        .table-container {
            max-height: 500px; /* Yaklaşık 10 kayıt */
            overflow-y: auto;
            border-radius: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            position: sticky;
            top: 0;
            background-color: orangered;
            color: white;
            z-index: 0;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #ffe8dc;
            transition: 0.2s ease;
        }

        button {
            background-color: orangered;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #e34a00;
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
        @keyframes fadeInn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }       
    </style>
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/edit-groupbox.css">
</head>

<?php
function getUsers(){
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

<div id="editUser">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İSİM</th>
                    <th>SOYİSİM</th>
                    <th>T.C Kimlik</th>
                    <th>Kayıt Tarihi</th>
                    <th>Seçenek</th>
                </tr>
            </thead>
            <tbody>
                <?php $users = getUsers(); while($user = mysqli_fetch_assoc($users)): ?>
                    <tr>
                        <td><?php echo $user["id"]; ?></td>
                        <td><?php echo $user["name"]; ?></td>
                        <td><?php echo $user["surname"]; ?></td>
                        <td><?php echo $user["tc_identify"]; ?></td>
                        <td><?php echo $user["created_account_date"]; ?></td>
                        <td><button id="duzenleBtn"
                        data-id="<?php echo $user["id"];?>"
                        data-name="<?php echo $user["name"];?>"
                        data-surname="<?php echo $user["surname"];?>"
                        data-tc_identify="<?php echo $user["tc_identify"];?>">Düzenle</button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<head>
    <style>
        .group-box p{
            color:white !important;
        }
        .group-box input{
            width: 100% !important;
        }
        input[type="checkbox"]{
            width: 50% !important;
            height: 20px !important;
            display: inline-block !important;
        }
    </style>
</head>

<div id="modal">
    <div class="modal-content">
        <form action="" method="POST">
            <p style="font-size:20px; color:white;margin:10px 0px;">Kulanıcı Düzenleme Arayüzü</p>
                        <?php if(!empty($editErr) && $basari==false):?>
                <div class="error danger"><?php echo $editErr;?></div>
            <?php elseif($basari==true):?>
                <div class="error success"><?php echo $editErr;?></div>
            <?php endif?>
            <div class="group-box">
                <p>ID</p>
                <input type="number" name="user_id" value="<?php echo $_POST["user_id"] ?? ""?>" class="form-control" readonly>
            </div>
            <div class="group-box">
                <p>İSİM</p>
                <input type="text" name="user_name" value="<?php echo $_POST["user_name"] ?? ""?>" class="form-control">
            </div>
            <div class="group-box">
                <p>SOYİSİM</p>
                <input type="text" name="user_surname" value="<?php echo $_POST["user_surname"] ?? ""?>" class="form-control">
            </div>                  
            <div class="group-box">
                <p>T.C Kimlik</p>
                <input type="text" name="user_kimlik" maxlength="11"value="<?php echo $_POST["user_kimlik"] ?? ""?>" class="form-control">
            </div>              
            <div class="group-box">
                <p>Şifre</p>
                    <input type="password" name="user_password" class="form-control" disabled>
                    <div style="display:flex;margin-top:10px;">
                        <p>Şifreyi değiştirmek istiyor musun?</p></p>
                        <input type="checkbox" name="isPassChange">
                    </div>
            </div>       
            <input type="submit" class="modalBtn duzenleBtn" name="modalOnayla" value="Onayla">

        </form>
        <div class="modalBtn" id="modalKapat"><p>Kapat</p></div>
    </div>
</div>

<script>
    const userEditBtn = document.querySelectorAll("#duzenleBtn");
    const modal = document.getElementById("modal");
    const kapat = document.getElementById("modalKapat");
    const chk = document.getElementsByName("isPassChange")[0];
    userEditBtn.forEach(btn => {
        btn.addEventListener("click",(e)=>{
            document.getElementsByName("user_id")[0].value = e.target.dataset.id;
            document.getElementsByName("user_name")[0].value = e.target.dataset.name;
            document.getElementsByName("user_surname")[0].value = e.target.dataset.surname;
            document.getElementsByName("user_kimlik")[0].value = e.target.dataset.tc_identify;
            modal.style.display="flex";
        })
    });
    kapat.addEventListener("click",()=>{
        modal.style.display="none";
    })
    chk.addEventListener("click",()=>{
        if (chk.checked){
            document.getElementsByName("user_password")[0].removeAttribute("disabled");
        }else{
            document.getElementsByName("user_password")[0].value="";
            document.getElementsByName("user_password")[0].setAttribute("disabled",true);
        }
    })
</script>
