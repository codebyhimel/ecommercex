<?php
session_start();
session_destroy();
header('location: http://localhost/ecoomercex/admin/login.php');