<?php

class SuperHero{
  // propiedades y métodos
  public $name;
  public $powers;
  public $planet;

  public function attack(){
    return "¡$this->name ataca con sus poderes!";
  }

  public function description(){
    $powers = implode(", ", $this->powers);
    return "$this->name es un superhéroe que viene de $this->planet y tiene los siguientes poderes: $powers";
  }
}

$hero = new SuperHero();
//echo $hero->name; // no muetra nada xq no tiene el constructor

$hero->name = "Thor";
$hero->powers = ["Superfuerza", "Volar", "Relámpago"];
$hero->planet = "Asgard";
echo $hero->description();
// intelephense marca 2 errores, pero se corrigen mas adelante en el video, el script se ejecuta correctamente
?>