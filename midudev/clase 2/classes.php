<?php
declare(strict_types=1);

class SuperHero{
/*   // propiedades y métodos
  public $name; // publico: podemos acceder a o modificar desde fuera de la clase
  readonly public $powers; // readonly: solo podemos accederlo pero no modificarlo
  public $planet;
  private $level; // privado: solo podemos accederlo o modificarlo desde dentro de la clase, no desde fuera

  // constructor, necesario para inicializar las propiedades
  public function __construct($name, $powers, $planet){
    $this->name = $name;
    $this->powers = $powers;
    $this->planet = $planet;
    $this->level = 0;
  }
 */

  // promoted properties -> PHP 8
  public function __construct(
    public string $name,
    public array $powers,
    public string $planet,
    private int $level = 0
  ) {
  }

  public function attack(){
    return "¡$this->name ataca con sus poderes!";
  }

  public function description(){
    $powers = implode(", ", $this->powers); //similar al join en JS (concatena cada elemento del array con el siguiente, usando el delimitador que se le pase en el primer parametro)
    return "$this->name es un superhéroe que viene de $this->planet y tiene los siguientes poderes: $powers";
  }

  public function level_up(){
    $this->level++;
    return "¡Subio de nivel!  " . $this->show_current_level();
  }

  public function show_current_level(){
    return "¡$this->name está en el nivel $this->level!";
  }

  public function show_all(){
    return get_object_vars($this);
  }
}

$hero = new SuperHero("Thor", ["Superfuerza", "Volar", "Relámpago"], "Asgard");
echo $hero->description();
echo "\n";
echo $hero->level_up();
?>