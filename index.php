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

<!DOCTYPE HTML>
<html>
    <?php
        $page_title = "OpenPool - The Open Source Bitcoin Pool";
        include('pages/head.php');
    ?>
    <body>
        <div id="container">
            <?php
                include('pages/header.php');
            ?>
        <div id="content">
            <?php
                include('pages/index/right.php');
                include('pages/index/left.php');
            ?>
        </div>
            <?php
                include('pages/footer.php');
            ?>
        </div>
    </body>
</html>