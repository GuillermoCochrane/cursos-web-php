<?php
require_once "functions.php";
/* 
require vs require_once: 
require_once solo carga el archivo una vez, 
require carga el archivo una vez y luego lo vuelve a cargar cada vez que se ejecuta la función.

require vs include: 
include carga el archivo , pero no devuelve fatak error si el archivo no existe.

include vs include_once:
similar a require y require_once, pero no devuelve error si el archivo no existe.
 */
$data = get_data(API_URL);
$until_message = get_until_message($data["days_until"]);
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
    <h3><?= $data["title"]; ?> - <?= $until_message; ?></h3>
    <p>Fecha de estreno: <?= $data["release_date"]; ?></p>
    <p>La siguiente es: <?= $data["following_production"]["title"]; ?></p>
  </hgroup>
</main>