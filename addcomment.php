<?php
require_once __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\FirestoreClient;

//pag meron kana login $id = SESSION['id']; 
$id = $_SESSION['user_id'];
$db = new FirestoreClient([
    'keyFilePath' => 'keys/activity4-zambrano-firebase-adminsdk-j10op-cbe54f7ac3.json',
    'projectId' => 'activity4-zambrano'
]);

if (isset($_POST['post_id']) && isset($_POST['comment']) && $_POST['comment'] != null) {
    $comment = $_POST['comment'];
    $post_id = $_POST['post_id'];


    $postsColRef = $db->collection("posts_comments");
    $id = $postsColRef->add([
        'comment' => $comment,
        'user_id' => $id,
        'post_id' => $post_id,
        'date' => FieldValue::serverTimestamp()

    ]);
    $postsDocRef = $db->collection("blogPosts");
    $post = $postsDocRef->document($post_id)->snapshot();
    $comment_count = $post['comment_count'];
    $postsDocRef->document($post_id)->set([
        'comment_count' => ++$comment_count
    ], ['merge' => true]);
    header('Location:index.php');
}
