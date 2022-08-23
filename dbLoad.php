<?php
require 'dbconnect.php';

$jsonPosts = file_get_contents('https://jsonplaceholder.typicode.com/posts');
$postsArray = json_decode($jsonPosts, true);

$jsonComments = file_get_contents('https://jsonplaceholder.typicode.com/comments');
$commentsArray = json_decode($jsonComments, true);
foreach ($postsArray as $item) 
{	
    $sql = "INSERT INTO posts (userId, id, title, body) VALUES (?, ?, ?, ?)" ;
	$stmt = $connect -> prepare($sql);
	$stmt -> bind_param('iiss', $item['userId'], $item['id'], $item['title'], $item['body']);	
	$stmt -> execute();
}
$posts = $connect -> prepare("SELECT * FROM posts");
$posts -> execute();
$posts -> store_result();
$pRows = $posts -> num_rows;


foreach ($commentsArray as $item) 
{	
    $sql = "INSERT INTO comments (postId, id, name, email, body) VALUES (?, ?, ?, ?, ?)" ;
	$stmt = $connect -> prepare($sql);
	$stmt -> bind_param('iisss', $item['postId'], $item['id'], $item['name'], $item['email'], $item['body']);
	$stmt -> execute();
}
$c = $connect -> prepare("SELECT * FROM comments");
$c -> execute();
$c -> store_result();
$cCount = $c -> num_rows;
echo "Загружено $pRows записей и $cCount комментариев";
$connect -> close();
?>