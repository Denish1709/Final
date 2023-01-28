<?php  
 // set CSRF token
 CSRF::generateToken( 'login_form' );

 // make sure if the user wasn't logged in yet. 
 // If the user already logged in, we'll redirect to dashboard page
 if ( Authentication::isLoggedIn() )
 {
   header('Location: /dashboard');
   exit;
 }

 // process the login form
 if ( $_SERVER["REQUEST_METHOD"] === 'POST' ) {

   $email = $_POST['email'];
   $password = $_POST['password'];
   
   // Step 1: do error check
   $error = FormValidation::validate( 
     $_POST,
     [
       'email' => 'required', 
       // email is the key, required is the condition
       'password' => 'required',
       // password is the key, required is the condition
       'csrf_token' => 'login_form_csrf_token'
     ] 
   );

   // make sure there is no error
   if ( !$error ) {

     // Step 2: login the user
     $user_id = Authentication::login( $email, $password );
           
     // if $user_id is false, 
     // meaning either email or password is incorrect
     if ( !$user_id ) {
       // trigger error message
       $error = "Email or password is incorrect";
     } else {
       // if $user_id is valid,
       // $user_id is a number

       // step 3: assign the user to $_SESSION['user']
       Authentication::setSession( $user_id );

       // Step 4: remove csrf token & redirect the user to dashboard
         // 4.1: remove csrf token
         CSRF::removeToken( 'login_form' );

         // 4.2: redirect to dashboard
         header('Location: /dashboard');
         exit;

     } // end - !$user_id

   } // end - !$error

 }
?>
    <?php $pageTitle = "Login"; require dirname(__DIR__) . '/parts/header.php';?>
    

<section>
    <div class="container p-5">
        <h1>Login</h1>
        <p>Log in to your membership account to access more exclusive privileges!</p>
    </div>

    <div class="container-fluid" style="max-width: 500px;">
    <?php require dirname(__DIR__) . '/parts/error_box.php'; ?>
        <form 
          method="POST" 
          action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
          <div class="mb-2">
            <label for="email" class="visually-hidden">Email</label>
            <input
              type="text"
              class="form-control"
              id="email"
              name="email"
              placeholder="email@example.com"
            />
          </div>

        <div class="mb-3">
        <label for="password" class="visually-hidden">Password</label>
            <input
              type="password"
              class="form-control"
              id="password"
              name="password"
              placeholder="Password"
            />
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
          <input
            type="hidden"
            name="csrf_token"
            value="<?php echo CSRF::getToken( 'login_form' ); ?>"
            />
        </form>

      <a class="dropdown-item mt-3" href="register.php">New around here? Sign up</a>
      <a class="dropdown-item" href="resetpassword.php">Forgot password?</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="supplier/login.php">Login as Supplier</a>



    </div>



  </div>


</section>
<?php include('./parts/footer.php');?>
</body>



</html>

