<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie użytkownika</title>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js' integrity='sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js' integrity='sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==' crossorigin='anonymous'></script>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/trontastic/jquery-ui.min.css' integrity='sha512-5M6+Cc22T3g6DAtSBb531JchW83H54/E5uJhFciwQiPuv1MuqISiG5i8yf+ANczXUVLu4hS6L4amW5JrnwN2qg==' crossorigin='anonymous'/>

    <link rel="stylesheet" href="styles.css">

    <script>
        sessionStorage.clear();
        MediaSession.clear();
        MediaKeySession.clear();
    </script>

</head>
<body>

    <div class="container">
        <h1 style='text-transform: uppercase;'>Zaloguj się lub utwórz konto</h1>
        
        <div class="forms-container">
            <div class="form-wrapper">
                <h3>Utwórz konto</h3>
                <form id='SignUpForm' action="process.php" method="post">
                    <input type="hidden" name="action" value="signup">

                    <div>
                        <input type="text" name="username" placeholder="Twoja nazwa użytkownika" required>
                        <label class='needed-label' for="username" aria-readonly='true' readonly>
                            <span id='username-check'>nie może być puste</span>
                        </label>
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Twój e-mail" required>
                        <label class='needed-label' for="email" aria-readonly='true' readonly>
                            <span id='email-check'>nie może być puste</span>
                        </label>
                    </div>
    
                    <div>
                        <input maxlength='9' type="tel" name="phone" placeholder="Twój numer telefonu" required>
                        <label class='needed-label' for="username" aria-readonly='true' readonly>
                            <span id='phone-check'>nie może być puste</span>
                        </label>
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Twoje hasło" required>
                        <label class='needed-label' for="username" aria-readonly='true' readonly>
                            <span id='pass-check'>nie może być pusty</span>
                        </label>
                    </div>
                    <div>
                        <input type="password" name="repeat_password" placeholder="Powtórz hasło" required>
                        <label class='needed-label' for="username" aria-readonly='true' readonly>
                            <span id='r_pass-check'>nie może być pusty</span>
                        </label>
                    </div>
                    <div>
                        <input type="text" name="birthdate" id='birthdate' placeholder='Twoja data urodzenia (rok/msc./dzien)' required>
                        <label class='needed-label' for="username" aria-readonly='true' readonly>
                            <span id='birth-check'>nie może być pusty</span>
                        </label>
                    </div>

                    <div>
                        <div class="gender-container">
                            <label for="gender-male">Mężczyzna</label>
                            <input type="radio" name="gender" id="gender-male" value="male" required checked aria-checked='true'>
                            <label for="gender-female">Kobieta</label>
                            <input type="radio" name="gender" id="gender-female" value="female" required>
                        </div>
                    </div>

                    <div>
                        <div class="accept_terms-container">
                            <input type="checkbox" id='accept_terms' name="accept_terms" required>
                            <label id='accept_terms-label' for='accept_terms'>Akceptuje <a id='show_terms' href='#'>warunki korzystania</a>
                            </label>
                        </div>
                    </div>

                    <div>
                        <button id='signup-btn' type="submit">Utwórz</button>
                    </div>

                    <dialog id="termsDialog">
                        <h4>Warunki korzystania</h4>
                        <p>(Coś tu jest, nie wiem co, ale jest)</p>
                        <button id="closeDialog">Close</button>
                    </dialog>

                    <div id='dark_on_dialog' class="hidden"></div>
    
                    <script src="SignUpCheck.js"></script>
                    <script>
                        $(function() {
                            $("#birthdate").datepicker({
                                dateFormat: 'yy-mm-dd',
                                changeMonth: true,
                                changeYear: true,
                                yearRange: "-100:+0",
                                maxDate: '0'
                            });
                        });

                        const showDialog = document.getElementById('show_terms');
                        const termsDialog = document.getElementById('termsDialog');
                        const closeDialog_btn = document.getElementById('closeDialog');
                        const dark_on_dialog = document.getElementById('dark_on_dialog');

                        dark_on_dialog.classList.add('hidden');

                        showDialog.addEventListener('click', () => {
                            dark_on_dialog.classList.remove('hidden');
                            termsDialog.showModal();
                            return false;
                        });

                        closeDialog_btn.addEventListener('click', () => {
                            dark_on_dialog.classList.add('hidden');
                            termsDialog.close();
                        });
                    </script>
                </form>
            </div>
            
            <div class="form-wrapper">
                <h3>Zaloguj się</h3>
                <form id='LogInForm' action="process.php" method="post">
                    <input type="hidden" name="action" value="login">
                    <input type="text" name="LogInUsername" placeholder="Wpisz nazwę użytkownika" required>
                    <label class='needed-label' for="LogInUsername" aria-readonly='true' readonly>
                        <span id='login_username-check'>nie może być puste</span>
                    </label>
                    <input type="password" name="LogInPassword" placeholder="Wpisz hasło">
                    <button id='login-btn' type="submit">Zaloguj</button>
                    <script src="LogInCheck.js"></script>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
