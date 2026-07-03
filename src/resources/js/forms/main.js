console.log('Forms JS cargado correctamente');

document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#form-city');

    if (form) {
        form.addEventListener('submit', (e) => {
            // aquí tu lógica antes de enviar, ej. validaciones
            console.log('Formulario enviado');
        });
    }
});