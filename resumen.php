<?php
include "conn.inc.php";
if (isset($_POST['resumen'])) {
    $movimiento_select = $_POST['movimiento_select'];
} else {
    $movimiento_select = 0;
}
?>


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
require 'x_encabezado2.php';
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
				<h1>RESUMEN DE PRODUCTOS</h1>
				<?php
require 'x_menu.php';
?>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">

				<br>
				<br>

				<!-- Tabla de salida -->

				<form action="" method="post" name="datos">
					<table width="80%" align="center" border="1" cellpadding class="tablaverde">
						<tr>
							<td width="50%" align="rigth">
							Lista de Movimientos
							</td>
							<td width="50%" align="center">
								<select name="movimiento_select" id="movimiento_select" size="1">
									<option value="0">* Seleccione movimiento</option>
									<?php
										$query = "SELECT entra_sale FROM `movimiento` GROUP BY entra_sale";
										$result = $db->Execute($query);
										while (!$result->EOF) {
											$entra_sale = $result->fields[0];
											if ($entra_sale == $movimiento_select) {
												$marca = 'selected';
											} else {
												$marca = '';
											}
											?>
										|	<option <?= $marca; ?> value="<?= $entra_sale; ?>"><?= $entra_sale; ?></option>
									<?php
											$result->Movenext();
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">
							<input type="submit" value="Consultar movimiento" name="resumen">
							</td>
						</tr>
					</table>
                </form>

				<?php
					include "conn.inc.php";
					$query = "SELECT p.nombre_producto, SUM(m.cantidad), SUM(m.total)
						FROM productos AS p
						LEFT JOIN movimiento AS m ON m.referencia = p.referencia
						WHERE m.entra_sale='" . $movimiento_select . "' GROUP BY p.nombre_producto";

					$result = $db->Execute($query);
				?>
				<table width="100%" align="center" border="1" cellpadding="5" class="tablaverde">
					<tr>
						<td width="15%" align="center">Producto </td>
						<td width="10%" align="center"> Cantidad</td>
						<td width="30%" align="center">Valor Total</td>
					</tr>
					<?php
						while (!$result->EOF) {
							$nombre_producto = $result->fields[0];
							$cantidad = $result->fields[1];
							$total = $result->fields[2];
					?>
							<tr>
								<td align="center"><?php echo $nombre_producto; ?></td>
								<td align="center"><?php echo $cantidad; ?></td>
								<td align="center"><?php echo $total; ?></td>
							</tr>
					<?php
							$result->MoveNext();
						}
					?>

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
require 'x_pie.php';
?>
	</td>
</tr>
</table>
</center>
</body>
</html>
