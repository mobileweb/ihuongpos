<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
<?php
if (!isset($title) || $title != "Login")
    echo "<script>hideMenuItem(\".login\")</script>";
else
    echo "<script>hideMenuItem(\".logout, .login\")</script>";
?>
