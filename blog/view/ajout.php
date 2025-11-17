<?php
require_once '../controller/blogC.php';
require_once '../model/blog.php';

$contenu   = ($_POST['contenu']);
$imageUrl  = ($_POST['imageUrl'] ?? 'https://via.placeholder.com/150'); // valeur par défaut
$createdAt = date('Y-m-d H:i:s'); // date actuelle

$blog = new publication($contenu, $imageUrl, $createdAt); // Post avec P majuscule

$blogC = new blogC();
$blogC->ajouterPost($blog); // utiliser ajouterPost(), pas publier()

header('Location: liste.php');
exit;
?>