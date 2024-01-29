<?php 


namespace App\Entity;

class Lego {
    // L’attribute #[Route] indique ici que l'on associe la route
    // "/" à la méthode home pour que Symfony l'exécute chaque fois
    // que l'on accède à la racine de notre site.
    public $id;
    public $name;
    public $collection;

    public $description;
    public $price;
    public $pieces;
    public $boxImage;
    public $legoImage;

    function __construct($id,$name,$coll){
        $this->id = $id;
        $this->name = $name;
        $this->collection = $coll;
    }

    function getId(): int {
        return $this->id;
    }

    function getName(): string {
        return $this->name;
    }

    function getCollection(): string {
        return $this->collection;
    }




    function getDescription(): string {
        return $this->description;
    }
    function setDescription(string $desc) {
        $this->description = $desc;
    }

    function getPrice(): int {
        return $this->price;
    }
    function setPrice(int $price) {
        $this->price = $price;
    }

    function getPieces(): int {
        return $this->pieces;
    }
    function setPieces(int $pieces) {
        $this->pieces = $pieces;
    }

    function getBoxImage(): string {
        return $this->boxImage;
    }
    function setBoxImage(string $boxImage) {
        $this->boxImage = $boxImage;
    }

    function getLegoImage(): string {
        return $this->legoImage;
    }
    function setLegoImage(string $legoImage) {
        $this->legoImage = $legoImage;
    }


}