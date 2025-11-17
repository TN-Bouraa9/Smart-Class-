<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
    }
    .logo {
      display: flex; align-items: center; gap: 2px;
    }
    .logo > img{
      width: 200px;
    }
  
    .avatar {
      width: 44px; height: 44px; border-radius: 50%;
      border: 2.5px solid #3b82f6;
      box-shadow: 0 2px 8px rgba(59,130,246,.2);
      transition: transform .2s;
    }
    .avatar:hover { transform: scale(1.05); }

    /* === CONTENU PRINCIPAL (vide pour pousser le box en bas) === */
    .main-content {
      flex: 1;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
    }

    /* === BOX DE PUBLICATION EN BAS === */
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
    .post-box:hover {
      transform: translateY(-2px);
      box-shadow: 0 -16px 48px rgba(0,0,0,.12), 0 -8px 24px rgba(0,0,0,.08);
    }

    /* === Ligne principale (avatar + input) === */
    .post-input-row {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .post-input-row .avatar {
      width: 44px; height: 44px; margin: 0;
      border: 2.5px solid #e2e8f0; flex-shrink: 0;
    }
    .input {
      flex: 1;
      padding: 14px 20px;
      border: none; background: rgba(248,250,252,.95);
      border-radius: 30px; font: 500 16px/1 'Inter', sans-serif;
      color: #1e293b; outline: none;
      transition: all .3s;
    }
    .input::placeholder { color: #94a3b8; }
    .input:focus {
      background: white;
      box-shadow: inset 0 1px 3px rgba(0,0,0,.1), 0 0 0 3px rgba(59,130,246,.15);
    }

    /* === BOUTONS ALIGNÉS À DROITE === */
    .action-buttons {
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 10px;
    }

    /* === Icône Photo (seule) === */
    .photo-btn {
      width: 44px; height: 44px;
      border: 1px solid #e2e8f0;
      border-radius: 50%;
      background: #f8fafc;
      color: #3b82f6;
      font-size: 18px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all .3s;
    }
    .photo-btn:hover {
      background: #e7f3ff;
      border-color: #3b82f6;
      transform: translateY(-2px);
    }

    /* === Champ URL image (caché) === */
    .image-url-input {
      display: none;
      padding: 10px 14px;
      border: 1px solid #e2e8f0;
      border-radius: 12px;
      font-size: 14px;
      background: #fff;
      margin-top: 8px;
    }

    /* === Bouton Envoyer === */
    .btn {
      width: 48px; height: 48px; border: none; border-radius: 50%;
      background: #e2e8f0;
      color: #94a3b8; font-size: 18px; cursor: not-allowed;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 6px 20px rgba(59,130,246,.15);
      transition: all .4s cubic-bezier(.4,0,.2,1);
    }
    .btn.active {
      background: linear-gradient(135deg, #3b82f6, #2563eb);
      color: white;
      cursor: pointer;
      box-shadow: 0 6px 20px rgba(59,130,246,.35);
    }
    .btn.active:hover {
      transform: translateY(-3px) scale(1.08);
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      box-shadow: 0 10px 28px rgba(59,130,246,.45);
    }
    .btn:active { transform: scale(.95); }

    /* === FIXÉ EN BAS SUR MOBILE === */
    @media (max-width: 640px) {
      .header { padding: 14px 20px; flex-direction: column; gap: 12px; }
      .main-content { padding: 10px; }
      .post-box {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        margin: 0;
        border-radius: 24px 24px 0 0;
        box-shadow: 0 -8px 32px rgba(0,0,0,.1);
        padding: 14px;
        gap: 10px;
      }
      .post-input-row .avatar { width: 40px; height: 40px; }
      .input { padding: 12px 16px; font-size: 16px; }
      .photo-btn, .btn { width: 42px; height: 42px; font-size: 17px; }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="logo">
        <img src="http://localhost/blog/logo.png" alt="logo">
      </div>
    </div>
    <img src="https://i.pravatar.cc/40?img=5" alt="Profil" class="avatar">
  </header>

  <!-- Contenu principal (vide ou pour futur feed) -->
  <div class="main-content">
    <!-- Ici tu peux ajouter un feed plus tard -->
  </div>

  <!-- Box de publication EN BAS -->
  <div class="post-box">
    <form action="ajout.php" method="POST" id="postForm">
      <!-- Ligne principale -->
      <div class="post-input-row">
        <img src="https://i.pravatar.cc/40?img=5" alt="Moi" class="avatar">
        <input type="text" name="contenu" placeholder="Quoi de neuf ?" class="input">
      </div>
      <!-- Boutons alignés à droite -->
      <div class="action-buttons">
        <!-- Icône photo -->
        <!-- <div class="photo-btn">
          <i class="fas fa-image"></i>
        </div> -->

        <!-- Bouton envoyer -->
        <button type="submit" class="btn" id="submitBtn" disabled>
          <i class="fas fa-paper-plane"></i>
        </button>
      </div>

      <!-- Champ URL image (caché) -->
      <!-- <input type="text" name="imageUrl" placeholder="Colle l'URL de l'image..." class="image-url-input" id="imageUrlInput"> -->
    </form>
  </div>

  <!-- JavaScript -->
  <script>
    const input = document.querySelector('.input');
    const submitBtn = document.getElementById('submitBtn');
    //const imageInput = document.getElementById('imageUrlInput');

    input.addEventListener('input', () => {
      const hasText = input.value.trim().length > 0;
      submitBtn.disabled = !hasText;
      submitBtn.classList.toggle('active', hasText);
    });
  </script> 

</body>
</html>