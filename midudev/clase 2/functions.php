<?php
/* 
  scope de las variables: 
  Exisen variables globales, pero las funciones no las pueden acceder.
  Dentro de las funciones viven en su ambito.
  Dentro del script viven en su ambito.
  podemos acceder a las variables globales en una funcion, pasandola como parametro o definiendola como global.
  EJ:
  
  $nombre = "Juan";
  function hola(){
    global $nombre;
    echo $nombre;
  }
  hola();
  o

  function hola2($nombre){
    echo $nombre;
  }
  hola2("Juan");
*/
  declare(strict_types=1); //habilita tipado estricto, se activa a nivel de archivo

  const API_URL = "https://whenisthenextmcufilm.com/api";

  function get_data(string $url): array //tipado debil
  {
    //con curl podemos usar todos los verbos de HTTP, con file_get_contents solo podemos usar GET
    $result = file_get_contents($url); //similar al fetch
    $data = json_decode($result, true); //Convierte el contenido en un objeto JSON
    return $data;
  }


  function get_until_message(int $days): string
  {
    return match (true) {
      $days === 0    => "¡Hoy se estrena! 🥳",
      $days === 1    => "Mañana se estrena 🚀",
      $days < 7      => "Esta semana se estrena 🫢",
      $days < 30     => "Este mes se estrena... 🗓️",
      default        => "$days días hasta el estreno 🗓️",
      };
  }
?>