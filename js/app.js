document.addEventListener('DOMContentLoaded', function () {
    // Reservation form validation
    const reservasiForm = document.querySelector('.reservasi form');
    const reservasiInputs = reservasiForm.querySelectorAll('input, textarea');

    reservasiForm.addEventListener('submit', function (event) {
        let isValid = true;

        reservasiInputs.forEach(input => {
            if (!input.validity.valid) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    const fullNameInput = reservasiForm.querySelector('input[name="fullname"]');
    const phoneInput = reservasiForm.querySelector('input[name="phone"]');
    const emailInput = reservasiForm.querySelector('input[name="email"]');

    fullNameInput.addEventListener('input', function () {
        if (!/^[A-Za-z\s]+$/.test(fullNameInput.value)) {
            fullNameInput.setCustomValidity('Full Name must contain only letters and spaces');
        } else {
            fullNameInput.setCustomValidity('');
        }
    });

    phoneInput.addEventListener('input', function () {
        if (!/^\d+$/.test(phoneInput.value)) {
            phoneInput.setCustomValidity('Phone Number must contain only numbers');
        } else {
            phoneInput.setCustomValidity('');
        }
    });

    emailInput.addEventListener('input', function () {
        if (!/\S+@\S+\.\S+/.test(emailInput.value)) {
            emailInput.setCustomValidity('Email Address must contain "@" and a valid domain');
        } else {
            emailInput.setCustomValidity('');
        }
    });

    // Subscription form validation
    const subscribeForm = document.querySelector('.subscribe form');
    const subscribeInputs = subscribeForm.querySelectorAll('input');

    subscribeForm.addEventListener('submit', function (event) {
        let isValid = true;

        subscribeInputs.forEach(input => {
            if (!input.validity.valid) {
                isValid = false;
                input.classList.add('invalid');
            } else {
                input.classList.remove('invalid');
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    const subscribeNameInput = subscribeForm.querySelector('input[name="name"]');
    const subscribeEmailInput = subscribeForm.querySelector('input[name="email"]');

    subscribeNameInput.addEventListener('input', function () {
        if (!/^[A-Za-z\s]+$/.test(subscribeNameInput.value)) {
            subscribeNameInput.setCustomValidity('Name must contain only letters and spaces');
        } else {
            subscribeNameInput.setCustomValidity('');
        }
    });

    subscribeEmailInput.addEventListener('input', function () {
        if (!/\S+@\S+\.\S+/.test(subscribeEmailInput.value)) {
            subscribeEmailInput.setCustomValidity('Email Address must contain "@" and a valid domain');
        } else {
            subscribeEmailInput.setCustomValidity('');
        }
    });
});
