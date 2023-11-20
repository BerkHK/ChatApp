<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="login form">
            <header>Gercek Zamani Chat</header>
            <form action="#">
                <div class="error-text"></div>
                <div class="name-details">
                </div>
                <div class="field input">
                    <label>Email Adres</label>
                    <input type="text" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="button input">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not yet Signed up? <a href="index.php">Signup now</a></div>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>

</html>