<?php
	/* CONEXIÓN E INSTANCIA DE PDO */
	try{
	$bd = 'bczwqhrn_guerra';
	$user = 'bczwqhrn_guerra';
	$pass = '291160';
	$conn = new PDO('mysql:host=localhost;dbname=bczwqhrn_guerra', $user, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "ERROR: " . $e->getMessage();
	}
	/* RECIBO LAS VARIABLES DEL FORM */
	$usuario = $_POST['usuario'];
	$sexo = $_POST['sexo'];


	/* INSERTO EN LA BD */
				/* NOTA: LAS COMPROBACIONES SE REALIZAN DE PARTE DEL CLIENTE */
	try { 
       $conn->query('INSERT INTO usuarios (usuarios, sexo) VALUES ("'.$usuario.'", "'.$sexo.'")'); 
       header("Location: ../index.php");
    } catch(PDOExecption $e) { 
        $conn->rollback(); 
        print "Error!: " . $e->getMessage() . "</br>"; 
    } 
?>