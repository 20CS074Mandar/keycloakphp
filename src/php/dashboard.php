<?php
require_once 'auth.php';
authorize();
echo "dashboard";
?>

<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <script type="text/javascript">
        if (hasRole(['quiz_creator'])) {
            document.write("Role is Quiz Creator");
        } 
        if (hasRole(['quiz_approver'])) {
            document.write("Role is Quiz Approver");
        } 
        else {
            console.log("No Quiz Role found");
        }
    </script>
</body>
</html>