<!DOCTYPE html>
<html>
<head>
<title>Поиск</title>
<meta charset="UTF-8">
<style>
.table, th, td
  {
    border-spacing: 2px;
    border: 1px solid black;
  }
</style>
</head>
<body>
<form action="" method="GET">
        <input type="text" name="query" placeholder="Введите текст..."/>
		<input type="submit" name="submit" value="Найти" />
</form>
<?php
require 'dbconnect.php';

if(isset($_GET['query'])) {
	$query = $_GET['query'];
	if(strlen($query) >= 3){
        $sql = "SELECT p.title, c.body FROM posts AS p INNER JOIN comments AS c ON c.postid = p.id WHERE c.body LIKE ?";
        $stmt = $connect -> prepare($sql);
		$query = "%" . $query . "%";
		$stmt -> bind_param('s', $query);
		$stmt -> execute();
		$row = $stmt -> get_result()->fetch_all(MYSQLI_ASSOC);
		$stmt -> close(); }
	else {
		echo "Введите как минимум 3 символа"; }

if (isset($row)){
	if (count($row) > 0){
		echo "<h2>Результаты</h2>";
		echo "<table><tr><th>Запись</th><th>Комментарий</th></tr>";
		foreach ($row as $rows) {
			echo("<tr><td>{$rows['title']}</td><td>{$rows['body']}</td></tr>"); }
} 	else {
		echo "Нет совпадений";}

echo "</table>";
}
}
?>
</body>
</html>