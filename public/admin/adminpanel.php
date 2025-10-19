<?php include '../admin/sidebar.php'?>

<?php include 'sidebar.php'; ?>

<head>
    <style>
        body {
            background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
            color: #fff;
            overflow: hidden;
        }

        .dashboard-container {
            margin-left: 260px;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            margin-top:-50px;
        }

        .dashboard-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(0, 255, 255, 0.1), transparent 60%);
            z-index: -1;
        }


        .welcome-title {
            font-size: 3rem;
            font-weight: 700;
            color: #00ffff;
            text-shadow: 0 0 15px #00ffff;
        }

        .sub-title {
            font-size: 1.4rem;
            margin-top: 10px;
            color: #ccc;
        }

        .stats-container {
            display: flex;
            gap: 40px;
            margin-top: 60px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 50px;
            min-width: 200px;
            transition: all 0.4s ease;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.2);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-10px) scale(1.05);
        }

        .stat-card i {
            font-size: 2rem;
            color: #00ffff;
        }

        .stat-card h3 {
            margin: 10px 0 5px;
            font-size: 1.5rem;
        }

        .stat-card p {
            color: #bbb;
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h1 class="welcome-title">Admin Paneline Hoş Geldiniz!</h1>
        <p class="sub-title">Buradan kitapları, kullanıcıları ve emanetleri kolayca yönetebilirsin.</p>

        <div class="stats-container">
            <div class="stat-card">
                <i class="fas fa-book"></i>
                <h3>23</h3>
                <p>Toplam Kitap</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-users"></i>
                <h3>43</h3>
                <p>Kayıtlı Kullanıcı</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-hand-holding"></i>
                <h3>24</h3>
                <p>Aktif Emanet</p>
            </div>
        </div>

    </div>
</body>
