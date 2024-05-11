const LogInform = document.getElementById("LogInForm");

const LogIn_btn = document.getElementById('login-btn');

const log_username_input = document.getElementsByName("LogInUsername")[0];
const log_username_check = document.getElementById('login_username-check');
log_username_check.innerHTML = '';

var UsernameExists = false;

LogInform.addEventListener("input", function(login_event) {
    log_username_input.addEventListener('input', (event) => {
        var log_username = event.target.value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'check_username.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {

                    const response = xhr.responseText;
                    console.log(typeof (response) + "_" + response + "___" + response.includes('true'));
                    if (!response.includes('true')) {
                        log_username_check.innerHTML = '<span style="color:red;">Nie istnieje</span>';
                        UsernameExists = false;
                    } else {
                        log_username_check.innerHTML = '';
                        UsernameExists = true;
                    }
                } else {
                    console.error('ERROR: ' + xhr.status);
                    log_username_check.innerHTML = '<span style="color:red;">Błąd</span>';
                    UsernameExists = false;
                }
            }
        };
        xhr.send(`username=${log_username}`);
    });

    if(!UsernameExists) {
        LogIn_btn.disabled = true;
        LogIn_btn.style.backgroundColor = 'gainsboro';
        LogIn_btn.ariaDisabled = true;
    } else {
        LogIn_btn.disabled = false;
        LogIn_btn.style.backgroundColor = '';
        LogIn_btn.ariaDisabled = false;
    }
});