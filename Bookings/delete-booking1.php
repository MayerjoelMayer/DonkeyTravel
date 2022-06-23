<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>delete-booking.php</title>
</head>
<body>
<h1>Delete booking 1</h1>
<p>
    dit formulier zoekt een Booking op uit
    de table bookings van database donkey_travel
    om hem te kunnen verwijderen.
</p>
<form action="delete-booking2.php" method="post">
    welk booking wilt u gaan verwijderen?
    <input type="int" name="id"> <br />
    <input type="submit">
</form>
</body>
</html>