<?php
require '../vendor/autoload.php';

Flight::register('db', 'PDO', array('mysql:host=localhost:3306;dbime=parking','root',''));


Flight::route('/', function(){
    echo 'hello world!';
});

Flight::route('GET /car', function(){
  $car = Flight::db()->query('select * from car', PDO::FETCH_ASSOC)->fetchAll();
  Flight::json($car);
});

Flight::route('GET /car', function(){
    $car = Flight::db()->query('select * from car', PDO::FETCH_ASSOC)->fetchAll();
    Flight::json($car);
});

Flight::route('POST /car', function(){
    $request = Flight::request()->data->getData();
    if (isset($request['id']) && $request['id'] !=''){
      $update = "UPDATE car SET ime= :ime, lokacija = :lokacija, velicina = :velicina WHERE id=:id";
      $stmt= Flight::db()->prepare($update);
      $stmt->execute($request);
      Flight::json(['message' => "Parking ".$request['ime']." prepravljen uspjesno "]);
    }else{
      unset($request['id']);
      $insert = "INSERT INTO car (ime, lokacija, velicina,) VALUES(:ime, :lokacija, :velicina)";
      $stmt= Flight::db()->prepare($insert);
      $stmt->execute($request);
      Flight::json(['message' => "Parking ".$request['ime']." dodan uspjesno"]);
    }
});

Flight::route('DELETE /car/@id', function($id){
  $query = "DELETE FROM car WHERE id = :id";
  $stmt= Flight::db()->prepare($query);
  $stmt->execute(['id' => $id]);
  Flight::json(['message' => "Parking uspjesno obrisan"]);
});

Flight::route('GET /car/@id', function($id){
  $query = "SELECT * FROM car WHERE id = :id";
  $stmt= Flight::db()->prepare($query);
  $stmt->execute(['id' => $id]);
  $car = $stmt->fetch(PDO::FETCH_ASSOC);
  Flight::json($car);
});

Flight::start();
?>
