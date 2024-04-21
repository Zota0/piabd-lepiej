function CheckifEmpty(field) {
    return field.value === null || field.value === undefined || field.value === '';
}

const SignUpForm = document.getElementById('SignUpForm');

const username_input = document.getElementsByName('username')[0];
const username_check = document.getElementById('username-check');
username_check.textContent = '';

const email_input = document.getElementsByName('email')[0];
const email_check = document.getElementById('email-check');
email_check.textContent = '';
var EmailListener = false;

const phone_input = document.getElementsByName('phone')[0];
const phone_check = document.getElementById('phone-check');
phone_check.textContent = '';
var PhoneListener = false;

const pass_input = document.getElementsByName('password')[0];
const pass_check = document.getElementById('pass-check');
pass_check.textContent = '';
var PassListener = false;

const r_pass_input = document.getElementsByName('repeat_password')[0];
const r_pass_check = document.getElementById('r_pass-check');
r_pass_check.textContent = '';
var RPassListener = false;

const birth_input = document.getElementsByName('birthdate')[0];
const birth_check = document.getElementById('birth-check');
birth_check.textContent = '';
var BirthListener = false;

const a_t_input = document.getElementById('accept_terms');

const SignUp_btn = document.getElementById('signup-btn');

var BadPassword = true;
var BadPhone = true;
var BadMail = true;
var BadBirthday = true;
var BadUsername = true;

var disable_submit = true;

SignUpForm.addEventListener('click', (signup_event) => {

    if(!PhoneListener) {
        phone_input.addEventListener('input', (event) => {
            const isEmpty = event.target.value === null || event.target.value === undefined || event.target.value === '';
            const IsShort = event.target.value.length !== 9;
            const IsOnlyNumbers = /^\d+$/.test(event.target.value);

            if(isEmpty || IsShort) {
                phone_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Wprowadź swój Nr.Tel!</span>`;
                BadPhone = true;
            } else if(!IsOnlyNumbers) {
                phone_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Od kiedy masz literki?</span>`;
                BadPhone = true;
            } else {
                phone_check.innerHTML = '';
                BadPhone = false;
            }
        });
        PhoneListener = true;
    }

    
    if(!EmailListener) {
        email_input.addEventListener('input', (event) => {
            const isEmpty = CheckifEmpty(event.target);
            const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(event.target.value);

            if(isEmpty || !isValidEmail) {
                email_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Wprowadź swój adres e-mail!</span>`;
                BadMail = true;
            } else {
                email_check.innerHTML = '';
                BadMail = false ;
            }
        });
        EmailListener = true;
    }

    if (!PassListener || !RPassListener) {
        const validatePassword = () => {
            const password = pass_input.value;
            const repeatPassword = r_pass_input.value;

            const isEmpty = CheckifEmpty(pass_input);
            const isTooShortPassword = password.length < 8;
            const notHavingNumber = /\d/.test(password);
            const notHavingSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            const notHavingSmallCase = /[a-z]/.test(password);
            const notHavingBigCase = /[A-Z]/.test(password);

            if (isEmpty || isTooShortPassword) {
                pass_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Hasło co najmniej 8 znaków!</span>`;
                BadPassword = true;

            } else if (!notHavingSmallCase) {
                pass_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Min. 1 mała litera!</span>`;
                BadPassword = true;

            } else if (!notHavingBigCase) {
                pass_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Min. 1 duża litera!</span>`;
                BadPassword = true;

            } else if (!notHavingNumber) {
                pass_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Min. 1 cyfra!</span>`;
                BadPassword = true;

            } else if (!notHavingSpecialChar) {
                pass_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Min. 1 znak specjalny!</span>`;
                BadPassword = true;

            } else {
                pass_check.innerHTML = '';
                BadPassword = false ;
            }
        };

        pass_input.addEventListener('input', validatePassword);
        r_pass_input.addEventListener('input', validatePassword);

        PassListener = true;
        RPassListener = true;
    }

    if (!BirthListener) {
        $(birthdate).on('change', function() {
            const isEmpty = CheckifEmpty(this);

            if (isEmpty) {
                birth_check.innerHTML = `<span style="color:red;background:gainsboro;border-radius:50px;font-weight:800;padding:2px">Wprowadź datę urodzenia!</span>`;
                BadBirthday = true;
            } else {
                birth_check.innerHTML = '';
                BadBirthday = false;
            }
        });
        BirthListener = true;
    }

    if (!a_t_input.checked) {
        BadPassword = true;
    } else {
        BadPassword = BadPassword ;
    }

    username_input.addEventListener('change', (event) => {
        var username = event.target.value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_username.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {

                    const response = xhr.responseText;
                    console.log(typeof(response) + "_" + response + "___" + response.includes('true'));
                    if (response.includes('true')) {
                        username_check.innerHTML = '<span style="color:red;">Już istnieje</span>';
                        BadUsername = true;
                    } else {
                        log_username_check.innerHTML = '';
                        BadUsername = false ;
                    }
                } else {
                    console.error('ERROR: ' + xhr.status);
                    username_check.innerHTML = '<span style="color:red;">Błąd</span>';
                    BadUsername = true;
                }
            }
        };
        xhr.send(`username=${username}`);
    });

    DisableSubmit();
});

async function DisableSubmit() {
    if (!BadBirthday && !BadMail && !BadPassword && !BadPhone && !BadUsername) {
        disable_submit = false;
    } else {
        disable_submit = true;
    }

    await disable_submit;

    if (disable_submit) {
        SignUp_btn.disabled = true;
        SignUp_btn.style.backgroundColor = 'gainsboro';
        SignUp_btn.ariaDisabled = true;
    }

    if (!disable_submit) {
        SignUp_btn.disabled = false;
        SignUp_btn.style.backgroundColor = '';
        SignUp_btn.ariaDisabled = false;
    }
}