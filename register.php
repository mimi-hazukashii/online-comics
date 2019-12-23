<?php
/*
Template Name: Register
*/

ob_start();
get_header();

if (isset($_POST['submit'])) {
    $userdata = array(
        'user_pass' => $_POST['password'],
        'user_login' => $_POST['username'],
        'role' => 'subscriber'
    );

    $error = false;
    $err_msg = null;

    if (strlen($userdata['user_login']) < 3) {
        $error = true;
        $err_msg = 'Username must be at least 3 characters';
    } elseif (strlen($userdata['user_pass']) < 6) {
        $error = true;
        $err_msg = 'Password must be at least 6 characters';
    } elseif (username_exists($userdata['user_login'])) {
        $error = true;
        $err_msg = 'Username is exists, please try again!';
    } else {
        wp_insert_user($userdata);
        echo '<script>alert("Successfully register, please login!"); location.href = "/login";</script>';
    }

    if ($error) {
        echo "<script>alert('$err_msg'); location.href = '/register';</script>";
    }
}
?>
    <main>
        <article>
            <h1 class="main-title">Register</h1>
            <section id="register">
                <form method="post">
                    <p id="status"></p>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control form-control-sm" id="username" name="username"
                               placeholder="Type your username..." minlength="3" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control form-control-sm" id="password" name="password"
                               placeholder="Type your password..." minlength="6" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm">Confirm Password:</label>
                        <input type="password" class="form-control form-control-sm" id="confirm" name="confirm"
                               placeholder="Type your password again..." minlength="6" required>
                    </div>
                    <div class="text-right">
                        <span class="btn btn-sm btn-outline-info" id="btn-register">Register</span>
                        <button class="d-none" type="submit" id="submit" name="submit">Submit</button>
                    </div>
                </form>
            </section>
        </article>
    </main>

    <script>
        jQuery.noConflict();
        (function ($) {
            $('#btn-register').click(() => {
                let passed = true;

                const usr = $('#username').val();
                const pwd = $('#password').val();
                const cfm = $('#confirm').val();

                const statusDOM = $('#status');
                console.log(statusDOM);

                if (usr.length < 3) {
                    statusDOM.text('Username must be at least 3 characters!');
                    passed = false;
                }

                if (pwd.length < 6) {
                    statusDOM.text('Password must be at least 6 characters!');
                    passed = false;
                }

                if (pwd !== cfm) {
                    statusDOM.text('Password not match!');
                    passed = false;
                }

                if (passed) document.getElementById('submit').click();
            });
        })(jQuery);
    </script>

<?php get_footer();
ob_end_flush();