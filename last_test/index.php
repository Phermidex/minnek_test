<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <title>System message with JSON</title>
    <link rel="stylesheet" href="test.css">
  </head>
  <body>
    <h1 class="text-center text-primary bg-gray">System message with JSON</h1>
    <div class="container">
    	<div class="row">
<?php 


include('Contacts.php');



$my = new model();

///definir valores de get.
$fistName 		= $my->input_post('fistName');
$lastName 		= $my->input_post('lastName');
$email 	= $my->input_post('email');
$message 	= $my->input_post('message');

echo "<div class='col-md-12'>";
	$my->get_all_duplicates();
echo "</div>";
//Formulario de ingreso de nuevo contacto.
echo "<div class='card col-md-3'>
			<div class='card-body'>
			<form method='post'>";
	echo "<label>Fist Name</label><br/>";
	echo "<input class='form-control' type='text' required  name='fistName'><br/>";
	echo "<label>Last Name</label><br/>";
	echo "<input class='form-control' type='text' required  name='lastName'><br/>";
	echo "<label>Email</label><br/>";
	echo "<input class='form-control' type='email' required name='email'><br/>";
  echo "<label>Message</label><br/>";
	echo "<textarea class='form-control' required name='message'></textarea><br/>";
	echo "<button class='btn btn-primary' type='submit'>Save</button>";
echo "</form></div></div>";

//Tabla con los datos de contactos.
$my->pull_set_duplicates($my->input_post('contacts'));
if($my->input_get('duplicates')){
  $my->get_contacts($my->input_get('duplicates'));
}


//Filtro de validacion de datos vacios.
if($fistName != '' and $lastName != '' and $email != '' and $message != ''){

	//Funsion que crea un nuevo contactos si no existe.
	$my->put_contacts($fistName,$lastName,$email,$message);
  echo "<div class='card col-md-3'>";
	echo "<br/>Fist name: ".$fistName."<br/>Last name: ".$lastName."<br/>Email: ".$email."<br/>Message: ".$message."<hr/>";
  echo "</div>";
	$my->refresh(4);
}

exit();

?>
    	</div>
    </div>
  </body>
</html>