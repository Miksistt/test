<?php
session_start();
session_destroy();
header('Location: /templates/partials/login.php');
exit;
