<?php
/**
 * @var PDO $pdo
 */

global $pdo;

// start session

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    if(isset($_POST['logout'])) {
        session_unset();
        header("Location: ../login");
        exit();
    }
}
$statement = $pdo->prepare("  SELECT  
            c.name AS car_name,
            c.price AS price,
            c.image_path AS image_path
        FROM 
            carts ca
        JOIN 
            cars c ON ca.car_id = c.id
        JOIN 
            users u ON ca.user_id = u.id
        WHERE 
            u.id = :user_id;

    ");

$statement->bindParam(':user_id', $_SESSION["user"]);
$statement->execute();
$cars = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement2 = $pdo->prepare("SELECT COUNT(*) FROM carts WHERE user_id = :userID");
$statement2->bindParam(':userID', $_SESSION["user"]);
$statement2->execute();
$itemCount = $statement2->fetchColumn();

?>


<!DOCTYPE html>
<html>

<head >
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE+edge" />
     <title>Carts</title>
    <meta name="Descriptions" content="this is our  store" />
    <link rel="stylesheet" href="/assets/carts.css">
    <style>
        .total-price{
            width: 387px;
            height: 0px;

            font-family: 'Roboto';
            font-style: normal;
            font-weight: 600;
            font-size: 28px;
            line-height: 18px;

            /* white */
            color: #00728D;

        }
        .cart2{
            left: 0px;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }

        .paraa{
            height: 100px;

        }
        .car-image {
            width: 150px;
            height: 150px;
        }
        .welcome {
            position: relative;
            top: 110px;
            left: 20px;
        }
        .table{
            position: relative;
            top: 120px;
            left: 20px;
        }
        button{
            border: none;
            outline: none;
            color: #FFFFFF;

            background-color: #00728D;
            position: relative;
            left: 985px;
        }
        button:hover{
            background-color: #0f97b6;
    </style>

</head>
<body>

<header class="header">
    <div class="header2">
        <div>
            <img class="img" src="./images/Logo-Primary bg (1).png" alt="" >
        </div>
        <div >
            <img class="location" src="./images/Location.png" alt="">

        </div>
        <div class="search">
            <form action=""></form>
            <input  class="search2" type="text" value="Search Aladdin"  >
            <select class="selsectCategories">
                <option>All Categories</option>
                <option>fares</option>
                <option>ahmed</option>
                <!-- Add more categories here -->
            </select>
        </div >
        <img class="flag" src="./images/Frame 73.png" alt="">

        <div class="text1">
            <p class="text1">Hello, Kiran <br><span class="spann">Account for Eshopify...</span></p>
        </div>
        <div class="cart1" id="cart1">
            <button class="cart2">Cart<span class="countt"><?=" ". htmlspecialchars($itemCount) ?></span></button>
            <img class="card3" src="./images/add_shopping_cart.png" alt="">
        </div>
        <div>
            <form method="POST" action="">
                <button type="submit" name="logout" class="butt" style="width:auto;">LOG OUT</button>
            </form>
        </div>
    </div>
</header>


<div class="hh">

</div>

<?php
if ($cars) {
echo "<table class='table'>
    <tr>
        <th>ID</th>
        <th>Car Name</th>
        <th>Price</th>
        <th>Car image</th>

    </tr>";
    $rowNumber = 1;

    foreach ($cars as $car) {
        $totalPrice += $car['price'];
        echo "<tr>
            <td>" . $rowNumber . "</td>
            <td>" . htmlspecialchars($car['car_name']) . "</td>
            <td>$" . htmlspecialchars($car['price']) . "</td>
            <td><img src='" . htmlspecialchars($car['image_path']) . "' class='car-image'></td>

        </tr>";
        $rowNumber++;
    }
    echo "<td>" . htmlspecialchars("") . "</td>";
    echo "<td>" . htmlspecialchars("") . "</td>";
    echo "<td class='total-price'>Total Price: $" . htmlspecialchars($totalPrice) . "</td>";
    echo "<td>" . htmlspecialchars("") . "</td>";
    echo "</table>";



} else {
echo "<p>No cars found for user: " . htmlspecialchars($_SESSION["user"]) . "</p>";
}

echo "</body>
</html>"
?>

