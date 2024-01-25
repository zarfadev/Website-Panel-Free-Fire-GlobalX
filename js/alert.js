var estiloConsola = `
font-size: 16px;
font-family: "Courier New", monospace;
color: #006de1;
white-space: pre;
`;

var mensajeAutor = `
*******************************************
*           © Copyright 2023              *
*         RAMON / GLOBAL X, Inc.          *
*          All rights reserved.           *
*******************************************
`;

function mostrarMensaje() {
  console.clear();
  console.log("%cSTOP!", "color:red;font-size:xx-large;font-weight:bold;"),
      console.log(`%cThis is a browser feature intended for developers. Do not enter or paste code which you don't understand. It may allow attackers to steal your information or impersonate you. See https://en.wikipedia.org/wiki/Self-XSS for more details`, "font-size:large;"),
      localStorage.do_NOT_share_jwt || localStorage.setItem("do_NOT_share_jwt", "do NOT share the JWT value. someone could steal your account");

  console.log('%c' + mensajeAutor, estiloConsola);
}

var intermitente = true;
setInterval(function () {
  mostrarMensaje();
  intermitente = !intermitente;
}, 1000);

mostrarMensaje();
