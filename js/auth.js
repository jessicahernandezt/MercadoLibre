// VALIDAR EMAIL

function validarEmail(email){

    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    return regex.test(email);
}

// LOGIN

const formLogin = document.getElementById("form-login");

if(formLogin){

    formLogin.addEventListener("submit", function(e){

        const correo = document
        .getElementById("correo")
        .value
        .trim();

        const password = document
        .getElementById("password")
        .value
        .trim();

        // CAMPOS VACÍOS

        if(!correo || !password){

            e.preventDefault();

            mostrarAlerta("Completa todos los campos");

            return;
        }

        // VALIDAR EMAIL

        if(!validarEmail(correo)){

            e.preventDefault();

            mostrarAlerta("Ingresa un correo válido");

            return;
        }

        // PASSWORD MIN

        if(password.length < 6){

            e.preventDefault();

            mostrarAlerta(
                "La contraseña debe tener mínimo 6 caracteres"
            );

            return;
        }

    });

}

// ALERTA PERSONALIZADA

function mostrarAlerta(mensaje){

    const alertaExistente =
    document.querySelector(".alerta-js");

    if(alertaExistente){
        alertaExistente.remove();
    }

    const alerta = document.createElement("div");

    alerta.classList.add("alerta-js");

    alerta.textContent = mensaje;

    document.body.appendChild(alerta);

    setTimeout(() => {

        alerta.remove();

    }, 3000);
}