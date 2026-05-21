

function actualizarContador(){

    fetch("contador_carrito.php")

    .then(res => res.text())

    .then(data => {

        document.getElementById(
            "contador-carrito"
        ).textContent = data;

    });

}

actualizarContador();

