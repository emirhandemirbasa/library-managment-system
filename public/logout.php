<?php include '../public/partials/sidebar.php'?>
<?php require '../Controllers/logout.php'?>
<head>
    <style>
        .kutucuk {
            height: 100vh;
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items:center;
        }
    </style>
    <link rel="stylesheet" href="../public/css/alerts.css">
</head>

<div class="kutucuk">
    <p class="error danger"><?php echo $_SESSION["message"];?></p>
</div>

