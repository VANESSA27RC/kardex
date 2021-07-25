<html>
<head>
	<title>Sistema de Compras y Ventas</title>
	<link rel='stylesheet' type='text/css' href='./css/styles.css'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>

<center>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td width="100%" bgcolor="#FF9900">
		<br>
		<?php
		require('x_encabezado2.php');
		?>
		<br>
	</td>
</tr>
<tr>
	<td width="100%" height="100%" valign="top">
		<br>
		<br>

		<!-- Cuerpo de la página -->
		<table width="100%" border="0" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF">
		<tr>
			<td colspan="2" align="center">
				<h1>ESTADÍSTICAS GENERALES</h1>
				<?php
				require('x_menu.php');
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">

				<br>
				<br>

				<!-- Tabla de salida -->

				<?php
				include("conn.inc.php");
				$query = "SELECT SUM(total), SUM(cantidad)
						FROM movimiento
						WHERE entra_sale = 'COMPRA'";
				$result= $db->Execute($query);
				$tcompra = $result->fields[0];
				$tcomprau = $result->fields[1];

				$query = "SELECT SUM(total), SUM(cantidad)
				FROM movimiento
				WHERE entra_sale = 'VENTA'";
				$result= $db->Execute($query);
				$tventa = $result->fields[0];
				$tventau= $result->fields[1];

				?>


				<table width="80%" align="center" border="1" class="tablaverde">
				<tr>
				<td width="50%" align="center">
				<b>Items</b>
				</td>
				<td width="25%" align="center">
				<b>Valor</b>
				</td>
				<td width="25%" align="center">
				<b>Cantidades</b>
				</td>
				</tr>

				<tr>
				<td>
				Total de compras
				</td>
				<td>
				<?php echo number_format($tcompra, 0, '.', ',');?>
				</td>
				<td>
				<?php echo number_format($tcomprau, 0, '.', ',');?>

				</td>
				</tr>

				<tr>
				<td>
				Total de ventas
				</td>
				<td>
				<?php echo number_format($tventa, 0, '.', ',');?>

				</td>
				<td>
				<?php echo number_format($tventau, 0, '.', ',');?>

				</td>
				</tr>

				</table>
				<!-- FIN - Tabla de salida -->

			</td>
		</tr>
		</table>
		<!-- FIN - Cuerpo de la página -->

		<br>
		<br>
	</td>
</tr>
<tr>
	<td width="100%" bgcolor="#FF9900">
		<?php
		require('x_pie.php');
		?>
	</td>
</tr>
</table>	
</center>
</body>
</html>
