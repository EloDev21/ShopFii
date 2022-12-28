<?php

namespace App\Classe;
use App\Entity\Category; 

class Search 
{
    // on va créér un form pour manipuler le filter
    /**
     * @var string
     */
    public $string ="";
    // notre input (nom article) , en public pour pas de geter ni seter

    /**
     * @var Category[]
     */
    public $categories = [];
    // nos categories de produit
}