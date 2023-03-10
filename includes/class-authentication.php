<?php

class Authentication
{

    /**
     * To login user
     */
    public static function login( $email, $password )
    {
        $user_id = false;

        $user = DB::connect()->select(
            'SELECT * FROM users where email = :email',
            [
                'email' => $email
            ]
        );

        // if $user is valid, then return $user array
        if ( $user ) {
            // proceed to verify password
            if ( password_verify( $password, $user['password'] ) ) {
                $user_id = $user['id'];
            }
        }

        // make sure to return the user's ID
        return $user_id;
    }

    /**
     * To sign up user
     */
    public static function signup( $firstname, $lastname, $email , $password )
    {

        return DB::connect()->insert(
            'INSERT INTO users (firstname,lastname,email,password)
            VALUES (:firstname, :lastname, :email, :password)',
            [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'password' => password_hash( $password, PASSWORD_DEFAULT ),
            ]
        );

    }

    /** 
     * To logout user
     */
    public static function logout()
    {
        unset( $_SESSION['user'] );
    }

    /**
     * check if user is logged in or not
     */
    public static function isLoggedIn() 
    {
        return isset( $_SESSION['user'] );
    }

    /**
     * assign user's session
     */
    public static function setSession( $user_id )
    {
        // load the user data from database based on $user_id provided
        $user = DB::connect()->select(
            'SELECT * from users where userid = :userid',
            [
                'userid' => $user_id
            ]
        );

        // assign it to $_SESSION['user']
        $_SESSION['user'] = [
            'userid' => $user['userid'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'phonenumber' => $user['phonenumber'],
            'email' => $user['email'],
            'gender' => $user['gender'],
            'role' => $user['role']
        ];
    }

    /**
     * Retrieve the user's role from $_SESSION['user']
     */
    public static function getRole()
    {
        if ( self::isLoggedIn() ) {
            return $_SESSION['user']['role'];
        }
        return false;
    }

    /**
     * Check if the current logged in user is admin
     */
    public static function isAdmin()
    {
        return self::getRole() == 'admin';
    }

    /**
     * Check if the current logged in user is supplier
     */
    public static function isSupplier()
    {
        return self::getRole() == 'supplier';
    }

    /**
     * Check if the current logged in user is normal user
     */
    public static function isUser()
    {
        return self::getRole() == 'user';
    }

    /**
     * to control user's access
     * 
     * $role can be 'admin', 'supplier' or 'user;'
     */
    public static function whoCanAccess( $role )
    {
        // make sure is logged in
        if ( self::isLoggedIn() ) {
            switch( $role ) {
                // if the $role is admin
            case 'admin':
                return self::isAdmin();
            case 'supplier':
                return self::isSupplier() || self::isAdmin();
            case 'user' :
                return self::isUser() || self::isSupplier() || self::isAdmin();
            }//end-switch
        } 

        // if no condition met, we'll return false
        return false;
    }
}