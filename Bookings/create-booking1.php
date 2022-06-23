<!doctype html>
<html lang="nl">
<head>
    <meta name="author" content="Project">
    <meta charset="UTF-8">
    <title>create-booking1.php</title>
</head>
<body>
<h1>book an appointment!</h1>
<p>
    dit formulier wordt gebruikt om een Booking te plaatsen.
</p>
<form action="create-booking2.php" method="post">
FKtochtenID: <input type="int" name="FKtochtenID"> <br />
FKstatussenID: <input type="int" name="FKstatussenID"> <br />
FKusersID:       <input type="int"  name="FKusersID">       <br />
PINCode:      <input type="int"  name="PINCode">      <br />
StartDate:     <input type="date"  name="StartDate">     <br />
    <input type="submit">
</form>
</body>
</html>