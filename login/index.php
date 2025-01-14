<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    
    <header>
        <a href="https://hraei.gob.mx/" target="_blank">HRAEI</a>
        <strong style="color:aliceblue;">|</strong>

        <a href="../main_page/index.php">Inicio</a>
        <strong style="color:aliceblue;">|</strong>
        <a href=""></a>
        
        <a href="../main_page/clinicas.php">Clínicas</strong>
        <strong style="color:aliceblue;">|</strong>
        <a href="" target="_blank"></a>

        <a href="../main_page/calidad.php">Calidad</strong>
        <strong style="color:aliceblue;">|</strong>
        <a href="" target="_blank"></a>

        <a href="../main_page/enfermeria.php">Enfermeria</strong>
        <strong style="color:aliceblue;">|</strong>
        <a href="" target="_blank"></a>

        <a href="../main_page/servicios.php">Servicios</strong>
        <strong style="color:aliceblue;">|</strong>
        <a href="" target="_blank"></a>

        <a href="../main_page/patologias.php">Patologías</strong>
        <strong style="color:aliceblue;">|</strong>
        <a href="" target="_blank"></a>

        <a href="../main_page/rehabilitacion.php">Rehabilitación</strong>
        <strong style="color:aliceblue;">|</strong>
        <a href="" target="_blank"></a>
    </header>



    <div class= "login-container1"> 
        <div class= "information" >
            <div class= "info-childs">
            <h2> Bienvenido </h2>
            <p>  </p>
        </div>
    </div>

    <div class="login-container">
        <form class="login-form" id="login_form" method="POST">
            <h5>Iniciar Sesión</h5>
            <br>
        
        <div class="input-container">
                <i class="fa-solid fa-user"></i>
                <input type="text" id="username" name="username" required placeholder="Nombre de usuario">
            </div>
        

        <div class="input-container">
            <i class="fa-solid fa-lock"></i>
            <input type="password" id="password" name="password" required placeholder="Password">
            </div>
            <button type="submit" value="Enviar">Iniciar Sesión</button>
        </form>
        </div>
        
        <div id="loading-overlay" style="display: none;" class="loading">
            <svg width="128px" height="96px">
                <polyline points="0.157 47.907, 28 47.907, 43.686 96, 86 0, 100 48, 128 48" id="back"></polyline>
                <polyline points="0.157 47.907, 28 47.907, 43.686 96, 86 0, 100 48, 128 48" id="front"></polyline>
            </svg>
        </div>

</div>
    <footer>
        Hospital Regional de Alta Especialidad de Ixtapaluca
       <p style="font-size: 10px">
            Dirección de Operaciones - Subdirección de Tecnologías de la Información 
            <br> Gestión Digital en Salud - 2023
       </p> 
    </footer>
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="module">
        import { mainLogin } from './js/login.js';
        mainLogin();

    </script>



</body>
</html>
