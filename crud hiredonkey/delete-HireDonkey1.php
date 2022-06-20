<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>delete-HireDonkey.php</title>
</head>
<body>
<h1>Delete DonkeyAppointment 1</h1>
<p>
    dit formulier zoekt een DonkeyAppointment op uit
    de table appointments van database DonkeyAppointment
    om hem te kunnen verwijderen.
</p>
<form action="delete-HireDonkey2.php" method="post">
    welk DonkeyAppointment wilt u verwijderen?
    <input type="text" name="appointmentid"> <br />
    <input type="submit">
</form>
</body>
</html>