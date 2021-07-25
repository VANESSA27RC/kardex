<?php
include("conn.inc.php");
if(isset ($_POST['consultar'])){
    $producto_select = $_POST['producto_select'];
}else{
    $producto_select = 0;
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
				<h1>CONSULTA DE MOVIMIENTOS POR PRODUCTO</h1>
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

                <form action="" method="post" name="datos">
                <table width="80%" align="center" border="1" cellpadding class="tablaverde">
                    <tr>
                        <td width="50%" align="rigth">
                        Lista de productos
                        </td>
                        <td width="50%" align="center">
                            <select name="producto_select" id="producto_select" size="1">
                                <option value="0">* Seleccione Producto</option>
                                <?php
                                $query = "SELECT *
                                        FROM productos
                                        ORDER BY nombre_producto";
                                $result = $db->Execute($query);
                                while ( ! $result->EOF) {
                                    $referencia = $result->fields[0];
                                    $nombre_producto = $result->fields[1];
                                    if($referencia == $producto_select){
                                        $marca ='selected';
                                    }else{
                                        $marca ='';
                                    }
                                ?>

                                <option <?php echo $marca; ?> value="<?php echo $referencia;?>"><?php echo $nombre_producto;?></option>

                                <?php
                                    $result->Movenext();
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                        <input type="submit" value="Consultar movimiento" name="consultar">
                        </td>
                    </tr>
                </table>
                </form>

				<H2>RELACION DE COMPRAS</H2>
				<?php
				$total_compras=0;
					$query="SELECT t1.*, t2.nombre_producto
					FROM movimiento AS t1
					LEFT JOIN productos AS t2 ON t1.referencia=t2.referencia
					WHERE t1.entra_sale='COMPRA' AND t1.referencia='$producto_select'" ;
					$result=$db->Execute($query);

					echo "Se encontraron ". $result->RecordCount()." registros";

				?>
				<table width="100%" align="center" border="1" cellpadding="5" class="tablaverde">
					<tr>
						<td width="20%" align="center">Fecha</td>
						<td width="10%" align="center"> Entra o sale</td>
						<td width="25%" align="center">Referencia</td>
						<td width="15%" align="center">Cantidad</td>
						<td width="15%" align="center">Vr. unidad</td>
						<td width="15%" align="center">Total</td>
					</tr>
					<?php
					while( ! $result->EOF){
						$fecha=$result->fields[0];
						$entra_sale=$result->fields[1];
						$referencia=$result->fields[2];
						$cantidad=$result->fields[3];
						$vr_unidad=$result->fields[4];
						$total=$result->fields[5];
						$nombre_producto=$result->fields[6];
						$total_compras = $total_compras+$total;
					?>
					<tr>
						<td align="center"><?php echo $fecha;?></td>
						<td align="center"><?php echo $entra_sale;?></td>
						<td align="center"><?php echo $referencia.'- '. $nombre_producto; ?></td>
						<td align="center"><?php echo $cantidad ; ?></td>
						<td align="right"><?php echo $vr_unidad ; ?></td>
						<td align="right"><?php echo number_format($total, 0, '.', ',') ; ?></td>
					</tr>
					<?php
						$result->MoveNext();
					}
					?>
				</table>

				Total de compras para este producto = <?php echo $total_compras; ?>

				<br> </br>

				
				<H2>RELACION DE VENTAS</H2>
				<?php 
				$total_ventas=0;
				$query="SELECT t1.*, t2.nombre_producto
				FROM movimiento AS t1
				LEFT JOIN productos AS t2 ON t1.referencia=t2.referencia
				WHERE t1.entra_sale='VENTA' AND t1.referencia='$producto_select'" ;
				$result=$db->Execute($query);

					echo "Se encontraron ". $result->RecordCount()." registros";

				?>
				<table width="100%" align="center" border="1" cellpadding="5" class="tablaverde">
					<tr>
						<td width="20%" align="center">Fecha</td>
						<td width="10%" align="center"> Entra o sale</td>
						<td width="25%" align="center">Referencia</td>
						<td width="15%" align="center">Cantidad</td>
						<td width="15%" align="center">Vr. unidad</td>
						<td width="15%" align="center">Total</td>
					</tr>
					<?php
					while( ! $result->EOF){
						$fecha=$result->fields[0];
						$entra_sale=$result->fields[1];
						$referencia=$result->fields[2];
						$cantidad=$result->fields[3];
						$vr_unidad=$result->fields[4];
						$total=$result->fields[5];
						$nombre_producto=$result->fields[6];
						$total_ventas = $total_ventas+$total;
					?>
					<tr>
						<td align="center"><?php echo $fecha;?></td>
						<td align="center"><?php echo $entra_sale;?></td>
						<td align="center"><?php echo $referencia.' - '.$nombre_producto; ?></td>
						<td align="center"><?php echo $cantidad ; ?></td>
						<td align="right"><?php echo $vr_unidad ; ?></td>
						<td align="right"><?php echo $total ; ?></td>
					</tr>
					<?php
						$result->MoveNext();
					}
					?>
				</table>
				Total de ventas para este producto = <?php echo $total_ventas; ?>
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
