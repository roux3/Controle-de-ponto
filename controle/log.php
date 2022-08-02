<?php 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])){
	switch ($_POST['action']) {
		case 'insertRfIdLog':
		insertRfIdLog();
		break;


		case 'showLogs':
		showLogs();

		default:

		break;
	}
}


function insertRfIdLog() {
    include 'database.php';
	$cardid = $_POST['cardid'];

	$pdo = Database::connect();

    
	$time = time();
	$dia = date("Y-m-d", $time);

	$info_name = $pdo->query("SELECT name FROM `table_the_iot_projects` WHERE id='$cardid'");
	$result = $info_name->fetch();
	$nome = $result['name'];


	$verify = $pdo->query("SELECT * FROM `tbllogs` WHERE time >= '$dia 00:00:00' AND time <= '$dia 23:59:59' AND nome='$nome'");

	$test = $verify->rowCount();

	$colunm = $verify->fetchColumn();
	

	if(!$test or $colunm != $nome){



		$stmt = $pdo->prepare("INSERT INTO `tbllogs`(`nome`, `logdate_entrada`) VALUES (:nm, :dt)");
		$stmt->bindParam(":nm", $nome);
		$stmt->bindParam(":dt", $time);
		$stmt->execute();
	

		echo "success";

	}

	

	else{

		
		$cardid = $_POST['cardid'];
		$info_name = $pdo->query("SELECT name FROM `table_the_iot_projects` WHERE id='$cardid'");
		$result = $info_name->fetch();
		$nome = $result['name'];


		$stmt = $pdo->prepare("UPDATE `tbllogs` set logdate_saida=:dt WHERE time >= '$dia 00:00:00' AND time <= '$dia 23:59:59' AND nome='$nome'");
		$stmt->bindParam(":dt", $time);
		$stmt->execute();
	

		echo "success";

	}

	


	
}

function showLogs()
{
	include 'database.php';

	$pdo = Database::connect();
	
	//$now = new DateTime('now');
	$now = time();
	$previous = date('Y-m', $now);
	echo "<h1>".$previous."</h1>";
	$del = $pdo->prepare("DELETE FROM `tbllogs` WHERE time <= '2021-09-01 00:00:00'");
	$del->execute();
	

	$logs = $pdo->query("SELECT * FROM `tbllogs`");
	while($r = $logs->fetch()){

		echo "<tr>";
		echo "<td>".$r['logid']."</td>";
		echo "<td>".$r['nome']."</td>";
		$date_enter = date("d/m/Y, G:i", $r["logdate_entrada"]);
		echo "<td>".$date_enter."</td>";
	
		if($r['logdate_saida'] != 0){
			$date_saida = date("d/m/Y, G:i", $r["logdate_saida"]);
			echo "<td>".$date_saida."</td>";
		}

		
		
		echo "</tr>";
	}
}




?>
