<html>
<head>
    <title>Registracijos forma</title>
</head>
<body>
    <div class="header">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Abouts us</a></li>
            <li><a href="#">some page</a></li>
            <li><a href ='#'>log in</a></li>
        </ul>

    </div>
    <div class="content">
        <h1>Registracija</h1>
        <p>Prasome uzpildyti forma</p>
        <form action="functions.php" method="post">
            <input type="name" name="name" placeholder="Vardas">
            <input type="surname" name="surname" placeholder="Pavarde">
            <input type="email" name="email" placeholder="el.pastas">
            <input type="password" name="password" placeholder="slaptazodis">
            <input type="password" name="password2" placeholder="pakartoti_slaptazodi">
            <input type="submit" value="OK" name="create">

        </form>
    </div>
</body>
</html>






