<?php

require_once __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\FieldPath;
use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient(
    array(
        'keyFilePath' => 'keys/activity4-zambrano-firebase-adminsdk-j10op-cbe54f7ac3.json',
        'projectId' => 'activity4-zambrano'
    )
);

?>

<!-- login session start -->
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

?>
<?php
// Search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$documents = [];

if (!empty($search)) {
    $query = $db->collection('blogPosts')->orderBy('title');
    $snapshot = $query->documents();

    foreach ($snapshot as $document) {
        $title = $document->get('title');
        if (str_contains(strtolower($title), strtolower($search))) {
            $documents[] = $document;
        }
    }
} else {
    $query = $db->collection('blogPosts');
    $documents = $query->documents();
}
?>

<!-- Connecting to google cloud Firestore -->
<?php

$collections = $db->collection('blogPosts');
$posts = $collections->documents();
?>


<!-- html document -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta title="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css"> -->

</head>

<body class="m-5">

    <nav class=" navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <form class="navbar-form me-auto" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" title="search" name="search" placeholder="Search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Result for search -->
    <?php if ($search) : ?>
        <h1 style = "color:white">Search Results for "
            <?= $search ?>"
        </h1>
    <?php endif; ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <title>Documents</title>

        <style>
            body {
                background-color: #202b38;
            }
        </style>

    </head>

    <body>
        <div class="container">
            <?php foreach ($posts as $post) {
            ?>

                <div class="col">
                    <div class="card mt-5 mb-5">
                        <div class="container align-item-center">
                            <h5>
                                <div class="card-header"> <?php echo $post['title'] ?>
                            </h5>
                        </div>
                        <div class="container align-item-center">
                            <div class="card-body">
                                <p class="card-text"><?php echo $post['content'] ?></p>
                            </div>
                            <hr>
                            <img class="rounded mx-auto d-block mb-3" src="<?php echo $post['image_url'] ?>" style="height:500px" alt="...">
                        </div>
                        <div class="card-footer">
                            <small class="card-text">Reactions: <?php echo $post['reactions'] ?></small> &emsp; &emsp;
                            <small class="card-text">
                                <a data-bs-toggle="collapse" href="#collapseExample<?php echo $post->id() ?>" role="button" aria-expanded="false" aria-controls="collapseExample<?php echo $post->id() ?>">
                                    Comments: <?php echo $post['comment_count'] ?>
                                </a>
                            </small>
                            <hr>
                            <div class="collapse" id="collapseExample<?php echo $post->id() ?>">
                                <div class="conatiner">
                                    <?php
                                    $commentsColRef = $db->collection("posts_comments")->where('post_id', '==', $post->id())->documents();

                                    foreach ($commentsColRef as $comment) { ?>
                                        <div class="card mb-2" style=" border-radius: 0.8em;box-shadow: 0 5px 10px rgba(0, 0, 0.4, 0.3);">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <img class="rounded-circle me-3 " style="height:2rem;width:2rem;flex-shrink: 0;" src="https://images.pexels.com/photos/6274712/pexels-photo-6274712.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="...">
                                                    <?php echo $comment['comment']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <form class="row g-3 form-control-sm" id="insertForm" method="POST" action="addcomment.php">
                                <div class="col-md-12 d-flex">
                                    <input type="text" class="form-control form-control-sm me-2 rounded-pill" name="comment" placeholder="Add comment">
                                    <input type="hidden" class="form-control form-control-sm" value="<?php echo $post->id() ?>" name="post_id">
                                    <button type="submit" class="btn btn-outline-primary rounded-pill" name="add_comments"><i class="bi bi-chat"></i></button>
                                </div>
                            </form>
                            <hr>
                            <a href="increment.php?id=<?php echo $post->id() ?>" class="rounded-circle btn btn-primary float-end mt-2"><i class="bi bi-heart"></i></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>

    </html>