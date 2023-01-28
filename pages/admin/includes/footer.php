<footer class="mt-auto">
    <div class="footer-dark">
        <div class="container footer-dark">
            <div class="row">
                <div class="col-sm-6 col-md-3 item">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="catologue.php">Shop now</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3 item">
                    <h3>Your Account</h3>
                    <ul>
                        <?php if(isset($_SESSION['usrAuth']) || isset($_SESSION['usrAuth'])){ ?>
                        <li><a href="account.php">Manage Account</a></li>
                        <?php }else{ ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="col-md-6 item text">
                    <h3>OrganicFoods</h3>
                    <p>OrganicFoods is a online organic market based in Malaysia.</p>
                </div>
            </div>
            <p class="copyright">OrganicFoods © 2023</p>
        </div>
    </div>
</footer>

