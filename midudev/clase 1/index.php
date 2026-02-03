<?php
  // variables
  $name = "Guille";
  $isDev = true;
  $age = 44;
  // var_dump($name); muestra el valor de la variable y el tipo de dato
  // var_dump($isDev);
  // var_dump($age);

  // echo gettype($name);  muestra el tipo de dato de la variable
  // echo gettype($isDev); 
  // echo gettype($age);

  // echo is_string($name); formas de checar tipos de datos
  // echo is_bool($isDev);  
  // echo is_int($age); 
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
</p>