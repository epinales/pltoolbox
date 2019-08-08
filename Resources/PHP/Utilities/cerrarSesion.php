<?php

session_start();
session_destroy();

header("Location: /pltoolbox/index.php");
?>
