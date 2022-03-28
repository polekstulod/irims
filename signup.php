<?php
include_once "views/partials/header.html";
require('config.php');
?>

<body>
    <section>
        <div class="container-fluid bg-slider">
            <div class="row">
                <div class="col-md-4 frost">
                    <div class="toplayer login-card-body">
                        <img class="img-fluid mx-auto d-block" src="assets/img/IRIMSLOGO.png" width="95" height="95">
                        <div class="pt-0 pe-5 pb-5 ps-5">
                            <form class="form" method="post" id="signup-form">
                                <div class="mt-4">
                                    <div class="row mb-2">
                                        <div class="col-md-6"><label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="first-name">First Name</label><input class="form-control border-form rounded-pill" type="text" id="first-name" name="firstname" required></div>
                                        <div class="col-md-6"><label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="last-name">Last Name</label><input class="form-control border-form rounded-pill" type="text" id="last-name" name="lastname" required></div>
                                    </div>
                                </div>
                                <div class="col mb-2"><label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="username">Username</label><input class="form-control border-form rounded-pill" type="text" id="username" name="username" required></div>
                                <div class="col mb-2"><label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="contact">Contact Number</label><input class="form-control border-form rounded-pill" type="number" id="contact" name="contact" required></div>
                                <div class="form-group">
                                    <label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="contact">Department</label>
                                    <select class="form-select" name="department" id="department">
                                        <option value="" disabled selected></option>
                                        <?php
                                        $sql = "SELECT * FROM department WHERE DepartmentID > 0";
                                        $result = $con->query($sql) or die(mysql_error());

                                        while ($row = $result->fetch_assoc()) { ?>
                                            <option value="<?php echo $row['DepartmentID'] ?>"><?php echo $row['DepartmentName'] ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="col mb-2"><label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="password">Password</label><input class="form-control border-form rounded-pill" type="password" id="password" name="password" required onChange="onChange()"></div>
                                <div class="col mb-5"><label class="form-label col-sm-12 col-form-label rxpress-color fs-5" for="confirm">Confirm Password</label><input class="form-control border-form rounded-pill" type="password" id="confirm" name="confirm" required onChange="onChange()"></div>
                                <div class="col mb-2"><button class="col-12 btn btn-color rounded-pill fs-5" name="submit" id="signup" type="submit">SIGN UP</button></div>
                                <div class="col text-center mb-5"><a class="text-dark text-decoration-none" href="index.php">ALREADY HAVE AN ACCOUNT? LOGIN</a></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function onChange() {
            const password = document.querySelector('#password');
            const confirm = document.querySelector('#confirm');
            if (password.value != confirm.value) {
                confirm.setCustomValidity('Passwords do not match');
            } else {
                confirm.setCustomValidity('');
            }
        }

        function successAlert() {
            Swal.fire({
                title: "Registered Successfully!",
                text: "You have successfully created an account. Go to the login page",
                confirmButtonColor: "#00A3A8",
                icon: "success",
            }).then((result) => {
                if (result['isConfirmed']) {
                    window.location.href = "/irims";
                }
            })
        }
    </script>

    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alumuko/vanilla-datetimerange-picker@latest/dist/vanilla-datetimerange-picker.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);

        $firstname = stripslashes($_REQUEST['firstname']);
        $firstname = mysqli_real_escape_string($con, $firstname);

        $lastname = stripslashes($_REQUEST['lastname']);
        $lastname = mysqli_real_escape_string($con, $lastname);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $contact = stripslashes($_REQUEST['contact']);
        $contact = mysqli_real_escape_string($con, $contact);

        $deptID = $_REQUEST['department'];
        mysqli_query($con, "ALTER TABLE user AUTO_INCREMENT=1;") or die(mysql_error());
        $query  = "INSERT INTO `user` (`UserID`, `Username`, `FirstName`, `LastName`, `UserPassword`, `DepartmentID`, `ContactNO`, `IsAdmin`) VALUES (NULL, '$username', '$firstname', '$lastname', '$password', '$deptID', '$contact', b'0') ";
        $result   = mysqli_query($con, $query) or die(mysql_error());
        if ($result) {
            echo "<script>successAlert()</script>";
        }
    }
    ?>
</body>

</html>