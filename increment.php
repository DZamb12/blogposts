<?php

require_once __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Firestore\FieldPath;
use Google\Cloud\Firestore\FieldView;
use Google\Cloud\Firestore\FieldValue;

$db = new FirestoreClient([
    'keyFilePath' => 'keys/activity4-zambrano-firebase-adminsdk-j10op-cbe54f7ac3.json',
    'projectId' => 'activity4-zambrano'
]);

$id = $_GET['id'];

$docRef = $db->collection('blogPosts')->document($id);
$document = $docRef->snapshot();

$clicked = $document->get('clicked') ?? false;

if ($clicked) {
    $docRef->update([
        ['path' => 'reactions', 'value' => FieldValue::increment(-1)]
    ]);
} else {
    $docRef->update([
        ['path' => 'reactions', 'value' => FieldValue::increment(1)]
    ]);
}

$clicked = !$clicked;

$docRef->update([
    ['path' => 'clicked', 'value' => $clicked]
]);

header("Location: index.php?id=$id");

?>

// if(isset($_GET['id'])) {
// $id = $_GET['id'];
// $docRef = $db->collection('blogPosts')->document($id);
// $docRef->update([
// ['path' => 'reactions', 'value' => FieldValue::increment(1)]
// ]);
// header('Location: index.php');
// exit();
// }