<?php include '../admin/sidebar.php' ?>
<?php require '../../Controllers/createuser.php'?>

<head>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #121212, #1b1b1b);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #createUser {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        form {
            width: 420px;
            background: #ffffff10;
            backdrop-filter: blur(10px);
            border: 1px solid #ffffff30;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        .create-header {
            background: linear-gradient(90deg, #13a1b4ff, #00e0ff);
            text-align: center;
            color: white;
            padding: 12px;
            font-weight: bold;
            letter-spacing: 1px;
            font-size: 22px;
        }

        .form {
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .group-box p {
            margin: 0 0 5px 5px;
            color: #00e0ff;
            font-weight: 500;
            text-shadow: 0 0 6px #00ffff70;
        }

        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: none;
            border-radius: 25px;
            background-color: #dcdcdc;
            outline: none;
            transition: all 0.2s;
        }

        .form-control:focus {
            background-color: #ffffff;
            box-shadow: 0 0 6px #00e0ff;
        }

        .group-box {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .group-box input[name="sifre"] {
            width: 70%;
            display: inline-block;
        }

        .sifreUret {
            display: inline-block;
            background: linear-gradient(90deg, #00e0ff, #13a1b4ff);
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            margin-left: 10px;
            user-select: none;
        }

        .sifreUret:hover {
            background: linear-gradient(90deg, #13a1b4ff, #0099ff);
            transform: scale(1.05);
        }

        .create-footer {
            background: #f2f2f2;
            padding: 10px 18px;
            display: flex;
            justify-content: flex-end;
            border-top: 1px solid #ddd;
        }

        .create-footer input[type="submit"] {
            background: linear-gradient(90deg, #13a1b4ff, #00e0ff);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .create-footer input[type="submit"]:hover {
            background: linear-gradient(90deg, #00e0ff, #13a1b4ff);
            box-shadow: 0 0 10px #00ffff70;
            transform: translateY(-2px);
        }

    </style>
    <link rel="stylesheet" href="../css/alerts.css">
</head>

<div id="createUser">
    <form action="" method="POST">
        <div class="create-header">
            Hesap Oluştur
        </div>
        <div class="form">
            <?php if(!empty($registerErr) && $basari==false):?>
                <div class="error danger"><?php echo $registerErr;?></div>
            <?php elseif($basari==true):?>
                <div class="error success"><?php echo $registerErr;?></div>
            <?php endif?>
            <div class="group-box">
                <p>İsim</p>
                <input type="text" name="isim" class="form-control" placeholder="Adınızı girin" value="<?php echo $_POST["isim"] ?? "";?>">
            </div>
            <div class="group-box">
                <p>Soy İsim</p>
                <input type="text" name="soyisim" class="form-control" placeholder="Soyadınızı girin" value="<?php echo $_POST["soyisim"] ?? "";?>">
            </div>
            <div class="group-box">
                <p>T.C. Kimlik</p>
                <input type="text" name="kimlik" class="form-control" maxlength="11" placeholder="11 haneli kimlik numarası" value="<?php echo $_POST["kimlik"] ?? "";?>">
            </div>
            <div class="group-box">
                <p>Şifre</p>
                <div style="display: flex; align-items: center;">
                    <input type="password" name="sifre" class="form-control" placeholder="Şifre oluştur" style="width:50%">
                    <div class="sifreUret">Şifre Üret</div>
                    <div class="sifreUret">Göster</div>
                </div>
            </div>
        </div>
        <div class="create-footer">
            <input type="submit" value="Hesabı Oluştur!" name="olusturBtn">
        </div>
    </form>
</div>

<script>
    const sifreUret = document.getElementsByClassName("sifreUret")[0];
    const yaz = document.getElementsByName("sifre")[0];
    sifreUret.addEventListener("click",()=>{
        yaz.value = sifreUret();
        function sifreUret(){
           var karakterler = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&*()";
            let maxLen = 8;
            let sifre = "";
            for (var i=0;i<maxLen;i++){
                char = Math.floor(Math.random() * karakterler.length);
                sifre += karakterler[char];
            }
            return sifre;
        }
    })
    const goster = document.getElementsByClassName("sifreUret")[1];
    goster.addEventListener("click",()=>{
        if (goster.innerHTML=="Göster"){
            yaz.type="pass"
            goster.innerHTML="Gizle";
        }else {
            yaz.type="password"
            goster.innerHTML="Göster";  
        }
    })
</script>