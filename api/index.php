<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=hotel', 'user', 'user');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

function addNewApplication($dbh, $destination, $checkin, $checkout, $rooms, $adults, $children) {
    $sql = 'INSERT INTO applications (location, start_date, end_date, rooms, adults, children) VALUES (:location, :start_date, :end_date, :rooms, :adults, :children)';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':location', $destination, PDO::PARAM_STR);
    $stmt->bindValue(':start_date', $checkin, PDO::PARAM_STR);
    $stmt->bindValue(':end_date', $checkout, PDO::PARAM_STR);
    $stmt->bindValue(':rooms', $rooms, PDO::PARAM_INT);
    $stmt->bindValue(':adults', $adults, PDO::PARAM_INT);
    $stmt->bindValue(':children', $children, PDO::PARAM_INT);
    $stmt->execute();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
//    print_r($_POST['data']);
    $destination = strip_tags(trim($_POST['data'][0]['value']));
    $checkin = strip_tags(trim($_POST['data'][1]['value']));
    $checkout = strip_tags(trim($_POST['data'][2]['value']));
    $rooms = strip_tags(trim($_POST['data'][3]['value']));
    $adults = strip_tags(trim($_POST['data'][4]['value']));
    $children = strip_tags(trim($_POST['data'][5]['value']));
    echo $destination."\n".$checkin."\n".$children;
    addNewApplication($dbh, $destination, $checkin, $checkout, $rooms, $adults, $children);
}

?>
