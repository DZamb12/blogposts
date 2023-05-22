<?php

session_start();

use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Factory;

require_once __DIR__ . '/vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $factory = (new Factory)->withServiceAccount('keys/activity4-zambrano-firebase-adminsdk-j10op-cbe54f7ac3.json');
    $auth = $factory->createAuth();

    try{
        $attemptSignIn = $auth->signInWithEmailAndPassword($email, $password);
        $_SESSION['user_id'] = $attemptSignIn->firebaseUserId();
        $_SESSION['email'] = $email;

        header('location: index.php');
    
    } catch(InvalidPassword $e){
        echo "Invalid Credentials.";
    } catch(UserNotFound $e){
        echo "Invalid Credentials.";
    } catch(Exception $e) {
        echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/water.css@2/out/water.css'>";
        echo "Invalid Credentials.";
        echo "<p> No account? Create an account <a href='signup.php'>here.</a> </p>" ;
        echo "<p> Or, try logging it again. <a href='login.php'>Login</a> </p>";
    }
     

} else {
    header('location: login.php');
}