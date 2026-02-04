<?php

class SuperHero{
  // propiedades y métodos
  public $name; // publico: podemos acceder a o modificar desde fuera de la clase
  public $powers;
  public $planet;
  private $level; // privado: solo podemos accederlo o modificarlo desde dentro de la clase, no desde fuera

  // constructor, necesario para inicializar las propiedades
  public function __construct($name, $powers, $planet){
    $this->name = $name;
    $this->powers = $powers;
    $this->planet = $planet;
    $this->level = 0;
  }

  public function attack(){
    return "¡$this->name ataca con sus poderes!";
  }

  public function description(){
    return "$this->name es un superhéroe que viene de $this->planet y tiene los siguientes poderes: $this->powers";
  }

  public function level_up(){
    $this->level++;
    return "¡$this->name subió de nivel, al nivel $this->level!";
  }
}

$hero = new SuperHero("Thor", "Superfuerza, Volar y Relámpago", "Asgard");
echo $hero->description();
?>