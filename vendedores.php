<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PANEL GLOBAL X | VENDEDORES</title>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/main.css?v=1.5">
    <link rel="icon" href="img/favicon.png" type="image/ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="js/slick-1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="js/slick-1.8.1/slick/slick-theme.css" />
</head>

<body onclick="PlayAudio()">
    <section class="main fadeIn">
        <div class="nav">
            <div class="logo">
                <a href="/"><img src="img/logo.png" alt="" style="width: 200px;"></a>
            </div>
            <div class="link">
                <ul>
                    <li><a class="smooth-scroll" href="/">Nosotros</a></li>
                    <li><a class="smooth-scroll" href="productos">Productos</a></li>
                    <li><a class="smooth-scroll active" href="vendedores">Vendedores</a></li>
                    <li><a class="smooth-scroll" href="auth/login" style="
                        background-color: #292c327d;
                        border: none;
                        color: white;
                        padding: 10px 32px;
                        cursor: pointer;
                        border-radius: 12px;
                        width: 100%;
                    ">Login Client</a></li>
                </ul>
            </div>
            <div class="hamburger">
                <div class="_layer -top"></div>
                <div class="_layer -mid"></div>
                <div class="_layer -bottom"></div>
            </div>
            <nav class="menuppal">
                <ul>
                    <li><a class="smooth-scroll" href="/">Nosotros</a></li>
                    <li><a class="smooth-scroll" href="productos">Productos</a></li>
                    <li><a class="smooth-scroll active" href="vendedores">Vendedores</a></li>
                    <li><a class="smooth-scroll" href="auth/login" style="
                        background-color: #292c327d;
                        border: none;
                        color: white;
                        padding: 10px 32px;
                        cursor: pointer;
                        border-radius: 12px;
                        width: 100%;
                    ">Login Client</a></li>
                </ul>
            </nav>
        </div>
        <div class="sellers vendedor">
            <div class="title">
                <h1>Ven<span>dedo</span>res</h1>
            </div>
            <div class="descrip">
                <p>Si estas interesado en adquirir nuestro producto comunicate con uno de nuestros vendedores</p>
            </div>
            <div class="wsp__group">
                <div class="wsp__button">
                    <a href="https://w.app/JuliettaQueen" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedora Julietta</a>
                </div>
                <div class="wsp__button">
                    <a href="https://w.app/JGOYTVentas" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor JGO-YT</a>
                </div>
                <div class="wsp__button">
                    <a href="https://w.app/DaanVentas" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor Daan</a>
                </div>
                <div class="wsp__button">
                    <a href="https://w.app/LilGaelBoss" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor Lil Gael</a>
                </div>
                <div class="wsp__button">
                    <a href="https://w.app/JxannVentas" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor JXANN</a>
                </div>
                <div class="wsp__button">
                    <a href="https://w.app/PerroVentas" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor Perro</a>
                </div>
                <div class="wsp__button">
                    <a href="https://w.app/DingVentas" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor Ding</a>
                </div>
                <div class="wsp__button">
                    <a href="https://wa.link/zip6b4" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Vendedor Ramon</a>
                </div>
            </div>
        </div>
        <footer>
            <div class="by">
                <p>&copy; 2023 PANEL GLOBAL X</p>
            </div>
        </footer>
        <div class="te">
            <audio id="musica" loop>
                <source src="music/music.ogg" type="audio/ogg">
            </audio>
        </div>
    </section>
    <div id="particles-js"></div>

    <script src="js/particles.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/alert.js"></script>
    <script src="js/particlesjs-config.json?v=1.1"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/slick-1.8.1/slick/slick.min.js"></script>
    <script>
    function PlayAudio() {
        document.getElementById("musica").play();
    }

    window.onload = function() {
        document.getElementById("musica").play();
    }

    const audioElement = document.getElementById("musica");

    audioElement.volume = 0.1;

    $(".equipo__discord__card").slick({
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
    });

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
</body>

</html>