<?php
require_once '../Controller/blogC.php';

$p = new blogC();
$liste = $p->publier();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>medsense</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    
    <style>
        /* === BASE === */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff 0%, #f0f9ff 50%, #e0f2fe 100%);
            background-attachment: fixed;
            color: #1e293b;
            min-height: 100vh;
            padding: 20px 0;
            position: relative;
        }
        body::before {
            content: ''; position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(147,197,253,.08), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(103,232,249,.06), transparent 50%);
        }

        /* === HEADER === */
        .header {
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(20px);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 20px rgba(0,0,0,.04);
            border-bottom: 1px solid rgba(147,197,253,.2);
            margin: -20px -20px 30px;
        }
        .logo { display: flex; align-items: center; gap: 12px; }
        .logo > img{
            width: 200px;
        }
        .avatar {
            width: 44px; height: 44px; border-radius: 50%;
            border: 2.5px solid #3b82f6;
            box-shadow: 0 2px 8px rgba(59,130,246,.2);
        }

        /* === CHAT === */
        .chat {
            max-width: 700px;
            margin: 0 auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            color: #1e40af;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* === POST CARD === */
        li {
            background: white;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,.08);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all .2s ease;
        }
        li:hover {
            box-shadow: 0 8px 24px rgba(0,0,0,.12);
        }

        /* === EN-TÊTE (Avatar + Nom + Heure + 3 points) === */
        .post-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            position: relative;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            background: url('https://i.pravatar.cc/40?img=5') center/cover;
            border-radius: 50%;
            border: 2.5px solid #3b82f6;
            box-shadow: 0 2px 8px rgba(59,130,246,.2);
        }

        .username {
            font-weight: 600;
            color: #1e40af;
            font-size: 15px;
        }

        .post-time {
            color: #64748b;
            font-size: 12px;
            margin-left: auto;
            margin-right: 8px;
        }

        /* === 3 POINTS EN HAUT À DROITE === */
        .menu-toggle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #64748b;
            transition: all .2s;
        }
        .menu-toggle:hover {
            background: #e2e8f0;
            color: #1e40af;
        }

        .menu-dropdown {
            position: absolute;
            top: 50px;
            right: 16px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,.15);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all .2s ease;
            z-index: 10;
        }
        .menu-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            font-size: 14px;
            color: #334155;
            text-decoration: none;
            transition: background .2s;
        }
        .menu-item:hover {
            background: #f1f5f9;
        }
        .menu-item.delete {
            color: #dc2626;
        }
        .menu-item i {
            font-size: 15px;
            width: 18px;
        }

        /* === CONTENU === */
        .post-content {
            padding: 0 16px 12px;
            font-size: 15px;
            line-height: 1.5;
            color: #334155;
            word-break: break-word;
        }

        /* Image */
        .post-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            display: block;
        }

        /* === INTERACTIONS SOUS LE CONTENU === */
        .interactions {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 10px 16px;
            border-top: 1px solid #f1f5f9;
            font-size: 13px;
            color: #64748b;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            cursor: default;
            transition: color .2s;
        }
        .action-btn i {
            font-size: 16px;
            color: #94a3b8;
        }
        .action-btn:hover {
            color: #3b82f6;
        }
        .action-btn:hover i {
            color: #3b82f6;
        }

        /* === MOBILE === */
        @media (max-width: 640px) {
            .header { padding: 14px 20px; margin: -20px -16px 20px; }
            .chat { padding: 0 16px; }
            .post-header { padding: 10px 14px; }
            .user-avatar { width: 38px; height: 38px; }
            .post-content { padding: 0 14px 10px; font-size: 14px; }
            .interactions { padding: 8px 14px; gap: 16px; font-size: 12px; }
            .menu-toggle { width: 32px; height: 32px; }
            .menu-dropdown { top: 45px; right: 12px; }
        }

        /* === BOUTON AJOUT FLOTTANT (NOUVEAU) === */
        .add-post-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: #3b82f6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.3);
            z-index: 999;
            transition: all 0.3s ease;
            text-decoration: none;
            border: 3px solid white;
        }
        .add-post-btn:hover {
            background: #2563eb;
            transform: scale(1.1);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.4);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="http://localhost/blog/logo.png" alt="logo">
        </div>
        <img src="https://i.pravatar.cc/40?img=5" alt="Profil" class="avatar">
    </header>

    <div class="chat">
        <h1>Fil de discussion</h1>
        <ul>
            <?php
            foreach($liste as $p){
            ?>
                <li>
                    <!-- En-tête -->
                    <div class="post-header">
                        <div class="user-info">
                            <div class="user-avatar"></div>
                            <div>
                                <div class="username">Vous</div>
                            </div>
                        </div>
                        <div class="post-time"><?= date('H:i', strtotime($p['createdAt'])); ?></div>
                        <div class="menu-toggle" onclick="toggleMenu(this)">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>

                        <!-- Menu 3 points -->
                        <div class="menu-dropdown">
                            <a href="delete.php?id=<?= $p['id']; ?>" class="menu-item delete">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>
                            <a href="update.php?id=<?= $p['id']; ?>" class="menu-item">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="post-content">
                        <?= (htmlspecialchars($p['contenu'])); ?>
                    </div>

                    <!-- Image -->
                    <?php if (!empty($p['imageUrl'])): ?>
                        <img src="<?= htmlspecialchars($p['imageUrl']); ?>" alt="Image" class="post-image" onerror="this.style.display='none'">
                    <?php endif; ?>

                    <!-- Interactions -->
                    <div class="interactions">
                        <div class="action-btn">
                            <i class="far fa-thumbs-up"></i> J’aime
                        </div>
                        <div class="action-btn">
                            <i class="far fa-comment"></i> Commenter
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>

    <!-- BOUTON AJOUT FLOTTANT -->
    <a href="add.php" class="add-post-btn" title="Ajouter un post">
        <i class="fas fa-plus"></i>
    </a>

    <!-- JS pour le menu -->
    <script>
        function toggleMenu(btn) {
            const menu = btn.nextElementSibling;
            const openMenus = document.querySelectorAll('.menu-dropdown.show');

    for (let i = 0; i < openMenus.length; i++) {
        if (openMenus[i] !== menu) {
            openMenus[i].classList.remove('show');
        }
    }

    menu.classList.toggle('show');
}


        document.addEventListener('click', function(e) {
            if (!e.target.closest('.menu-toggle') && !e.target.closest('.menu-dropdown')) {
                document.querySelectorAll('.menu-dropdown').forEach(m => m.classList.remove('show'));
            }
        });
    </script>

</body>
</html>