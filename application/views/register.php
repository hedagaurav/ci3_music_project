<h2>Register</h2>
<form method="post" action="<?php echo base_url('auth/register'); ?>">
    <label for="client_name">Name:</label>
    <input type="text" name="client_name" id="client_name" required>
    <br>
    <label for="client_email">Email:</label>
    <input type="email" name="client_email" id="client_email" required>
    <br>
    <label for="client_password">Password:</label>
    <input type="password" name="client_password" id="client_password" required>
    <br>
    <input type="submit" name="register" value="Register">
</form>