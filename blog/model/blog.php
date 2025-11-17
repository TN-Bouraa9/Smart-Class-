<?php
class publication{
    private int $id;
    private string $contenu;
    private string $imageUrl;
    private string $createdAt;

    public function __construct(string $contenu,string $imageUrl,string $createdAt) {   
        $this->contenu   = $contenu;
        $this->imageUrl  = $imageUrl;
        $this->createdAt = $createdAt;
    }

    // Getters
    public function getId(){
        return $this->id; 
    }
    public function getContenu(){ 
        return $this->contenu; 
    }
    public function getImageUrl(){ 
        return $this->imageUrl; 
    }
    public function getCreatedAt(){ 
        return $this->createdAt; 
    }

    // Setters
    public function setId($id) {
    $this->id = $id;
}
    public function setContenu($contenu){
        $this->contenu = $contenu;
    }
    public function setImageUrl($imageUrl){
        $this->imageUrl = $imageUrl;
    }
    public function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
    }
}
?>