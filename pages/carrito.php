<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/carrito_styles.css">
</head>
<body>

    <header>
		<h1>Carrito de compras</h1>
	</header>

	<main>

		<section class="items">
			<h2>Artículos en el carrito</h2>
			<ul>
				<li>
					<img src="../img/XR150L.jpg" alt="Producto 1">
					<div class="item-info">
						<h3>Producto 1</h3>
						<p class="price">$7.000.000</p>
						<label for="cantidad-1">Cantidad:</label>
						<input type="number" id="cantidad-1" name="cantidad-1" min="1" value="1">
						<button class="cancelar" type="button">Cancelar</button>
					</div>
				</li>
				<li>
					<img src="https://picsum.photos/100" alt="Producto 3">
						<div class="item-info">
						<h3>Producto 3</h3>
						<p class="price">$30.00</p>
						<label for="cantidad-3">Cantidad:</label>
						<input type="number" id="cantidad-3" name="cantidad-3" min="1" value="1">
						<button class="cancelar">Cancelar</button>
					</div>
				</li>
			</ul>

		</section>
		<section class="resumen">

			<div class="title-resumen">
				<h2>Resumen de la compra</h2>
			</div>

			<table>
				<thead>
					<tr>
						<th>Producto</th>
						<th>Cantidad</th>
						<th>Precio</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>XR 150L</td>
						<td><input type="number" name="cantidad-1" min="1" value="1"></td>
						<td>$7.000.000</td>
					</tr>
					<tr>
						<td>Producto 2</td>
						<td><input type="number" name="cantidad-2" min="1" value="1"></td>
						<td>$20.00</td>
					</tr>
					<tr>
						<td>Producto 3</td>
						<td><input type="number" name="cantidad-3" min="1" value="1"></td>
						<td>$30.00</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="2">Total</th>
						<td>$7.000.000</td>
					</tr>
				</tfoot>
				
			</table>

			<button>Pagar</button>

		</section>

	</main>
    
</body>
</html>