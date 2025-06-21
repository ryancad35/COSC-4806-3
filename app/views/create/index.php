    <?php require_once 'app/views/templates/headerPublic.php' ?>

    <main role="main" class="container">
        <?php if (!empty($error)): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <h1>Create an Account</h1>
        <form action="/create" method="post">
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
            <br><br>
            <label>Password:</label>
            <input type="password" name="password" required>
            <br><br>
            <button type="submit" name="action" value="Submit Registration">Submit Registration</button>
        </form>
        <p>Already have an account? <a href="/login">Login here</a></p>
    </main>

    <?php require_once 'app/views/templates/footer.php' ?>