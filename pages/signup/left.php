<div id="left">
    <h2>Sign up with OpenPool</h2>
    <p>
    Signing up with OpenPool is easy, just give us your email, choose a password and you are ready to mine!</p>
    <div id="signup" class="form">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Email
    <span class="small">Add a valid address</span>
    </label>
    <input name="email" type="text" id="email"/>
    <label>Password
    <span class="small">Min. size 6 chars</span>
    </label>
    <input name="password" type="password" id="password"/>
    <label>Confirm Password
    </label>
    <input name="confirm" type="password" id="confirm"/>
    <button type="submit">Sign Up</button>
    </form>
    </div>
<?php
    if(isset($error)) {
        echo '<p>'.$error.'</p>';
    }
?>
<p>Already a member? <a href="/signin">Sign In!</a></p>

</div>