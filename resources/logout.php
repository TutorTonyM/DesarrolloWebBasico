<?php

session_start();
// sessiong_destroy();
unset($_SESSION['user']);
header('Location: ../index.php');