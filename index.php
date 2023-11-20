<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Gercek Zamani Chat</header>
            <form action="process_signup.php" method="post" enctype="multipart/form-data">
                <div class="error-text"></div>
                <div class="field input">
                    <label> First Name</label>
                    <input type="text" name="fname" placeholder="first Name" required>
                </div>
                <div class="field input">
                    <label> Last Name</label>
                    <input type="text" name="lname" placeholder="Enter Last Name" required>
                </div>
                <div class="field input">
                    <label> Email Adres</label>
                    <input type="text" name="email" placeholder="Enter Mail" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <label for="image"> Select image</label>
                <div class="file-upload">
                    <label for="file-upload-input" class="file-upload-label">
                        Click here to upload a file
                    </label>
                    <input id="file-upload-input" type="file" style="display: none;" />
                    <img id="preview" style="display: none; width: 100px; height: 100px;" />
                </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Already Signed up ? <a href="Login.php">Login now</a></div>
        </section>
    </div>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
    <script>
        document.getElementById('file-upload-input').addEventListener('change', function() {
            const file = this.files[0];
            const preview = document.getElementById('preview');
            const label = document.querySelector('.file-upload-label');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    preview.style.width = '100%';
                    preview.style.objectFit = 'cover'
                    label.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>