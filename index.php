<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Clinica SePrice</title>
        <link rel="icon" href="img/favicon.ico">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/style.css">
        
        <lin    k rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <div class="formulario">
                <img class="logo" src="assets/img-logo.png" alt="logo">
                <form action="acceso.php" method="POST">
                <select name="perfil" id="perfil" required>
                    <option value="Invalid" aria-invalid="false" required>Selecciona tu perfil</option>
                    <option value="Paciente">Paciente</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Recepcionista">Recepcionista</option>
                    <option value="Administrador">Administrador</option>
                </select><br></br>
                <input type="text" placeholder="Usuario" name="usuario" id="usuario" required><br></br>
                <input type="password" placeholder="Contraseña" name="password" id="password" required><br></br>
                
                <button button type="submit" id="login-button" class="login-button">Acceder</button> <br>
            </form>
            </div class="imagen">
                <img src="./assets/Telecommuting-pana 1.svg" alt="Imagen Principal">
            </div>
        </div>
    </body>
</html>
