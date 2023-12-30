<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="text/javascript" src="./js/app.js"></script>
    <title>Generador de Claves</title>
    <link rel="icon" type="image/x-icon" href="./img/key-solid.svg">
</head>
<body>
    <?php
        $cantCarctrs = $tipoClave = "";

        function val($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function ClaveAleatoria($longitudClave, $tipoClave) {
            $soloNumeros = "1234567890";
            $soloCaracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $todosCaracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ012345678~!@#$%^&*<>?()+-=/|\.,;:";

            // Seleccionar cadena de caracteres según el tipo
            switch ($tipoClave) {
                case 1:
                    $caracteres = $soloCaracteres;
                    break;
                case 2:
                    $caracteres = $soloNumeros;
                    break;
                case 3:
                    $caracteres = $todosCaracteres;
                    break;
                default:
                    $caracteres = null;
                    break;
            }

            // Calcular longitud de cadena de caracteres
            $longitudCaracteres = strlen($caracteres);

            // Crear clave aleatoria
            $claveAleatoria = "";
            for ($i=0; $i < $longitudClave; $i++) { 
                $claveAleatoria .= $caracteres[random_int(0, $longitudCaracteres - 1)];
            }

            return $claveAleatoria;
        }
    ?>
    <section class="hero has-background-link-light">
        <div class="hero-body">
        <h1 class="title has-text-link-dark"><i class="fa-solid fa-key"></i>&nbsp;Generador de Contraseñas</h1>
        <p class="subtitle has-text-link-dark">Simples o complejas</p>
        </div>
    </section>

    <section class="section column is-half">
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Se validan ambos campos
                if ($_POST["cantCarctrs"] ?? "0" && $_POST["tipoClave"] ?? "0") {
                    $cantCarctrs = intval($_POST["cantCarctrs"]);
                    $tipoClave = intval($_POST["tipoClave"]);
                }
            }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="field is-flex">
            <label class="label" for="cantCarctrs">Cantidad de Caracteres:</label>
            <div class="control ml-5">
                <div class="select <?php if($cantCarctrs<>""){ echo "is-normal"; } else { echo "is-danger"; } ?> ">
                    <select name="cantCarctrs" id="cantCarctrs" class="is-one-quarter">
                        <option value="" disabled selected>Select an option</option>
                        <option value="8">8</option>
                        <option value="10">10</option>
                        <option value="12">12</option>
                        <option value="14">14</option>
                        <option value="16">16</option>
                        <option value="18">18</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="field is-flex">
            <label class="label" for="tipoClave">Tipo de Clave:</label>
            <div class="control ml-5">
                <div class="select <?php if($tipoClave<>""){ echo "is-normal"; } else { echo "is-danger"; } ?> ">
                    <select name="tipoClave" id="tipoClave" class="is-one-third">
                        <option value="" disabled selected>Select an option</option>
                        <option value="1">Solo caracteres</option>
                        <option value="2">Solo números</option>
                        <option value="3">Números y Caracteres</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <label class="label" for="claveFinal">Resultado:</label>
            <input class="input has-text-centered is-size-3"
            type="text" name="claveFinal" id="claveFinal" readonly value="<?php 
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo ClaveAleatoria($cantCarctrs, $tipoClave);
            }  ?>">
            
        </div>

        <div class="field has-background-white">
            <div class="control has-text-centered p-4">
                <div class="columns">
                    <div class="column">
                        <input class="button is-link" type="submit" value="Generar Clave">
                    </div>
                    <div class="column">
                        <button id="borrador" class="button is-link ancho"><i class="fa-solid fa-eraser"></i></button>
                    </div>
                </div>
            </div>
        </div>
        </form>

    </section>
</body>
</html>
