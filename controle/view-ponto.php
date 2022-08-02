<!DOCTYPE html>
<html>
<head>
  <style>
  		
      html{	font-family: Arial;
			display: inline-block;
			margin: 0px auto;
			text-align: center;
		}

		ul.topnav {
			list-style-type: none;
			margin: auto;
			padding: 0;
			overflow: hidden;
			background-color: #4CAF50;
			width: 70%;
		}

		ul.topnav li {float: left;}

		ul.topnav li a {
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		ul.topnav li a:hover:not(.active) {color:#c90e0e; background-color: #3e8e41;}

		ul.topnav li a.active {background-color: #333;}

		ul.topnav li.right {float: right;}

		@media screen and (max-width: 600px) {
			ul.topnav li.right, 
			ul.topnav li {float: none;}
		}
		

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    text-align: left;
    padding: 8px;
    padding-left: 5px;
  }

  tr:nth-child(even){background-color: #f2f2f2}

  .th-controle {
    background-color: #4CAF50;
    color: white;
  }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="shortcut icon" href="./img/icone.png" type="image/x-icon">
</head>
<body>

<h2 align="center">Controle De Ponto Josafa Eletronica</h2>
		<ul class="topnav">
			<li><a href="home.php">Home</a></li>
			<li><a href="user data.php">Dados Usuario</a></li>
			<li><a href="registration.php">Registrar</a></li>
			<li><a class="active" href="read tag.php">Ler Id</a></li>
		</ul>
		
		<br>

  <table>
    <thead>
      <tr>
        <th class="th-controle">Log Id</th>
        <th class="th-controle">Card Id</th>
        <th class="th-controle">Horario Entrada</th>
        <th class="th-controle">Horario Saída</th>
      </tr>
    <thead>

    <tbody id="logs">
    </tbody>
  </table>

  <script type="text/javascript">

    $(document).ready(function(){
      function showData()
      { 
        $.ajax({

          url: 'log.php',
          type: 'POST',
          data: {action : 'showLogs'},
          dataType: 'html',
          success: function(result)
          {
            $('#logs').html(result);
          },
          error: function()
          {
            alert("Failed to fetch logs!");
          }
        })
      }

      //Fetch rfid logs in database every 2.5 seconds
      setInterval(function(){ showData(); }, 2500);
    });



  </script>
</body>
</html>
