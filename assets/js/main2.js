// Login
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const usernameInputLogin = loginForm.querySelector('input[name="username"]');
    const passwordInputLogin = loginForm.querySelector('input[name="password"]');
    const loginButton = loginForm.querySelector('button[name="login"]');
    const recaptchaLogin = loginForm.querySelector('.g-recaptcha');
    const errorTextCaptchaLogin = loginForm.querySelector('.error_text_captcha');

    loginForm.addEventListener('input', function () {
        const username = usernameInputLogin.value.trim();
        const password = passwordInputLogin.value.trim();

        if (username !== '' && password !== '') {
            loginButton.removeAttribute('disabled');
            loginButton.classList.remove('hangarButton-disabled');
        } else {
            loginButton.setAttribute('disabled', 'disabled');
            loginButton.classList.add('hangarButton-disabled');
        }
    });

    loginForm.addEventListener('submit', function (event) {
        if (typeof grecaptcha !== 'undefined') {
            const recaptchaResponse = grecaptcha.getResponse();
            const username = usernameInputLogin.value.trim();
            const password = passwordInputLogin.value.trim();

            if (username === '' || password === '' || recaptchaResponse === '') {
                event.preventDefault();
                errorTextCaptchaLogin.style.display = 'block';
                errorTextCaptchaLogin.textContent = 'Please complete the reCAPTCHA.';
            }
        }
    });
});

// Register
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('register-form');
    const usernameInput = registerForm.querySelector('input[name="username"]');
    const licenseInput = registerForm.querySelector('input[name="license"]');
    const registerButton = registerForm.querySelector(
        '#hangar-submit'); // Cambiado de getElementById a querySelector
    const recaptcha = registerForm.querySelector('.g-recaptcha');
    const errorTextCaptcha = registerForm.querySelector('.error_text_captcha');

    registerForm.addEventListener('input', function () {
        const username = usernameInput.value.trim();
        const license = licenseInput.value.trim();

        if (username !== '' && license !== '') {
            registerButton.removeAttribute('disabled');
            registerButton.classList.remove('hangarButton-disabled');
        } else {
            registerButton.setAttribute('disabled', 'disabled');
            registerButton.classList.add('hangarButton-disabled');
        }
    });

    registerForm.addEventListener('submit', function (event) {
        const recaptchaResponse = grecaptcha.getResponse();
        const username = usernameInput.value.trim();
        const license = licenseInput.value.trim();

        if (username === '' || license === '' || recaptchaResponse === '') {
            event.preventDefault();
            errorTextCaptcha.style.display = 'block';
            errorTextCaptcha.textContent =
                'Please complete the reCAPTCHA.';
        }
    });
});

// Upgrade
document.addEventListener('DOMContentLoaded', function () {
    const upgradeForm = document.getElementById('upgrade-form');
    const usernameInput = upgradeForm.querySelector('input[name="username"]');
    const licenseInput = upgradeForm.querySelector('input[name="license"]');
    const upgradeButton = upgradeForm.querySelector('#hangar-submit');
    const recaptcha = upgradeForm.querySelector('.g-recaptcha');
    const errorTextCaptcha = upgradeForm.querySelector('.error_text_captcha');

    upgradeForm.addEventListener('input', function () {
        const username = usernameInput.value.trim();
        const license = licenseInput.value.trim();

        if (username !== '' && license !== '') {
            upgradeButton.removeAttribute('disabled');
            upgradeButton.classList.remove('hangarButton-disabled');
        } else {
            upgradeButton.setAttribute('disabled', 'disabled');
            upgradeButton.classList.add('hangarButton-disabled');
        }
    });

    upgradeForm.addEventListener('submit', function (event) {
        const recaptchaResponse = grecaptcha.getResponse();
        const username = usernameInput.value.trim();
        const license = licenseInput.value.trim();

        if (username === '' || license === '' || recaptchaResponse === '') {
            event.preventDefault();
            errorTextCaptcha.style.display = 'block';
            errorTextCaptcha.textContent = 'Please complete the reCAPTCHA.';
        }
    });
});