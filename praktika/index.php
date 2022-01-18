<html>
<head>
    <title>Titlas for calculator</title>
</head>

<body>

<form>
    <input type="text" name="num1" placeholder="numeris1">
    <input type="text" name="num2" placeholder="numeris2">
    <select name="operator">
        <option>None</option>
        <option>Add</option>
        <option>Subtract</option>
        <option>Multiply</option>
        <option>Divide</option>
    </select>
    <br>
    <button type="submit" name="submit" value="submit">Skaiciuoti</button>

</form>
<p>Atsakymas yra:</p>
<?php
    if (isset($_GET['submit'])) {
        $result1 = $_GET['num1'];
        $result2 = $_GET['num2'];
        $operator = $_GET['operator'];
        switch ($operator) {
            case "None":
                echo "Tu turi pasirinkti kita metoda";
                break;
                //sudetis
                case "Add":
                    echo $result1 + $result2;
                break;
                //atimtis
                case "Subtract":
                    echo $result1 - $result2;
                break;
                //daugyba
                case "Multiply":
                    echo $result1 * $result2;
                break;
                //dalyba
                case "Divide":
                    echo $result1 / $result2;
                break;
        }

    }

?>





</body>

</html>

