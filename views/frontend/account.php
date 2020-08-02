<!DOCTYPE html>
<html lang="en">
<?php require_once dirname(__FILE__, 2) . '/universal/signedout/header.php';?>

<body style="background-color:white;">
    <?php require_once dirname(__FILE__, 2) . '/universal/signedout/navigation.php';?>

    <?php
        if(filter_input(INPUT_GET, 'error')) {
            echo "<h1 style='text-align:center;color:#882211'>". filter_input(INPUT_GET, 'error') ."</h1>";
        }

        if(filter_input(INPUT_GET, 'success')) {
            echo "<h1 style='text-align:center;color:#228811'>". filter_input(INPUT_GET, 'success') ."</h1>";
        }
    ?>

    <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

    <div id="id01" class="modal">
        <form class="modal-content animate" action="/account/index.php?q=login" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Email Address</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <button type="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'"
                    class="cancelbtn">Cancel</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>

    <button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Sign Up</button>

    <div id="id02" class="modal">
        <span onclick="document.getElementById('id02').style.display='none'" class="close"
            title="Close Modal">&times;</span>
        <form class="modal-content" action="/account/index.php?q=register" method="post">
            <div class="container">
                <h1>Sign Up</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <label for="Name"><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="name" required>

                <label for="Surame"><b>Surame</b></label>
                <input type="text" placeholder="Enter Surname" name="surname" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="CompanyName"><b>Company Name</b></label>
                <input type="text" placeholder="Enter Company Name" name="companyname" required>

                <label for="TypeofContribution"><b>Type of Contribution</b></label>
                <select style="width:100%;padding:5px;">
                    <option value="Recipient">Recipient</option>
                    <option value="Recipient">Donor</option>
                </select>
                <br/>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" placeholder="Repeat Password" name="psw_repeat" required>

                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                </label>

                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('id02').style.display='none'"
                        class="escbtn">Cancel</button>
                    <button type="submit" class="signupbtn">Sign Up</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

    <?php require_once dirname(__FILE__, 2) . '/universal/signedout/footer.php';?>
</body>

</html>
