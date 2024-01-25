<?php
error_reporting(0);

include '../../assets/auth/credentials.php';
require '../../assets/auth/keyauth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['un'])) {
    header("Location: /auth/login");
    exit; // Asegúrate de salir del script después de redirigir
}

if (isset($_POST['logout'])) {
    // Elimina la información de notificaciones almacenada en caché en el servidor
    unset($_SESSION['notificacionesLeidas']);
    session_destroy();
    header("Location: /");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $Ownerid, $version);

$url = "https://keyauth.win/api/seller/?sellerkey={$SellerKey}&type=getsettings";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($curl);
$json = json_decode($resp);

if (!$json->success) {
    die("Error: {$json->message}");
}

$username = $_SESSION["user_data"]["username"];
$subscriptions = $_SESSION["user_data"]["subscriptions"];
$subscription = $_SESSION["user_data"]["subscriptions"][0]->subscription;
$expiry = $_SESSION["user_data"]["subscriptions"][0]->expiry;
$ip = $_SESSION["user_data"]["ip"];
$hwid = $_SESSION["user_data"]["hwid"];
$createdate = $_SESSION["user_data"]["createdate"];
$lastLogin = $_SESSION["user_data"]["lastlogin"];

$download = $json->download;
$webdownload = $json->webdownload;
$appcooldown = $json->cooldown;

$numKeys = $KeyAuthApp->numKeys;
$numUsers = $KeyAuthApp->numUsers;
$numOnlineUsers = $KeyAuthApp->numOnlineUsers;
$customerPanelLink = $KeyAuthApp->customerPanelLink;

