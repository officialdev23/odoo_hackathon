<?php
session_start();

echo "<h1>Manager Dashboard</h1>";
echo "<h3>Welcome " . $_SESSION['full_name'] . "</h3>";
