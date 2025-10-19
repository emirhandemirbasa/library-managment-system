<?php require '../Controllers/login.php'?>
<?php include './partials/header.php'?>
<?php $baslik = "Kütüphane Giriş Arayüzü";?>
<head>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: 
                linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)),
                url('images/login-background.jpg') center center / cover no-repeat fixed;
        }
        .form-group{
            display: flex;
            margin:20px;
            
            flex-direction: column;
        }

        #loginBox{
            background: rgba(25, 45, 77, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            width: 420px;
            border-radius: 18px;
            padding: 40px 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .form-title{
            color: #f8f9fa;
            text-align: center;
            font-weight: 600;
            font-size: 26px;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }

        input[type="text"],input[type="password"]{
            padding:20px;
            border-radius: 30px;
            border: none;
            outline: none;
            transition: 0.33s ease-in-out all;
            font-size: 15px;
        }
        input[type="text"]:focus,input[type="password"]:focus{
            transform: scale(1.05);
            box-shadow: rgba(35, 104, 215, 0.3) 0px 19px 38px, rgba(12, 105, 255, 0.22) 0px 15px 12px;
        }

        input[type="submit"]{
            width: 100%;
            height: 50px;
            border-radius: 20px;
            border:none;
            background: linear-gradient(90deg, #00FF00, #098009ff);
            transition: all 0.33s ease-in-out;
            color:white;
            font-size: 20px;
            font-weight: 700;
            text-transform: uppercase;
        }

        input[type="submit"]:hover{
            transform:scale(0.95);
            cursor: pointer;
            box-shadow: rgba(35, 104, 215, 0.3) 0px 19px 38px, rgba(12, 105, 255, 0.22) 0px 15px 12px;
            background: linear-gradient(270deg, #00FF00, #098009ff);
        }

        .altbaslik{
            color:white;
        }
    </style>
    <link rel="stylesheet" href="./css/alerts.css">
    <title><?php echo $baslik ?? "";?></title>
</head>

<body>
    <div id="loginBox">
        <form method="POST">
            <p class="form-title"> <i class="fa-solid fa-book"></i> <br>KÜTÜPHANE<br>GİRİŞ ARAYÜZÜ</p>
            <?php if(!empty($loginErr) && $basari!=true):?>
            <p class="error danger"><?php echo $loginErr;?></p>
            <?php endif?>
            <?php if($basari == true):?>
            <p class="error success"><?php echo $loginErr;?></p>
            <?php echo '<script> window.location.href = "../index.php";</script>';?>
            <?php endif?>
            <label for="" class="form-group">
                <p class="altbaslik">T.C Kimlik Numarası</p>
                <input type="text" name="tcKimlik" placeholder="Kimlik numaranızı girin...">
            </label>
            <label for="" class="form-group">
               <p class="altbaslik">Şifre</p>
                <input type="password" name="sifre" placeholder="Şifrenizi girin...">
            </label>
            <input type="submit" value="Giriş Yap" name="girisBtn">
            <p class="altbaslik" style="color:red;">Uygulamayı test etmek için <br>T.C:  11111111111<br> Şifre:  admin123</p>
        </form>
    </div>
</body>

<?php include './partials/footer.php'?>