$status = ($expiry > time()) ? "Active" : "Expire";
$circleColor = ($expiry > time()) ? "#6fe27c" : "#ff0000";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Support | GLOBAL X</title>
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/other.css?v=1.2">
    <link rel="stylesheet" href="../assets/css/discordv3.css?v=1.1">
    <link rel="shortcut icon" href="../../assets/img/favicon.png?v=1.1" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://cdn.keyauth.uk/dashboard/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.keyauth.uk/dashboard/unixtolocal.js"></script>
    <style>
    .flex-grow {
        flex-grow: inherit !important;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand img {
        width: calc(208px - 120px);
        max-width: 100%;
        height: auto;
        margin: auto;
        vertical-align: middle;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand.brand-logo-mini img {
        width: calc(100%);
        max-width: 100%;
        height: 65px;
        margin: auto;
    }

    .navbar-dropdown {
        background: #0a0c0f !important;
    }

    .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {
        width: calc(100%);
        max-width: 100%;
        height: 50px;
        margin: auto;
    }

    .navbar {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0)) !important;
    }

    .navbar .navbar-brand-wrapper {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0)) !important;
    }

    .sidebar .sidebar-brand-wrapper {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0)) !important;
    }

    .sidebar-icon-only .sidebar .nav .nav-item.hover-open .nav-link .menu-title {
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        background: #0a0c0f !important;
        padding: 0.5rem 1.4rem;
        left: 70px;
        position: absolute;
        text-align: left;
        top: 0;
        bottom: 0;
        width: 190px;
        z-index: 1;
        line-height: 1.8;
    }

    .fn-break h2 {
        margin: 0;
        font-size: 20px !important;
        line-height: 60px !important;
        height: 60px !important;
        padding-left: 20px !important;
        background: #000000 !important;
        float: left !important;
        position: relative !important;
        z-index: 1 !important;
    }

    .card {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0 / 50%)) !important;
        border-color: #30363d !important;
        border-style: solid !important;
        border-width: 1px !important;
        border-radius: 6px !important;
    }


    .fn-break-gradient.left {
        box-shadow: 10px 10px 17px #000000 !important;
    }

    .fn-break-gradient {
        float: left !important;
        position: relative !important;
        z-index: 1 !important;
        width: 20px !important;
        background: #000000 !important;
        height: 60px !important;
    }

    .fn-header-row-break {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0 / 50%)) !important;
        border-color: #30363d !important;
        border-style: solid !important;
        border-width: 1px !important;
        border-radius: 6px !important;
    }

    .fn-break-gradient.right {
        float: right !important;
        box-shadow: -10px -10px 17px #000000 !important;
    }

    .sidebar {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0 / 50%)) !important;
    }

    .content-wrapper {
        background: linear-gradient(rgb(0 0 0), rgb(0 0 0 / 50%)) !important;
        background-size: cover !important;
        background-position: top !important;
        background-repeat: no-repeat !important;
        overflow: hidden !important;
        backdrop-filter: blur(7px) !important;
    }

    .sidebar .nav .nav-item.active>.nav-link:before {
        content: "" !important;
        width: 3px !important;
        height: 100% !important;
        background: #006de1 !important;
        display: inline-block !important;
        position: absolute !important;
        left: 0 !important;
        top: 0 !important;
    }

    .sidebar .nav .nav-item .menu-icon {
        background: #21262d8f !important
    }

    .sidebar .nav .nav-item.active>.nav-link {
        background: #0f83ff0a !important;
    }

    .sidebar .nav:not(.sub-menu)>.nav-item:hover:not(.nav-category):not(.account-dropdown)>.nav-link {
        background: #0f83ff0a !important;
    }

    .footer {
        background: transparent !important;
        padding: 0 0rem !important;
        font-size: calc(0.875rem - 0.05rem) !important;
        font-weight: 300 !important;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand.brand-logo-mini img {
        width: calc(100%);
        max-width: 100%;
        height: 25px !important;
        margin: auto;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand img {
        width: calc(200px - 80px) !important;
        max-width: 100%;
        height: auto;
        margin: auto;
        vertical-align: middle;
    }

    .navbar .navbar-brand-wrapper .navbar-brand.brand-logo-mini img {
        width: calc(100%);
        max-width: 100%;
        height: 25px !important;
        margin: auto;
    }

    ::-webkit-scrollbar {
        background: black !important;
        height: 7px !important;
        width: 7px !important;
        /* Ajusta la altura aquí */
    }

    ::-webkit-scrollbar-thumb {
        background: #006de1 !important;
        border-radius: 10px !important;
    }

    /* NOTIFY */
    /* Estilo para el contador de notificaciones */
    .count {
        font-size: 12px;
        position: relative;
        top: -10px;
        left: 5px;
        padding: 2px 6px;
        border-radius: 50%;
    }

    /* Estilo para el botón "Mark as read" */
    .marcar-como-leido {
        text-align: center;
        margin: 10px 0;
    }

    /* Estilo para la lista de notificaciones (añade más estilos según sea necesario) */
    .preview-list {
        max-height: 300px;
        /* Altura máxima de la lista de notificaciones */
        overflow-y: auto;
        /* Agrega una barra de desplazamiento vertical si es necesario */
    }

    /* Estilo para cada elemento de notificación */
    .preview-item {
        display: flex;
        align-items: center;
        padding: 10px;
        transition: background-color 0.3s;
    }

    /* Estilo para el ícono de notificación */
    .preview-icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #22252A;
        /* Color de fondo del ícono */
    }

    /* Estilo para el texto de notificación */
    .preview-subject {
        font-weight: bold;
    }

    .navbar .navbar-menu-wrapper .count-indicator .count {
        position: absolute;
        left: 72% !important;
        width: 16px !important;
        height: 16px !important;
        color: #ffffff;
        border-radius: 100%;
        text-align: center;
        font-size: .625rem;
        line-height: 1.5;
        top: -3px;
    }

    .navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown {
        width: 17em !important;
    }

    .bg-success,
    .swal2-modal .swal2-buttonswrapper .swal2-styled.swal2-confirm {
        --bs-bg-opacity: 1;
        background-color: #00d25b !important;
    }

    .sidebar .nav .nav-item.profile .profile-desc .profile-pic .count-indicator .count {
        position: absolute;
        left: 66%;
        width: 10px !important;
        height: 15px !important;
        color: #ffffff;
        border-radius: 100% !important;
        text-align: center;
        font-size: .625rem;
        line-height: 1.5;
        top: 26px;
        border: 2px solid #000000 !important;
    }

    /* Estilo para la imagen del vendedor */
    /* Estilo para el contenedor principal con flexbox */
    .profile-pic2 img {
        width: 67px;
        height: 67px;
        margin-right: 10px;
        display: inline-block;
    }

    .profile-container2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Centra horizontalmente */
        text-align: center;
        /* Alinea el contenido horizontalmente */
    }

    /* Estilo para la imagen del vendedor */
    .profile-pic2 {
        margin-bottom: 10px;
        /* Espacio entre la imagen y el nombre */
    }

    /* Estilo para el nombre del vendedor */
    .profile-name2 {
        margin-bottom: 10px;
        /* Espacio entre el nombre y el botón */
    }

    /* Estilo para el botón */
    .profile-button2 {
        margin-top: 10px;
        /* Espacio entre el nombre y el botón */
    }

    /* Estilo para el contenedor del nombre del vendedor */
    .profile-name2 {
        text-align: center;
        /* Alinea el nombre del vendedor en el centro */
        margin-bottom: 10px;
        /* Ajusta este valor según tu preferencia para el espacio entre el nombre y el botón */
    }

    .profile-button2 {
        text-align: center;
        margin-top: 10px;
        /* Ajusta este valor según tu preferencia para el espacio entre el nombre y el botón */
    }

    .row2 {
        display: flex;
        justify-content: center;
        /* Centra los elementos horizontalmente */
        align-items: center;
        /* Centra los elementos verticalmente */
    }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0"> </div>
        </div>
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo"><img src="../../../assets/img/logo.png" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini"><img src="../../../assets/img/logo.png" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator"> <img class="img-xs rounded-circle "
                                    src="../../../assets/img/staff/user.png" alt=""> <span
                                    class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">
                                    <?php echo ucfirst($username); ?>
                                </h5>
                                <?php
                                function truncateTextWithEllipsis($text, $maxCaracteres)
                                {
                                    if (strlen($text) > $maxCaracteres) {
                                        $text = substr($text, 0, $maxCaracteres) . "...";
                                    }
                                    return $text;
                                }
                                ?>
                                <span>
                                    <?php echo truncateTextWithEllipsis($subscription, 22); ?>
                                </span>
                            </div>
                        </div>
                <li class="nav-item nav-category"> <span class="nav-link">Home</span> </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../home"> <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span> <span class="menu-title">Dashboard</span> </a>
                <li class="nav-item nav-category"> <span class="nav-link">Products</span> </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../pages/download"> <span class="menu-icon">
                            <i class="mdi mdi-download"></i>
                        </span> <span class="menu-title">Download</span> </a>
                </li>
                <li class="nav-item menu-items active">
                    <a class="nav-link" href="../pages/support"> <span class="menu-icon">
                            <i class="mdi mdi-account-circle"></i>
                        </span> <span class="menu-title">Support</span> </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../pages/changelog"> <span class="menu-icon">
                            <i class="mdi mdi-book-minus"></i>
                        </span> <span class="menu-title">Change Log</span> </a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini"><img src="../../../assets/img/logo.png" alt="logo" /></a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize"> <span class="mdi mdi-menu"></span> </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item dropdown border-left">
                            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-bell"></i>
                                <span class="count bg-danger" id="badge">0</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="notificationDropdown">
                                <h6 class="p-3 mb-0">Notifications</h6>
                                <div class="dropdown-divider"></div>
                                <!-- Notification items will be added dynamically here -->
                                <div class="marcar-como-leido">
                                    <button class="btn btn-danger" onclick="marcarComoLeido()">Mark as read</button>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                <div class="navbar-profile"> <img class="img-xs rounded-circle"
                                        src="../../../assets/img/staff/user.png" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">
                                        <?php echo ucfirst($username); ?>
                                    </p> <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">Profile</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item preview-item" onclick="logout()">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-dark rounded-circle"> <i
                                                class="mdi mdi-logout text-danger"></i> </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <form method="POST" id="logout-form">
                                            <button class="btn btn-outline-custom me-0"
                                                style="padding-left: 0; width: 100%;">
                                                Log out
                                            </button>
                                            <input type="hidden" name="logout" value="true">
                                        </form>
                                    </div>
                                </a>

                                <script>
                                function logout() {
                                    // Limpia todo el caché relacionado con el sitio en el cliente
                                    localStorage.clear();

                                    // Envía la solicitud de logout
                                    document.getElementById('logout-form').submit();
                                }
                                </script>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas"> <span class="mdi mdi-format-line-spacing"></span> </button>
                </div>
            </nav>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> GLOBAL X</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard/home"
                                        style="color: #0d6efd !important;">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Support</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <!-- Contenedor para el personal de soporte -->
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Staff</h4>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/ramon.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX RAMON</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1160741476670636103" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/lilgael.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX LIL GAEL</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1119290950016053309" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor para el personal de soporte -->
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Active support</h4>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/jishu.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX JISHU</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/410865579050795021" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/chinx.png" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX CHINX</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/746146746262093876" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/bryan.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX BRYAN</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/936802494066085949" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contenedor para los vendedores oficiales -->
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Official vendors</h4>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/ramon.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX RAMON</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1160741476670636103" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/lilgael.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX LIL GAEL</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1119290950016053309" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/julietta.png" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX JULIETTA</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1071848582199644170" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/gxann.png" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX JXANN</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1129990762801659984" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/perro.gif" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX PERRO</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1041037881399058462" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle"
                                                    src="../../assets/img/staff/daant.png" alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX DAANT</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/1116413480220758179" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle" src="../../assets/img/staff/ding.png"
                                                    alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX DING</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/571591079623786497" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <!-- Agrega aquí el código para los vendedores oficiales -->
                                        <div class="profile-container2">
                                            <div class="profile-pic2">
                                                <img class="img-xs rounded-circle" src="../../assets/img/staff/jgo.gif"
                                                    alt="">
                                            </div>
                                            <div class="profile-name2">
                                                <h5 class="mb-0 font-weight-normal">GX JGO-YT</h5>
                                            </div>
                                            <div class="profile-button2">
                                                <a href="https://discord.com/users/429214017387626496" target="_blank"
                                                    class="btn btn-block btn-success btn-rad btn-lg">
                                                    <i class="fas fa-envelope fa-sm text-white-50"></i> Contactar
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Agrega más vendedores oficiales aquí si es necesario -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span style="user-select: none; pointer-events: none;">&nbsp;</span>
                    <footer class="footer">
                        <span style="user-select: none; pointer-events: none;">&nbsp;</span>
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright
                                <?php echo date("Y"); ?>
                                GLOBAL X | Created with ❤ by <a href="https://discord.com/users/959935214895890532"
                                    target="_blank"><span>Zarfala</span></a>
                            </span>
                        </div>
                    </footer>
                </div>
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- JS -->
    <script src="../../assets/js/alert.js?v=1.2"></script>
    <script src="../../assets/js/mics.js"></script>
    <script src="../../assets/js/chat.js"></script>
    <script>
    var isadb = true;
    var tryCount = 0;
    var minimalUserResponseInMiliseconds = 200;

    function check() {
        console.clear();

        mostrarMensaje();

        let before = new Date().getTime();
        debugger;
        let after = new Date().getTime();

        if (after - before > minimalUserResponseInMiliseconds) {
            location.reload(true);
        }

        setTimeout(check, 100);
    }


    function disabledEvent(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        } else if (window.event) {
            window.event.cancelBubble = true;
        }

        e.preventDefault();
        return false;
    }

    window.onload = function() {
        document.addEventListener(
            "contextmenu",
            function(e) {
                e.preventDefault();
            },
            false
        );

        document.addEventListener(
            "keydown",
            function(e) {
                if (
                    (e.ctrlKey && e.shiftKey && e.keyCode === 73) ||
                    (e.ctrlKey && e.shiftKey && e.keyCode === 74) ||
                    (e.keyCode === 83 &&
                        (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) ||
                    (e.ctrlKey && e.keyCode === 85) ||
                    e.keyCode === 123
                ) {
                    disabledEvent(e);
                }
            },
            false
        );
    };

    check();
    </script>

    <script>
    if (document.addEventListener) {
        document.addEventListener("DOMContentLoaded", function() {
            loaded();
        });
    } else if (document.attachEvent) {
        document.attachEvent("onreadystatechange", function() {
            loaded();
        });
    }

    function loaded() {
        setInterval(loop, 300);
    }

    var x = 0;
    var writing = true;
    var titleText = [
        "GLOBAL X",
    ];
    var titleElement = document.getElementsByTagName("title")[0];

    function loop() {
        if (writing) {
            titleElement.innerHTML = "Support | " + titleText[0].substring(0, x);
        } else {
            titleElement.innerHTML = "Support | " + titleText[0].substring(0, x);
        }

        if (writing) {
            x++;
            if (x === titleText[0].length) {
                writing = false;
            }
        } else {
            x--;
            if (x === 0) {
                writing = true;
            }
        }
    }
    </script>

    <!-- JavaScript para las notificaciones -->
    <script>
    // Array para almacenar notificaciones
    var notificaciones = [];

    // Función para agregar una nueva notificación
    function agregarNotificacion(titulo, mensaje) {
        var notificationsList = document.querySelector('.dropdown-menu.preview-list');

        // Crea un nuevo elemento de notificación
        var notificacionElement = document.createElement('a');
        notificacionElement.className = 'dropdown-item preview-item';
        notificacionElement.innerHTML = `
                <div class="preview-thumbnail">
            <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-bell-ring text-danger"></i>
            </div>
        </div>
        <div class="preview-item-content">
            <p class="preview-subject mb-1">${titulo}</p>
            <p class="text-muted ellipsis mb-0">${mensaje}</p>
        </div>
    `;

        // Agrega una línea divisoria antes de agregar la notificación
        var divider = document.createElement('div');
        divider.className = 'dropdown-divider';
        notificationsList.appendChild(divider);

        // Agrega la notificación a la lista
        notificationsList.appendChild(notificacionElement);

        // Agrega la notificación al array
        notificaciones.push({
            titulo: titulo,
            mensaje: mensaje
        });

        // Incrementa el contador de notificaciones
        actualizarContador();
    }

    // Función para marcar todas las notificaciones como leídas
    function marcarComoLeido() {
        localStorage.setItem('notificacionesLeidas', 'true');
        actualizarContador();
    }

    // Función para actualizar el contador de notificaciones
    function actualizarContador() {
        var badge = document.querySelector('.count.bg-danger');
        var notificacionesLeidas = localStorage.getItem('notificacionesLeidas');
        if (notificacionesLeidas === 'true') {
            badge.textContent = '0';
            badge.style.display = 'none';
        } else {
            badge.textContent = notificaciones.length.toString(); // Mostramos el número de notificaciones
        }
    }

    // Verifica el estado de notificaciones almacenado en caché al cargar la página
    window.onload = function() {
        actualizarContador();
        // Simulación de notificaciones (puedes agregar más aquí)
        agregarNotificacion('New update', 'Panel GLOBAL X <?php echo $version; ?> ');
        agregarNotificacion('Bypass', 'Coming soon');
        // Agrega más notificaciones simuladas si es necesario
    };
    </script>

    <script>
    function disableTextSelect(event) {
        event.preventDefault();
    }

    document.addEventListener("selectstart", disableTextSelect);
    document.addEventListener("mousedown", disableTextSelect);
    </script>
    <script>
    window.intercomSettings = {
        api_base: "https://api-iam.intercom.io",
        app_id: "tt20tttm"
    };
    </script>
    <script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/tt20tttm'
    (function() {
        var w = window;
        var ic = w.Intercom;
        if (typeof ic === "function") {
            ic('reattach_activator');
            ic('update', w.intercomSettings);
        } else {
            var d = document;
            var i = function() {
                i.c(arguments);
            };
            i.q = [];
            i.c = function(args) {
                i.q.push(args);
            };
            w.Intercom = i;
            var l = function() {
                var s = d.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://widget.intercom.io/widget/tt20tttm';
                var x = d.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            };
            if (document.readyState === 'complete') {
                l();
            } else if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();
    </script>

    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
</body>

</html>