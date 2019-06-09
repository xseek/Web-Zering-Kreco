<?php
require '../vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=srv10.domenice.net;dbname=biznet_cars','biznet_cars','a}91g]27#&%~'));

Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /cars', function(){
    $cars = Flight::db()->query('SELECT * FROM cars', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($cars);
});

Flight::route('POST /cars', function(){
    $request = Flight::request()->data->getData();
    if (isset($request['id']) && $request['id'] !=''){
      $update = "UPDATE cars SET name= :name, power = :power, year = :year, fuel = :fuel, ccm = :ccm WHERE id=:id";
      $stmt= Flight::db()->prepare($update);
      $stmt->execute($request);
      Flight::json(['message' => "Car ".$request['name']." has been updated successfully"]);
    }else{
      unset($request['id']);
      $insert = "INSERT INTO cars (name, power, year, fuel, ccm) VALUES(:name, :power, :year, :fuel, :ccm)";
      $stmt= Flight::db()->prepare($insert);
      $stmt->execute($request);
      Flight::json(['message' => "Car ".$request['name']." has been added successfully"]);
    }
});

Flight::route('DELETE /cars/@id', function($id){
  $query = "DELETE FROM cars WHERE id = :id";
  $stmt= Flight::db()->prepare($query);
  $stmt->execute(['id' => $id]);
  Flight::json(['message' => "Car has been deleted successfully"]);
});

Flight::route('GET /cars/@id', function($id){
  $query = "SELECT * FROM cars WHERE id = :id";
  $stmt= Flight::db()->prepare($query);
  $stmt->execute(['id' => $id]);
  $car = $stmt->fetch(PDO::FETCH_ASSOC);
  Flight::json($car);
});

Flight::start();
?>
