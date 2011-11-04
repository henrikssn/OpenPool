<?php
# This file is part of OpenPool.
#
#    OpenPool is free software: you can redistribute it and/or modify
#    it under the terms of the GNU Affero General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    OpenPool is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU Affero General Public License for more details.
#
#    You should have received a copy of the GNU Affero General Public License
#    along with OpenPool.  If not, see <http://www.gnu.org/licenses/agpl-3.0.html>.
?>
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
<p>Not a member? <a href="/signup.php">Sign Up!</a></p>
</div>
