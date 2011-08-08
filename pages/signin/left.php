<div id="left">
<h2>Sign In</h2>
<div id="signup" class="form">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<label>Email
<span class="small">Type your address</span>
</label>
<input name="email" type="text" id="email"/>
<label>Password
<span class="small">Min. size 6 chars</span>
</label>
<input name="password" type="password" id="password"/>
<button type="submit">Sign In</button>
</form>
</div>
<p>Not a member? <a href="/signup">Sign Up!</a></p>
</div>