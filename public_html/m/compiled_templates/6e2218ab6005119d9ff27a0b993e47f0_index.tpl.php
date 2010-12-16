<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div data-role="header">
    <h1>pub<span id="lic">lic</span></h1>
</div><!-- /header -->

<div data-role="content">
    <form action="<?php echo $this->variables['formaction']; ?>" method="post">
        <div data-role="fieldcontain">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo SpoonFilter::htmlentities($this->variables['username']); ?>"  />
        </div>
        <div data-role="fieldcontain">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo SpoonFilter::htmlentities($this->variables['password']); ?>" />
            <span class="error" id="msgFault"><?php echo SpoonFilter::htmlentities($this->variables['msgFault']); ?></span>
        </div>
        <input type="submit" data-theme="b" id="btnSignin" name="btnSignin" value="Sign in"/>
    </form>
    <p>
        New here? <a href="register.php" rel="external">Join Public!</a>
    </p>
</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /header -->