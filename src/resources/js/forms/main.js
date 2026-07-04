document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#form-city');
    const validationAlert = document.querySelector('#form-validation-alert');
    const decimalInputs = document.querySelectorAll('.decimal-input');
    const decimalPattern = /^-?\d+([.,]\d{1,7})?$/;

    /*
    * Muestra un mensaje de error para un campo de entrada específico.
    * @param {HTMLInputElement} input - El campo de entrada que tiene el error.
    * @param {string} message - El mensaje de error a mostrar.
    */
    const showError = (input, message) => {
        const feedback = input.parentElement.querySelector('.invalid-feedback');

        input.classList.add('is-invalid');
        input.classList.remove('is-valid');

        if (feedback) {
            feedback.textContent = message;
        }
    };

    /*
    * Limpia el mensaje de error para un campo de entrada específico.
    * @param {HTMLInputElement} input - El campo de entrada que tiene el error.
    */
    const clearError = (input) => {
        const feedback = input.parentElement.querySelector('.invalid-feedback');

        input.classList.remove('is-invalid');
        input.classList.add('is-valid');

        if (feedback) {
            feedback.textContent = '';
        }
    };

    /*
    * Valida un campo de entrada decimal.
    * @param {HTMLInputElement} input - El campo de entrada a validar.
    * @returns {boolean} - true si el campo es válido, false en caso contrario.
    */
    const validateDecimalInput = (input) => {
        const value = input.value.trim();
        const numericValue = Number(value.replace(',', '.'));
        const min = Number(input.getAttribute('min'));
        const max = Number(input.getAttribute('max'));

        if (!value) {
            showError(input, input.dataset.requiredMessage);
            return false;
        }

        if (!decimalPattern.test(value) || Number.isNaN(numericValue)) {
            showError(input, input.dataset.decimalMessage);
            return false;
        }

        if (numericValue < min || numericValue > max) {
            showError(input, input.dataset.rangeMessage);
            return false;
        }

        clearError(input);
        return true;
    };

    if (!form) {
        return;
    }

    /*
    * Agrega eventos de entrada y desenfoque a cada campo de entrada decimal para validar en tiempo real.
    */
    decimalInputs.forEach((input) => {
        input.addEventListener('input', () => {
            input.classList.remove('is-valid', 'is-invalid');

            if (validationAlert) {
                validationAlert.classList.add('d-none');
            }
        });

        input.addEventListener('blur', () => validateDecimalInput(input));
    });

    /*
    * Maneja el evento de envío del formulario, validando todos los campos de entrada decimal antes de permitir el envío.
    */
    form.addEventListener('submit', (event) => {
        const validations = Array.from(decimalInputs).map(validateDecimalInput);
        const isValid = validations.every(Boolean);

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();

            if (validationAlert) {
                validationAlert.classList.remove('d-none');
            }

            form.querySelector('.is-invalid')?.focus();
            return;
        }

        decimalInputs.forEach((input) => {
            input.value = input.value.trim().replace(',', '.');
        });
    });
});