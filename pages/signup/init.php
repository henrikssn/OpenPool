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
<?php
	require($_SERVER['DOCUMENT_ROOT']."/script/db.php");	
    if(isset($_POST["email"]) && isset($_POST["password"])) {
        if (!new_user($_POST["email"], $_POST["password"])) {
            $error = "An error has occured, please try again.";
        } else {
            header("Location: /profile.php");
        }
    }
?>
