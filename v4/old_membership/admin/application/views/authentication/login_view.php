<div id="login_container">
    <div class="wrapper">
        <header>New Hong Kong Restaurant CMS</header>
        <div class="form">
            <form id="login_form" action="<?php echo base_url("index.php/login/validate_login") ?>" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="username" maxlength="32"/>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="password" maxlength="32"/>
                <input class="submit"id="submit_login"  name="submit_login" value="Login" type="submit">
            </form>
        </div>
        
        <div class="error"><span>*Login failed. Unknown username and password.</span></div>
        
        <footer></footer>
    </div>
</div>