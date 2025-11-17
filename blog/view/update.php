<?php
require_once '../Controller/blogC.php';
require_once '../Model/blog.php';

$bc = new blogC();
$id = $_GET['id'];

// === SI FORMULAIRE SOUMIS → MODIFIER + REDIRIGER ===
if (isset($_POST['contenu'])) {
    $publication = new publication(
        $_POST['contenu'],
        $_POST['imageUrl'],
        $_POST['createdAt']
    );

    $bc->updatePost($publication, $id);
    header("Location: liste.php");
    exit;
}

// === RÉCUPÉRER LA PUBLICATION À MODIFIER ===
$liste = $bc->publier();
$publication = null;

foreach ($liste as $p) {
    if ($p['id'] == $id) {
        $publication = $p;
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier la publication</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fff 0%, #f0f9ff 50%, #e0f2fe 100%);
            background-attachment: fixed;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        body::before {
            content: ''; position: fixed; inset: 0; pointer-events: none; z-index: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(147,197,253,.08), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(103,232,249,.06), transparent 50%);
        }

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
        }
        .logo { display: flex; align-items: center; gap: 12px; }
        .logo-icon {
            width: 52px; height: 68px;
            display: grid; grid-template: repeat(4,1fr)/repeat(3,1fr);
            gap: 5px; padding: 6px;
            transition: transform .2s;
        }
        .logo-icon:hover { transform: scale(1.02); }
        .dot {
            width: 10px; height: 10px; background: #0ea5e9;
            border-radius: 50%;
            margin: auto;
            box-shadow: 0 0 8px rgba(14,165,233,.5);
        }
        .logo span {
            font: 600 28px/1 'Poppins', sans-serif;
            color: #1e40af; letter-spacing: -0.3px;
            text-transform: lowercase;
        }
        
        .avatar {
            width: 44px; height: 44px; border-radius: 50%;
            border: 2.5px solid #3b82f6;
            box-shadow: 0 2px 8px rgba(59,130,246,.2);
            transition: transform .2s;
        }
        .avatar:hover { transform: scale(1.05); }

        .main-content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .post-box {
            display: flex;
            flex-direction: column;
            background: white;
            padding: 16px;
            border-radius: 24px;
            box-shadow: 0 -8px 32px rgba(0,0,0,.08), 0 -4px 16px rgba(0,0,0,.06);
            border: 1px solid rgba(226,232,240,.9);
            width: 100%; max-width: 580px;
            margin: 0 auto 20px;
            transition: all .4s cubic-bezier(.4,0,.2,1);
            gap: 12px;
        }

        .post-input-row {
            display: flex; align-items: center; gap: 12px;
        }
        .post-input-row .avatar {
            width: 44px; height: 44px; margin: 0;
            border: 2.5px solid #e2e8f0; flex-shrink: 0;
        }

        .input {
            flex: 1;
            padding: 14px 20px;
            border: none; background: rgba(248,250,252,.95);
            border-radius: 30px;
            font: 500 16px/1 'Inter', sans-serif;
            color: #1e293b;
            outline: none;
            transition: all .3s;
        }

        .image-url-input {
            display: block;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            background: #fff;
            margin-top: 8px;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        .btn {
            width: 48px; height: 48px;
            border: none; border-radius: 50%;
            background: #3b82f6;
            color: white; font-size: 18px;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(59,130,246,.35);
            transition: .3s;
        }
        .btn:hover { transform: translateY(-3px) scale(1.08); }
    </style>
</head>

<body>

<header class="header">
    <div class="logo">
        <div class="logo-icon">
            <div class="dot"></div><div class="dot"></div><div class="dot"></div>
            <div class="dot"></div><div class="dot"></div><div class="dot"></div>
            <div class="dot"></div><div class="dot"></div><div class="dot"></div>
            <div class="dot"></div><div class="dot"></div><div class="dot"></div>
        </div>
        <span>SocialHub</span>
    </div>
    <img src="https://i.pravatar.cc/40?img=5" class="avatar">
</header>

<div class="main-content"></div>

<div class="post-box">
    <form action="" method="POST">

        <input type="hidden" name="id" value="<?= $publication['id']; ?>">
        <input type="hidden" name="createdAt" value="<?= $publication['createdAt']; ?>">

        <div class="post-input-row">
            <img src="https://i.pravatar.cc/40?img=5" class="avatar">
            <input type="text"
                   name="contenu"
                   class="input"
                   placeholder="Modifier le contenu..."
                   value="<?= $publication['contenu']; ?>">
        </div>
        <!-- pour l'image -->
        <input type="text" name="imageUrl" class="image-url-input" value="">

        <div class="action-buttons">
            <button type="submit" class="btn">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>

    </form>
</div>

</body>
</html>
