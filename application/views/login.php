<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if (isset($error)) {
        echo '<p>' . $error . '</p>';
    } else {
        echo $this->session->flashdata('error');
        
    } ?>
    <form method="post" action="<?php echo base_url('auth/login'); ?>">
        <label for="client_email">Email:</label>
        <input type="text" name="client_email" id="client_email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="client_password" id="client_password" required>
        <br>
        <input type="submit" name="login" value="Login">
    </form>

</body>

</html>