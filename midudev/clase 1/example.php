<?php
  // variables
  $name = 'Guille'; // string puede ser con '' o ""
  $isDev = false;
  $age = 4;
  // var_dump($name); muestra el valor de la variable y el tipo de dato
  // var_dump($isDev);
  // var_dump($age);

  // echo gettype($name);  muestra el tipo de dato de la variable
  // echo gettype($isDev); 
  // echo gettype($age);

  // echo is_string($name); formas de checar tipos de datos
  // echo is_bool($isDev);  
  // echo is_int($age); 
  $output = "Hola \"$name\", con una edad de $age. 😝"; //concatenar solo con  "" 
  $output .= "<br/>"; //otra forma de concatenar
  // escapamos el caracteres (") con una barra invertida (\)
  
  //constates 
  define('LOGO_URL', 'https://cdn.freebiesupply.com/logos/large/2x/php-1-logo-svg-vector.svg');
  const FRUTA = "banana 🍌"; // no se pueden usar en ejecucion ni en bucles

  //booleanos
  $isGreaterThan = $age > 18;
  $isLessThan = $age < 18;
  $isEqual = $age === 18;
  $isNotEqual = $age !== 18;
  $isGreaterThanOrEqual = $age >= 18;
  $isLessThanOrEqual = $age <= 18;
  $negateValue = !$isDev;
  $multipleConditions = $isDev && $isGreaterThan;

  $isOld = $age > 18;
  //if ternario
  $outputAge = $isOld 
    ? "Eres mayor de edad, $name 🍺" 
    : "Eres menor de edad, $name 👶";

  //match (similar a switch)
  $matchAge = match ($age) {
    0, 1, 2 => "Eres un bebé, $name 👶",
    3, 4, 5, 6, 7, 8, 9, 10 => "Eres un niño, $name 👦",
    11, 12, 13, 14, 15, 16, 17, 18 => "Eres un adolescente, $name 👨‍🎓",
    19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30 => "Eres un adulto joven, $name 👨‍💼",
    default => "Eres un adulto, $name 👴",
  };
  //otra forma de match
  $otherMatchAge = match (true) {
    $age < 2    => "Eres un bebé, $name 👶",
    $age < 10   => "Eres un niño, $name 👦",
    $age < 18   => "Eres un adolescente, $name 👨‍🎓",
    $age === 18 => "Eres mayor de edad, $name 🍺",
    $age < 40   => "Eres un adulto joven, $name 👨‍💼",
    $age < 60   => "Eres un adulto viejo, $name 👴",
    default     => "Hueles más a madera que a fruta, $name 👴",
  };
  //arrays 
  $bestLanguages = ["PHP", "JavaScript", "Python", 33];
  $bestLanguages[3] = "Java"; //modificar un elemento
  $bestLanguages[] = "TypeScript"; //agregar un elemento
?>

<style>
  :root {
    color-scheme: light dark;
  }

  body {
    display: grid;
    place-content: center;
    font-family: Arial, Helvetica, sans-serif;
    text-align: center;
  }
</style>

<h1><!-- formas  de imprimir texto en php -->
  <?php echo "Hola mundo <br/>"; ?>  
  <?= "MI primera app <br/>"; ?>
</h1>

<p>
  <?= $name; ?> <!-- imprimir variable --> 
  <!-- concatenar variables en strings-->
  <?= "<br/> Hola, soy " . $name . " y tengo " 
  . $age . " años <br/>"; ?>
  <!-- se puede hacer en varias lineas, sin perder la continuidad del texto -->
  <?= $output; ?>
</p>

<img src="<?= LOGO_URL ?>" alt="PHP Logo" width="200" style="display: block; margin: 0 auto;">
<p> <?= FRUTA ?> </p>

<p>
  <?php // condicionales : if
    if ($isOld) {
      echo "Eres mayor de edad, $name 🍺";
    } else if ($isDev) { // una forma de usar else if
      echo "eres dev $name 👨‍💻";
    } elseif (!$isDev && !$isOld) {
      echo "eres estudiante de dev $name 👨‍🎓";
    } else {
      echo "Eres menor de edad, $name 👶";
    }
  ?>
</p>

<!-- otra forma de condicionales -->
<?php if($isOld): ?>
  <h2>Eres mayor de edad 🍺</h2>
<?php elseif($isDev): ?><!-- de esta forma no se puede separar el elseif  -->
  <h2> eres dev 👨‍💻</h2>
<?php elseif(!$isDev && !$isOld): ?>
  <h2>eres estudiante de dev 👨‍🎓</h2>
<?php else: ?>
  <h2>Eres menor de edad 👶</h2>
<?php endif; ?>

<h2><?= $outputAge ?></h2> <!-- imprimir if ternario -->
<h2><?= $matchAge ?></h2> <!-- imprimir match -->

<ul> <!-- iterar sobre arrays -->
  <?php foreach ($bestLanguages as $key => $language) : ?>
    <li><?= $key . " " . $language ?></li>
  <?php endforeach; ?>
</ul>