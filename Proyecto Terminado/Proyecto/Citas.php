<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hospital Tierra y Libertad</title>
    <style>
        body {
            background-color: #8B0000; /* color guindo */
            color: white; /* para mejor contraste con el fondo oscuro */
            font-family: Arial, sans-serif;
        }

        a {
            color: #FFD700; /* opcional: cambia el color de los enlaces */
        }

        header, nav, main, footer {
            margin: 20px;
        }

        table {
            color: white;
        }
    </style>
</head>

<body>

<?php
// Mostrar alerta si existe mensaje en URL (GET)
if (isset($_GET['mensaje'])) {
    // Escapar texto para evitar problemas de seguridad
    $mensaje = htmlspecialchars($_GET['mensaje']);
    echo "<script>alert('$mensaje');</script>";
}
?>

<header>
    <table>
        <tr>
            <td><img src="imagenes/Logo1.png" alt="Logo" width="120" /></td>
            <td><h2>Hospital Tierra y Libertad</h2></td>
        </tr>
    </table>
    <hr>
</header>

<nav>
    <h3>Citas</h3>
    <ul>
        <li><a href="index.html">Pagina principal</a></li>
        <li><a href="Citas.php">Citas</a></li>
        <li><a href="Contacto.html">Contacto</a></li>
    </ul>
    <hr>
</nav>

<main>
    <article>
        <h3>Agenda tu cita aqui!</h3>
        <p>Nombre, Telefono, Correo electronico y Fecha.</p>
        <hr>
        <section>
            <form action="Process_Citas.php" method="POST">
                <table>
                    <tr>
                        <td><input type="hidden" name="id" id="id"></td>
                        <td><label for="Nombre">Nombre:</label></td>
                        <td><input type="text" name="Nombre" id="Nombre" required></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="Apellido">Apellido:</label></td>
                        <td><input type="text" name="Apellido" id="Apellido" required></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="Correo">Correo:</label></td>
                        <td><input type="text" name="Correo" id="Correo" required></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><label for="Telefono">Teléfono:</label></td>
                        <td><input type="text" name="Telefono" id="Telefono" required></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <label for="fecha_Hora">Selecciona fecha y hora:</label><br><br>
                            <input type="datetime-local" id="fecha_Hora" name="fecha_Hora" required><br><br>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="action" value="add">Agendar</button>
            </form>
        </section>
    </article>
</main>

</body>
</html>
