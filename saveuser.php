<?php

require_once __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Exception\Auth\EmailExists;
use Kreait\Firebase\Factory;


//path to key
// $serviceAccountPath = 'firebasePHP2/keys/activity4-zambrano-firebase-adminsdk-j10op-cbe54f7ac3.json';

//get json contents
// $serviceAccountPathJson = file_get_contents($serviceAccountPath);

//create a service account instance/object using the provided JSON file
// $serviceAccount = ServiceAccount::fromValue($serviceAccountPathJson);

// $firestore = $factory->createFirestore();


if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $newUser = [
        // 'username' => $username,
        // 'firstname' => $firstname,
        // 'lastname' => $lastname,
        'email' => $email,
        'password' => $password
    ];

    $factory = (new Factory)->withServiceAccount('keys/activity4-zambrano-firebase-adminsdk-j10op-cbe54f7ac3.json');
    $auth = $factory->createAuth();

    try{
        //creating user in the firebase
    $user = $auth->createUser($newUser);

    $firestore = $factory -> createFirestore();

    $firestore -> database()->collection('users')->document($user->uid)->set ([
            'username' =>   $username,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
        
    ]);

        header('Location:login.php');

    } catch(EmailExists $e) {
        echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/water.css@2/out/water.css'>";
        echo "Email Already Exists";
        echo "<p> Go back <a href='signup.php'>here.</a> </p>" ;
        echo "<p> Or, already created an account? <a href='login.php'>Login</a> </p>";
    } catch(Exception $e) {
        echo "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/water.css@2/out/water.css'>";
        echo "Error: " . $e->getMessage();
    }

}else{
    header("Location: login.php");
};


?>

