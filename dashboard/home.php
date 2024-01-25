<?php
error_reporting(0);

include '../assets/auth/credentials.php';
require '../assets/auth/keyauth.php';

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
    <title>Home | GLOBAL X</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/other.css?v=1.2">
    <link rel="stylesheet" href="assets/css/discordv2.css?v=1.1">
    <link rel="shortcut icon" href="../assets/img/favicon.png?v=1.1" />
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
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0"> </div>
        </div>
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a class="sidebar-brand brand-logo"><img src="../assets/img/logo.png" alt="logo" /></a>
                <a class="sidebar-brand brand-logo-mini"><img src="../assets/img/logo.png" alt="logo" /></a>
            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator"> <img class="img-xs rounded-circle "
                                    src="../assets/img/staff/user.png" alt=""> <span class="count bg-success"></span>
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
                <li class="nav-item menu-items active">
                    <a class="nav-link" href="/home"> <span class="menu-icon">
                            <i class="mdi mdi-speedometer"></i>
                        </span> <span class="menu-title">Dashboard</span> </a>
                <li class="nav-item nav-category"> <span class="nav-link">Products</span> </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../../dashboard/pages/download"> <span class="menu-icon">
                            <i class="mdi mdi-download"></i>
                        </span> <span class="menu-title">Download</span> </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../../dashboard/pages/support"> <span class="menu-icon">
                            <i class="mdi mdi-account-circle"></i>
                        </span> <span class="menu-title">Support</span> </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../../dashboard/pages/changelog"> <span class="menu-icon">
                            <i class="mdi mdi-book-minus"></i>
                        </span> <span class="menu-title">Change Log</span> </a>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini"><img src="../assets/img/logo.png" alt="logo" /></a>
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
                                        src="../assets/img/staff/user.png" alt="">
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
                    <script type='text/javascript' id='flatnews-main-js-extra'>
                    var flatnews = {};
                    </script>
                    <script type='text/javascript' src='js/main.min.js?ver=5.1' id='flatnews-main-js'></script>
                    <div class="fn-header-row fn-header-row-break">
                        <div class="fn-header-row-inner">
                            <div class="fn-break">
                                <div class="fn-break-inner">
                                    <h2>NOTICES <i class="fa fa-flash"></i></h2>
                                    <div class="fn-break-gradient left"></div>
                                    <div class="fn-break-content">
                                        <ul>
                                            <li class="item item-0"><span
                                                    class="item-categories"><a>IMPOARTANT</a></span>
                                                <h3 class="item-title"><a href="./pages/download"><span> WITH THE RESET
                                                            IMEI PROGRAM ERASE YOUR EMULATOR TO AVOID BLACK LIST
                                                        </span> <span class="text-success">(Click here)</span><span>
                                                            TO DOWNLOAD</span>
                                                    </a></h3>
                                            </li>
                                            <li class="item item-1"><span class="item-categories"><a>NEW
                                                        UPDATE</a></span>
                                                <h3 class="item-title"><a href="./pages/download"><span> NEW VERSION OF
                                                            THE PANEL
                                                            <?php echo $version; ?> AVAILABLE
                                                        </span>
                                                        <span class="text-success">(Click here)</span><span>
                                                            TO DOWNLOAD</span>
                                                    </a></h3>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="fn-break-gradient right"></div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <span style="user-select: none; pointer-events: none;">&nbsp;</span>
                    <div class="row">
                        <div class="col-sm-4 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Estatus</h5>
                                    <div class="row">
                                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                            <style>
                                            .pulse-container {
                                                position: relative;
                                                margin-left: 5px;
                                            }

                                            .pulse-container .pulse-circle {
                                                position: absolute;
                                                top: -10px;
                                                right: -5px;
                                                width: 7px;
                                                height: 7px;
                                                border-radius: 50%;
                                                background-color:
                                                    <?php echo $circleColor;
                                                ?>;
                                                opacity: 1;
                                                animation: pulse 2s infinite;
                                            }

                                            @keyframes pulse {
                                                0% {
                                                    transform: scale(0.5);
                                                    opacity: 0.5;
                                                }

                                                50% {
                                                    transform: scale(1);
                                                    opacity: 1;
                                                }

                                                100% {
                                                    transform: scale(0.5);
                                                    opacity: 0.5;
                                                }
                                            }
                                            </style>
                                            <div class="d-flex align-items-center">
                                                <h2 class="mb-0">
                                                    <?php echo $status; ?>
                                                </h2>
                                                <div class="pulse-container">
                                                    <div class="pulse-circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right"> <i
                                                class="icon-lg mdi mdi-signal text-primary ms-auto"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Expire</h5>
                                    <div class="row">
                                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                <h3 class="mb-0">
                                                    <script>
                                                    var expiryTimestamp = <?php echo $expiry; ?>;
                                                    var expiryDate = new Date(expiryTimestamp * 1000);
                                                    var formattedExpiry = expiryDate.toLocaleString('en-US', {
                                                        year: 'numeric',
                                                        month: '2-digit',
                                                        day: '2-digit',
                                                        hour: 'numeric',
                                                        minute: 'numeric',
                                                        hour12: true
                                                    });

                                                    document.write(formattedExpiry);
                                                    </script>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right"> <i
                                                class="icon-lg mdi mdi-calendar text-danger ms-auto"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Last login</h5>
                                    <div class="row">
                                        <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                            <div class="d-flex d-sm-block d-md-flex align-items-center">
                                                <h3 class="mb-0">
                                                    <script>
                                                    var lastLoginTimestamp = <?php echo $lastLogin; ?>;
                                                    var lastLoginDate = new Date(lastLoginTimestamp * 1000);
                                                    var formattedLastLogin = lastLoginDate.toLocaleString('en-US', {
                                                        year: 'numeric',
                                                        month: '2-digit',
                                                        day: '2-digit',
                                                        hour: 'numeric',
                                                        minute: 'numeric',
                                                        hour12: true
                                                    });

                                                    document.write(formattedLastLogin);
                                                    </script>
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right"> <i
                                                class="icon-lg mdi mdi-account text-success ms-auto"></i> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Status</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                            </label>
                                                        </div>
                                                    </th>
                                                    <th> Client Name </th>
                                                    <th> IP </th>
                                                    <th> Product </th>
                                                    <th> Date </th>
                                                    <th> Payment method </th>
                                                    <th> Payment Status </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check form-check-muted m-0">
                                                            <label class="form-check-label">
                                                                <input type="checkbox" class="form-check-input">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td> <img src="../assets/img/staff/user.png" alt="image" /> <span
                                                            class="ps-2">
                                                            <?php echo ucfirst($username); ?>
                                                        </span> </td>
                                                    <td>
                                                        <span id="hiddenIP" style="cursor: pointer;"
                                                            onclick="toggleIP('<?php echo $ip; ?>')">Show IP</span>
                                                    </td>

                                                    <script>
                                                    var ipVisible = false;

                                                    function toggleIP(ip) {
                                                        var hiddenIPElement = document.getElementById('hiddenIP');

                                                        if (ipVisible) {
                                                            hiddenIPElement.innerHTML = 'Show IP';
                                                        } else {
                                                            hiddenIPElement.innerHTML = ip;
                                                        }

                                                        ipVisible = !ipVisible;
                                                    }
                                                    </script>

                                                    <td>
                                                        <?php echo $subscription; ?>
                                                    </td>
                                                    <td>
                                                        <script>
                                                        var createDateTimestamp = <?php echo $createdate; ?>;
                                                        var createDate = new Date(createDateTimestamp * 1000);
                                                        var formattedCreateDate = createDate.toLocaleString(
                                                            'en-US', {
                                                                year: 'numeric',
                                                                month: '2-digit',
                                                                day: '2-digit',
                                                                hour: 'numeric',
                                                                minute: 'numeric',
                                                                hour12: true
                                                            });

                                                        document.write(formattedCreateDate);
                                                        </script>
                                                    </td>
                                                    <td>
                                                        <i class="fab fa-paypal fa-lg"></i>
                                                        <span class="paypal-text">PayPal</span>
                                                    </td>
                                                    <style>
                                                    .paypal-text {
                                                        margin-left: 5px;
                                                        /* Ajusta el valor según el espacio deseado */
                                                    }
                                                    </style>
                                                    <td>
                                                        <div class="badge badge-outline-success">Approved</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Status</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Game</th>
                                                    <th>Version</th>
                                                    <th>Last Update</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td> <img
                                                            src="https://obbdownload.com/wp-content/uploads/2023/09/garena-free-fire.png"
                                                            alt="image" /> <span class="ps-2">
                                                            Free Fire
                                                        </span> </td>

                                                    <td>
                                                        1.102.1
                                                    </td>
                                                    <td>
                                                        Updated on, October 30, 2023
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-outline-success"><i class="fa fa-check"
                                                                aria-hidden="true"></i> <span
                                                                class="paypal-text">Updated</span></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td> <img
                                                            src="../assets/img/logopanel.png"
                                                            alt="image" /> <span class="ps-2">
                                                            GLOBAL X Panel
                                                        </span> </td>

                                                    <td>
                                                        <?php echo $version; ?>
                                                    </td>
                                                    <td>
                                                        Updated on, November 1, 2023
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-outline-success"><i class="fa fa-check"
                                                                aria-hidden="true"></i> <span
                                                                class="paypal-text">Updated</span></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!-- <tbody>
                                                <tr>
                                                    <td> <img
                                                            src="https://cdn.discordapp.com/attachments/966140909580345434/1155281555011407943/a_6af341c7552541204d1612e0808ee0ec.gif"
                                                            alt="image" /> <span class="ps-2">
                                                            GLOBAL X Bypass
                                                        </span> </td>

                                                    <td>
                                                        3.0
                                                    </td>
                                                    <td>
                                                        Updated on, Saturday, September 26, 2023
                                                    </td>
                                                    <td>
                                                        <div class="badge badge-outline-danger"><i class="fa fa-times"
                                                                aria-hidden="true"></i> <span
                                                                class="paypal-text">Outdated</span></div>
                                                    </td>
                                                </tr>
                                            </tbody> -->
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="preview-list">
                                        <h4 class="card-title">Reset HWID 1 per week</h4>
                                        <!-- <h4 class="card-title">Available 1 time every 14 days</h4> -->
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <h5 class="title text-center"><strong>Reset your HWID?</strong></h5>
                                        <?php
                                        $un = $_SESSION['un'];
                                        $url = "https://keyauth.win/api/seller/?sellerkey={$SellerKey}&type=userdata&user={$un}";

                                        $curl = curl_init($url);
                                        curl_setopt($curl, CURLOPT_URL, $url);
                                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                                        $resp = curl_exec($curl);
                                        $json = json_decode($resp);
                                        $cooldown = $json->cooldown;
                                        $token = $json->token;
                                        $today = time();

                                        if (is_null($cooldown)) {
                                            echo '<form method="post">';
                                        } else {
                                            if ($today > $cooldown) {
                                                echo '<form method="post">';
                                            } else {
                                                // Muestra la fecha de reinicio con el mismo diseño que el código antiguo
                                                echo '<p class="text-center">Your reset will only be available in: <span class="badge badge-danger"><script>
                                                var cooldownTimestamp = ' . $cooldown . ';
                                                var cooldownDate = new Date(cooldownTimestamp * 1000);
                                                var formattedCooldown = cooldownDate.toLocaleString("en-US", {
                                                    year: "numeric",
                                                    month: "2-digit",
                                                    day: "2-digit",
                                                    hour: "numeric",
                                                    minute: "numeric",
                                                    hour12: true
                                                });

                                                document.write(formattedCooldown);
                                                </script></span></p>';
                                            }
                                        }
                                        ?>
                                        <hr>
                                        <div class="form-group">
                                            <input type="hidden" id="reset" name="reset" value="ok">
                                        </div>
                                        <p class="spacer text-center">Do you have a problem?<a
                                                href="https://discord.gg/panelglobalx"> Contact
                                                Support</a>.</p>
                                    </div>
                                    <?php
                                    $un = $_SESSION['un'];
                                    $url = "https://keyauth.win/api/seller/?sellerkey={$SellerKey}&type=userdata&user={$un}";

                                    $curl = curl_init($url);
                                    curl_setopt($curl, CURLOPT_URL, $url);
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

                                    $resp = curl_exec($curl);
                                    $json = json_decode($resp);
                                    $cooldown = $json->cooldown;
                                    $token = $json->token;
                                    $today = time();

                                    if (is_null($cooldown)) {
                                        echo '<form method="post">
                                            <center>
                                        <button disabled="disabled" class="btn btn-block btn-danger btn-rad btn-lg">
                                        <i class="fas fa-redo-alt fa-sm text-white-50"></i> Reset HWID
                                        </button>
                                    </center></form>';
                                    } else {
                                        if ($today > $cooldown) {
                                            echo '<form method="post">
                                                <center>
                                        <button disabled="disabled" class="btn btn-block btn-danger btn-rad btn-lg">
                                            <i class="fas fa-redo-alt fa-sm text-white-50"></i> Reset HWID
                                        </button>
                                        </center></form>';
                                        } else {

                                            echo '
                                    <center>
                                        <button disabled="disabled" class="btn btn-block btn-danger btn-rad btn-lg">
                                        <i class="fas fa-redo-alt fa-sm text-white-50"></i> Reset HWID
                                        </button>
                                    </center>';
                                        }
                                    }
                                    ?>
                                    <hr>
                                    <div class="content">
                                        <h5 class="title text-center">Contact your vendor or support to reset the HWID.
                                            <h5>
                                    </div>
                                </div>
                                <?php
                                if (isset($_POST['resethwid'])) {

                                    $today = time();

                                    $cooldown = $today + $appcooldown;
                                    $un = $_SESSION['un'];
                                    $url = "https://keyauth.win/api/seller/?sellerkey={$SellerKey}&type=resetuser&user={$un}";

                                    $curl = curl_init($url);
                                    curl_setopt($curl, CURLOPT_URL, $url);
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                    curl_exec($curl);

                                    $url = "https://keyauth.win/api/seller/?sellerkey={$SellerKey}&type=setcooldown&user={$un}&cooldown={$cooldown}";

                                    $curl = curl_init($url);
                                    curl_setopt($curl, CURLOPT_URL, $url);
                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                                    curl_exec($curl);

                                    echo '
                                                        <script type=\'text/javascript\'>
                                                        
                                                        const notyf = new Notyf();
                                                        notyf
                                                        .success({
                                                            message: \'Reset HWID!\',
                                                            duration: 3500,
                                                            dismissible: true
                                                        });                
                                                        
                                                        </script>
                                                        ';
                                    echo "<meta http-equiv='Refresh' Content='2;'>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">GLOBAL X PANEL</h4>
                                    <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel"
                                        id="owl-carousel-basic">
                                        <div class="item"> <img src="../assets/img/panel/security.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/panel/aimhacks.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/panel/magicbullet.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/panel/visuals.png" alt=""> </div>
                                        <div class="item"> <img src="../assets/img/panel/fixlag.png" alt=""> </div>
                                    </div>
                                    <div class="d-flex py-4">
                                        <div class="preview-list w-100">
                                            <div class="preview-item p-0">
                                                <div class="preview-thumbnail"> <img src="../assets/img/staff/ramon.gif"
                                                        class="rounded-circle" alt=""> </div>
                                                <div class="preview-item-content d-flex flex-grow">
                                                    <div class="flex-grow">
                                                        <div
                                                            class="d-flex d-md-block d-xl-flex justify-content-between">
                                                            <h6 class="preview-subject">gxramon</h6>
                                                        </div>
                                                        <p class="text-muted">The best panel is GLOBAL X.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card discord">
                                        <div class="discord-widget">
                                            <div class="discord-header">
                                                <div class="discord-logo"></div>
                                                <div id="members-count"></div>
                                            </div>
                                            <div class="discord-body">
                                                <div class="discord-list">
                                                    <div class="discord-list-status">
                                                        <div class="discord-list-label"></div>
                                                    </div>
                                                    <table id="members-list"></table>
                                                </div>
                                                <a
                                                    onclick="javascript:window.open(' https://discord.gg/panelglobalx ');">
                                                    <button class="discord-cta"></button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                    var xhReq = new XMLHttpRequest();
                                    xhReq.open("GET",
                                        "https://discord.com/api/guilds/1161323790144385106/widget.json",
                                        false);
                                    xhReq.send(null);
                                    var discordjson = JSON.parse(xhReq.responseText);
                                    if (discordjson != null) {
                                        function showMembersCount() {
                                            var membersCount = discordjson.presence_count;
                                            var countElem = (document.getElementById("members-count").innerHTML =
                                                membersCount + "<span class='member-label'> Online Users<span>");
                                        }

                                        function showMembers() {
                                            discordjson.members.reverse().forEach(function(members) {
                                                var td = document.createElement("td");
                                                var label = document.createElement("label");
                                                label.innerHTML = members.username;
                                                var img = document.createElement("img");
                                                img.src = members.avatar_url;
                                                var table = document.getElementById("members-list");
                                                var row = table.insertRow(0);
                                                var td1 = row.insertCell(0);
                                                var td2 = row.insertCell(1);
                                                td1.className = "member-avatar";
                                                td2.className = "member-name";
                                                td1.appendChild(img);
                                                td2.appendChild(label);
                                            });
                                        }
                                    }
                                    setTimeout(function() {
                                        showMembersCount();
                                        showMembers();
                                    }, 500);
                                    setTimeout(function() {
                                        document.getElementById("members-list").style.display = "block";
                                    }, 2000);
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span style="user-select: none; pointer-events: none;">&nbsp;</span>
                    <footer class="footer">
                        <span style="user-select: none; pointer-events: none;">&nbsp;</span>
                        <div class="d-sm-flex justify-content-center justify-content-sm-between"> <span
                                class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright
                                ©
                                <?php echo date("Y"); ?>
                                GLOBAL X | Created with ❤ by <a href="https://discord.com/users/959935214895890532"
                                    target="_blank"><span>Zarfala</span></a>
                            </span>
                        </div>
                    </footer>
                </div>
            </div>

            <!-- JS -->
            <script src="../assets/js/alert.js?v=1.2"></script>
            <script src="../assets/js/mics.js"></script>
            <script src="../assets/js/chat.js"></script>


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
                    titleElement.innerHTML = "Home | " + titleText[0].substring(0, x);
                } else {
                    titleElement.innerHTML = "Home | " + titleText[0].substring(0, x);
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

            <script src="assets/vendors/js/vendor.bundle.base.js"></script>
            <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
            <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
            <script src="assets/js/off-canvas.js"></script>
            <script src="assets/js/hoverable-collapse.js"></script>
            <script src="assets/js/misc.js"></script>
            <script src="assets/js/settings.js"></script>
            <script src="assets/js/todolist.js"></script>
            <script src="assets/js/dashboard.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/popper-js/dist/umd/popper.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/app.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/app.init.dark.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/app-style-switcher.js"></script>
            <script
                src="https://cdn.keyauth.uk/dashboard/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js">
            </script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/sparkline/sparkline.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/waves.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/sidebarmenu.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/feather.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/custom.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/chartist/dist/chartist.min.js"></script>
            <script
                src="https://cdn.keyauth.uk/dashboard/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js">
            </script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/c3/d3.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/c3/c3.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/libs/chart-js/dist/chart.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/pages/dashboards/dashboard1.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js">
            </script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
            <script src="https://cdn.keyauth.uk/dashboard/dist/js/pages/datatable/datatable-advanced.init.js">
            </script>
</body>

</html>