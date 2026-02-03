<?php

declare(strict_types=1); //habilita tipado estricto, se activa a nivel de archivo

const API_URL = "https://whenisthenextmcufilm.com/api";

function get_data(string $url): array //tipado debil
{
  //con curl podemos usar todos los verbos de HTTP, con file_get_contents solo podemos usar GET
  $result = file_get_contents($url); //similar al fetch
  $data = json_decode($result, true); //Convierte el contenido en un objeto JSON
  return $data;
}

$data = get_data(API_URL);

/* 
  scope de las variables: 
  no exiseb variables globales. 
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
?>

<head>
  <meta charset="UTF-8" />
  <title>La próxima película de Marvel</title>
  <meta name="description" content="La próxima película de Marvel" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.classless.min.css" />
  <style>
    :root {
      color-scheme: light dark;
    }

    body {
      display: grid;
      place-content: center;
    }

    section {
      display: flex;
      justify-content: center;
      text-align: center;
    }

    hgroup {
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: center;
    }

    img {
      margin: 0 auto;
    }
  </style>
</head>
<main>

  <section>
    <img src="<?= $data["poster_url"]; ?>" width="200" alt="Poster de <?= $data["title"]; ?>" style="border-radius: 16px" />
  </section>

  <hgroup>
    <h3><?= $data["title"]; ?> se estrena en <?= $data["days_until"]; ?> días</h3>
    <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
    <p>La siguiente es: <?= $data["following_production"]["title"]; ?></p>
  </hgroup>
</main>