<?php
/*
Template Name: Login
*/

ob_start();
get_header();

if (is_user_logged_in())
    echo '<script>location.href = "/";</script>';

if (isset($_POST['submit'])) {
    $username = isset($_POST['username']) ? $_POST['username'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : null;

    $userdata = array();

    $userdata['user_login'] = username_exists($username) ? $username : null;
    $user = get_user_by('login', $userdata['user_login']);
    if ($user && wp_check_password($password, $user->data->user_pass, $user->ID))
        $userdata['user_password'] = $password;
    $userdata['remember'] = isset($_POST['remember']);

    if (!$userdata['user_login'] || !$userdata['user_password']) {
        echo "<script>alert('Invalid username or password!'); location.href = '/login';</script>";
    }

    wp_signon($userdata);
    echo '<script>location.href = "/";</script>';
} ?>
    <main>
        <article>
            <h1 class="main-title">Login</h1>
            <section id="login">
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
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" value="yes"> Remember me
                        </label>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-outline-info" name="submit">Login</button>
                    </div>
                </form>
            </section>
        </article>
    </main>
<?php get_footer();
ob_end_flush();