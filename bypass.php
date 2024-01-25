<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PANEL GLOBAL X | BYPASS</title>
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
                    <li><a class="smooth-scroll active" href="productos">Productos</a></li>
                    <li><a class="smooth-scroll" href="vendedores">Vendedores</a></li>
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
                    <li><a class="smooth-scroll active" href="productos">Productos</a></li>
                    <li><a class="smooth-scroll" href="vendedores">Vendedores</a></li>
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
        <div class="sellers despc">
            <div class="title">
                <h1>Bypass <span class="colors_text">Para</span> Pc</h1>
            </div>
            <div class="descrip">
                <p>Actualmente Global X cuenta con un Bypass unico e indetectable sin bajones de FPS ni limite de racha.
                </p>
            </div>
            <div class="forpc">
                <div class="forpc__panel">
                    <h2>Bypass <span class="colors_text">Para</span> Pc</h2>
                    <p>Actualmente cuenta estas siguientes opciones:</p>
                    <ul>
                        <li><i class="fas fa-check-circle"></i>Bypass Emulador</li>
                        <li><i class="fas fa-check-circle"></i>Bypass Security</li>
                        <li><i class="fas fa-check-circle"></i>Reduce Risk 1</li>
                        <li><i class="fas fa-check-circle"></i>Reduce Risk 2</li>
                        <li><i class="fas fa-check-circle"></i>Block Internet</li>
                    </ul>
                </div>
                <div class="forpc__images">
                    <div class="equipo__images">
                        <div class="equipo__discord__card">
                            <div class="discord__card__image">
                                <img src="img/bypass/rank.png" alt="foto_panel">
                            </div>
                            <div class="discord__card__image">
                                <img src="img/bypass/settings.png" alt="foto_panel">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pricepanel pricepanel--modifiquer">
                <div class="pricebypass__group">
                    <span href="vendedores" class="forlife">
                        <h3>Semanal</h3>
                        <p><span>S/</span>25 - 7<span>USD</span></p>
                    </span>
                </div>
                <div class="pricebypass__group">
                    <span href="vendedores" class="forlife">
                        <h3>MENSUAL</h3>
                        <p><span>S/</span>60 - 18<span>USD</span></p>
                    </span>
                </div>
                <div class="pricebypass__group">
                    <span href="vendedores" class="forlife">
                        <h3>PERMANENTE</h3>
                        <p><span>S/</span>90 - 25<span>USD</span></p>
                    </span>
                </div>
            </div>
            <div class="botton_compra">
                <a class="btn__button" href="https://wa.link/zip6b4">COMPRA AQUI</a>
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