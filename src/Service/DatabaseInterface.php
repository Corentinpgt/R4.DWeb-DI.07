<?php


// Là ou la classe est déclarée (où son fichier se trouve)
namespace App\Service;

use App\Entity\Lego;
use PDO;

class DatabaseInterface
{
    public function getAllLegos(): array
    {
        $cnx = new PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $answer = $cnx->query("SELECT * from lego"); 
        $res = $answer->fetchAll(PDO::FETCH_OBJ);
        $return =[];
        foreach ($res as $lego) {
            $leg = new Lego($lego->id, $lego->name, $lego->collection);
            $leg->setDescription($lego->description);
            $leg->setPrice($lego->price);
            $leg->setPieces($lego->pieces);
            $leg->setBoxImage($lego->imagebox);
            $leg->setLegoImage($lego->imagebg);
            array_push($return, $leg);
        }
        return $return;
    }

    public function getLegosByCollection(string $coll): array
    {
        $cnx = new PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $answer = $cnx->query("SELECT * from lego WHERE collection='$coll'"); 
        $res = $answer->fetchAll(PDO::FETCH_OBJ);
        $return =[];
        foreach ($res as $lego) {
            $leg = new Lego($lego->id, $lego->name, $lego->collection);
            $leg->setDescription($lego->description);
            $leg->setPrice($lego->price);
            $leg->setPieces($lego->pieces);
            $leg->setBoxImage($lego->imagebox);
            $leg->setLegoImage($lego->imagebg);
            array_push($return, $leg);
        }
        return $return;
    }

    public function getAllCollection(): array
    {
        $cnx = new PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", "root", "root");
        $answer = $cnx->query("SELECT DISTINCT collection FROM `lego`"); 
        $res = $answer->fetchAll(PDO::FETCH_OBJ);
        $return = [];
        foreach ($res as $obj) {
            array_push($return, $obj->collection);
        }
        return $return;
    }
}