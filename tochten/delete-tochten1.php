<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>delete-tocht1.php</title>
</head>
<body>
<h1>Delete tocht 1</h1>
<p>
    dit formulier zoekt een tocht op uit
    de table tochten van database donkey_travel
    om hem te kunnen verwijderen.
</p>
<form action="delete-tocht2.php" method="post">
    welk tocht wilt u gaan verwijderen?
    <input type="int" name="id"> <br />
    <input type="submit">
</form>
</body>
</html>