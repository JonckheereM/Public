<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div data-role="header">
    <a href="index.php" rel="external" data-icon="arrow-l">Back</a>
    <h1>pub<span id="lic">lic</span></h1>
</div><!-- /header -->

<div data-role="content">
    <form action="<?php echo $this->variables['formaction']; ?>" method="post">
        <div data-role="fieldcontain">
            <label for="name">First name:</label>
            <input type="text" name="first_name" id="first_name" value="<?php echo SpoonFilter::htmlentities($this->variables['first_name']); ?>"/>
            <span class="error" id="msgFirst_name"><?php echo SpoonFilter::htmlentities($this->variables['msgFirst_name']); ?></span>
        </div>
        <div data-role="fieldcontain">
            <label for="name">Last name:</label>
            <input type="text" name="last_name" id="last_name" value="<?php echo SpoonFilter::htmlentities($this->variables['last_name']); ?>"/>
            <span class="error" id="msgLast_name"><?php echo SpoonFilter::htmlentities($this->variables['msgLast_name']); ?></span>
        </div>
        <div data-role="fieldcontain">
            <label for="name">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo SpoonFilter::htmlentities($this->variables['username']); ?>"/>
            <span class="error" id="msgUsername"><?php echo SpoonFilter::htmlentities($this->variables['msgUsername']); ?></span>
        </div>
        <div data-role="fieldcontain">
            <label for="name">Email:</label>
            <input type="text" name="mail" id="mail" value="<?php echo SpoonFilter::htmlentities($this->variables['mail']); ?>"/>
            <span class="error" id="msgMail"><?php echo SpoonFilter::htmlentities($this->variables['msgMail']); ?></span>
        </div>
        <div data-role="fieldcontain">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" value="<?php echo SpoonFilter::htmlentities($this->variables['password']); ?>"/>
            <span class="error" id="msgPassword"><?php echo SpoonFilter::htmlentities($this->variables['msgPassword']); ?></span>
        </div>
        <input type="submit" data-theme="b" id="btnSignup" name="btnSignup" value="Sign up"/>
    </form>
</div><!-- /content -->

<div data-role="footer">
    <h4>&#169; pub<span id="lic">lic</span></h4>
</div><!-- /header -->