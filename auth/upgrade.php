<?php
error_reporting(0);

require '../assets/auth/credentials.php';
require '../assets/auth/keyauth.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['un'])) {
    header("Location: ../dashboard/home");
    exit();
}

$KeyAuthApp = new KeyAuth\api($name, $OwnerId, $version);

if (!isset($_SESSION['sessionid'])) {
    $KeyAuthApp->init();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Upgrade | GLOBAL X</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="../assets/img/favicon.png?v=1.2" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../assets/css/opensans-font.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/opensans-font.css">
    <link rel="stylesheet" href="../assets/css/style2.css?v=1.5">
    <link rel="stylesheet" href="../assets/css/notyf.min.css">
    <link rel="stylesheet" href="../assets/css/particle.css">

    <script type="text/javascript">
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body>
    <div id="particles-js"></div>
    <div id="page">
        <div class="hangar-auth">
            <div class="hangar-form">
                <img draggable="false" src="../assets/img/logo.png" alt="Login" class="hangar-logo">
                <h1 class="hangar-auth_title">
                    <i class="fad fa-user-plus"></i>
                    <span>Upgrade</span>
                </h1>
                <form class="hangar-fieldset2" method="post" id="upgrade-form">
                    <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="Username is required">
                        <label
                            class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined"
                            data-shrink="true">Username</label>
                        <div
                            class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                            <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                                <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                                    <i style="color:#7c7c81" class="fa fa-user-circle"></i>
                                </div>
                            </div>
                            <input autocomplete="off" aria-invalid="false" type="text" name="username"
                                class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart"
                                placeholder="Username">
                            <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                                <legend class="jss4 jss5"><span>Username</span></legend>
                            </fieldset>
                        </div>
                    </div>
                    <div class="hangarFormControl-root hangarTextField-root jss1" data-validate="License is required">
                        <label
                            class="hangarFormLabel-root hangarInputLabel-root hangarInputLabel-formControl hangarInputLabel-animated hangarInputLabel-shrink hangarInputLabel-outlined"
                            data-shrink="true">License</label>
                        <div
                            class="hangarInputBase-root hangarOutlinedInput-root hangarInputBase-formControl hangarInputBase-adornedStart hangarOutlinedInput-adornedStart">
                            <div class="hangarInputAdornment-root hangarInputAdornment-positionStart">
                                <div class="hangarSvgIcon-root" focusable="false" aria-hidden="true">
                                    <i style="color:#7c7c81" class="fa fa-key"></i>
                                </div>
                            </div>
                            <input autocomplete="off" aria-invalid="false" type="text" name="license"
                                class="hangarInputBase-input hangarOutlinedInput-input hangarInputBase-inputAdornedStart hangarOutlinedInput-inputAdornedStart"
                                placeholder="License">
                            <fieldset aria-hidden="true" class="jss2 hangarOutlinedInput-notchedOutline">
                                <legend class="jss4 jss5"><span>License</span></legend>
                            </fieldset>
                        </div>
                    </div>
                    <div class="hangarFormControl-root hangarTextField-root jss1">
                        <center>
                            <div class="g-recaptcha" data-sitekey="6Le5FZ8gAAAAAGHODfIsbAGmS4czstx2LOW-9Y9z"></div>
                            <p class="hangarFormHelperText-root hangarFormHelperText-contained hangar-error hangarFormHelperText-filled error_text_captcha"
                                style="text-align:center;display:none;"></p>
                        </center>
                    </div>
                    <button name="upgrade" id="hangar-submit"
                        class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary"
                        tabindex="-1" type="submit" disabled>Upgrade</button>
                    <span style="user-select: none; pointer-events: none;">&nbsp;</span>
                    <button name=""
                        class="hangarButtonBase-root hangarButton-root jss6 hangarButton-text hangarButton-textPrimary"
                        id="loginButton">
                        Login
                    </button>

                    <div class="flex-sb-m w-full p-t-3 p-b-24">
                        <div>
                        </div>
                    </div>
                </form>

                <p class="hangarFormHelperText-root hangarFormHelperText-contained hangar-error hangarFormHelperText-filled"
                    style="text-align:center;">All rights reserved to <a style="text-decoration:none;"
                        href="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']; ?>">GLOBAL X</a>
                    2022 - <span id="currentYear"></span></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.keyauth.win/dashboard/unixtolocal.js"></script>
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="../assets/js/particle.js"></script>
    <script src="../assets/js/font-awesome.js"></script>
    <script src="../assets/js/alert.js?v=1.2"></script>
    <script src="../assets/js/main2.js"></script>
    <script src="../assets/js/notyf.min.js"></script>

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
            titleElement.innerHTML = "Upgrade | " + titleText[0].substring(0, x);
        } else {
            titleElement.innerHTML = "Upgrade | " + titleText[0].substring(0, x);
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

    <script>
    window.addEventListener('load', function() {
        const body = document.querySelector('body');
        body.classList.remove('fade-in');
    });

    document.getElementById("loginButton").addEventListener("click", function(event) {
        event.preventDefault();

        window.location.href = "/auth/login";
    });

    var currentYear = new Date().getFullYear();
    document.getElementById("currentYear").innerHTML = currentYear;
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const upgradeForm = document.getElementById('upgrade-form');
        const usernameInput = document.querySelector('input[name="username"]');
        const licenseInput = document.querySelector('input[name="license"]');
        const recaptchaResponse = grecaptcha.getResponse();
        const upgradeButton = document.getElementById('hangar-submit');
        const errorTextCaptcha = document.querySelector('.error_text_captcha');

        function validateForm() {
            const username = usernameInput.value.trim();
            const license = licenseInput.value.trim();

            if (username !== '' && license !== '' && recaptchaResponse !== '') {
                upgradeButton.disabled = false;
                upgradeButton.classList.remove('hangarButton-disabled');
            } else {
                upgradeButton.disabled = true;
                upgradeButton.classList.add('hangarButton-disabled');
            }
        }

        upgradeForm.addEventListener('input', validateForm);

        upgradeForm.addEventListener('submit', function(event) {
            validateForm();

            if (upgradeButton.disabled) {
                event.preventDefault();
                errorTextCaptcha.style.display = 'block';
                errorTextCaptcha.textContent =
                    'Por favor, completa todos los campos requeridos y el reCAPTCHA.';
            }
        });
    });
    </script>

    <?php
    if (isset($_POST['upgrade'])) {
        if ($KeyAuthApp->upgrade($_POST['username'], $_POST['license'])) {
            // don't login, upgrade function is not for authentication, it's simply for redeeming keys
            echo '
                        <script type=\'text/javascript\'>
                        
                        const notyf = new Notyf();
                        notyf
                          .success({
                            message: \'Upgraded Successfully! Now login please.\',
                            duration: 3500,
                            dismissible: true
                          });                
                        
                        </script>
                        ';
        }
    }
    ?>
</body>

</html>