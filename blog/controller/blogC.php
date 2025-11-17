<?php
require_once '../config.php';
require_once '../model/blog.php';
class blogC{
    public function ajouterPost($publication) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('INSERT INTO blog (contenu, imageUrl, createdAt) VALUES (:c, :im, :d)');
            $req->execute([
                'c'  => $publication->getContenu(),
                'im' => $publication->getImageUrl(),
                'd'  => $publication->getCreatedAt()
            ]);
        } catch(Exception $e) {
            die('ERROR : ' . $e->getMessage());
        }
    }
    public function publier(){
        $db = config::getConnexion();
        try {
            $liste = $db->query('SELECT * FROM blog');      //query = prepare et execute
            return $liste;

        } catch(Exception $e) {
            die('ERROR : ' . $e->getMessage());
        }
    }
    public function deletePost($id){
        $db = config::getConnexion();
        try {
            $req = $db->prepare('DELETE FROM blog WHERE id =  :id');      
            $req->execute([
                'id' => $id
            ]);
        } catch(Exception $e) {
            die('ERROR : ' . $e->getMessage());
        }
    }
    public function updatePost($publication, $id) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('UPDATE blog SET contenu = :c, imageUrl = :im, createdAt = :d WHERE id = :id');

            $req->execute([
                'id' => $id,
                'c'  => $publication->getContenu(),
                'im' => $publication->getImageUrl(),
                'd'  => $publication->getCreatedAt()
            ]);

        } catch(Exception $e) {
            die('ERROR : ' . $e->getMessage());
        }
    }

}
?>