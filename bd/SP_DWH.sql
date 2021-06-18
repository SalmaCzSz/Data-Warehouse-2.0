-- BD VENTAS_PROY
-- prueba sp_fecha_vta
select fecha_vta from venta where YEAR(fecha_vta) =  YEAR(GETDATE()) AND MONTH(fecha_vta) = MONTH(GETDATE());


-- BD DW
USE DW;
select * from HechosVentas;
select * from Dimtienda;
select * from DimCliente;
select * from DimArticulo;
SELECT * FROM Dimtiempo;

GO
CREATE PROCEDURE sp_HechosVentas
AS
BEGIN
	SELECT HechosVentas.id_venta, CAST (DimTiempo.fecha AS varchar) as fecha,
		   DimTienda.nomb_tienda, DimCliente.nomb_cte, DimArticulo.nomb_art, 
		   HechosVentas.cantidad, HechosVentas.monto_venta, HechosVentas.monto_costo
		FROM HechosVentas JOIN DimTiempo ON HechosVentas.fecha = DimTiempo.fecha
			JOIN DimTienda ON HechosVentas.id_tienda = DimTienda.id_tienda
			JOIN DimCliente ON HechosVentas.id_cliente = DimCliente.id_cliente
			JOIN DimArticulo ON HechosVentas.id_art = DimArticulo.id_art
END
EXEC sp_HechosVentas

GO
CREATE PROCEDURE sp_TotalVentasAnio
AS
BEGIN
	SELECT SUM(HechosVentas.monto_venta) as monto_total
		FROM HechosVentas 
		Where YEAR(HechosVentas.fecha) = '' + YEAR(GETDATE()) + ''
END
EXEC sp_TotalVentasAnio

GO

CREATE PROCEDURE sp_ClienteDelMes
AS
	declare @mesactual int;
		SET @mesactual = MONTH(GETDATE());
	declare @anioactual int;
		SET @anioactual = YEAR(GETDATE());
BEGIN
	IF NOT EXISTS(
		SELECT * FROM DimTiempo 
			WHERE MONTH(DimTiempo.fecha) = CAST(@mesactual as varchar) 
			AND YEAR(DimTiempo.fecha) = CAST(@anioactual as varchar)
	)
	BEGIN
		SET @mesactual = @mesactual-1;
	END
	 
	IF(@mesactual = '1')
	BEGIN
		set @mesactual = '12';
		set @anioactual = @anioactual-1;
	END

	SELECT DimCliente.nomb_cte, SUM(HechosVentas.cantidad) 'Productos Adquiridos'
		FROM HechosVentas JOIN DimCliente ON HechosVentas.id_cliente = DimCliente.id_cliente
		JOIN DimTiempo ON DimTiempo.fecha = HechosVentas.fecha
		WHERE MONTH(HechosVentas.fecha) = CAST((@mesactual) as varchar) 
		AND YEAR(HechosVentas.fecha) = CAST(@anioactual as varchar)
		GROUP BY DimCliente.nomb_cte
		ORDER BY SUM(HechosVentas.Cantidad) DESC;
END
EXEC sp_ClienteDelMes

GO
CREATE PROCEDURE sp_TiendaMasVentas
AS
	declare @mesactual int;
		SET @mesactual = MONTH(GETDATE());
	declare @anioactual int;
		SET @anioactual = YEAR(GETDATE());
BEGIN
	IF NOT EXISTS(
		SELECT * FROM DimTiempo 
			WHERE MONTH(DimTiempo.fecha) = CAST(@mesactual as varchar) 
			AND YEAR(DimTiempo.fecha) = CAST(@anioactual as varchar)
	)
	BEGIN
		SET @mesactual = @mesactual-1;
	END
	 
	IF(@mesactual = '1')
	BEGIN
		set @mesactual = '12';
		set @anioactual = @anioactual-1;
	END

	SELECT DimTienda.nomb_tienda, COUNT(HechosVentas.id_venta) 'Num Ventas'
		FROM HechosVentas JOIN DimTienda ON HechosVentas.id_tienda = DimTienda.id_tienda
		WHERE MONTH(HechosVentas.fecha) = CAST((@mesactual) as varchar) 
		AND YEAR(HechosVentas.fecha) = CAST(@anioactual as varchar)
		GROUP BY DimTienda.nomb_tienda
		ORDER BY SUM(HechosVentas.id_venta) DESC;
END
EXEC sp_TiendaMasVentas

GO
CREATE PROCEDURE sp_ProductoMasVendido
AS
	declare @mesactual int;
		SET @mesactual = MONTH(GETDATE());
	declare @anioactual int;
		SET @anioactual = YEAR(GETDATE());
BEGIN
	IF NOT EXISTS(
		SELECT * FROM DimTiempo 
			WHERE MONTH(DimTiempo.fecha) = CAST(@mesactual as varchar) 
			AND YEAR(DimTiempo.fecha) = CAST(@anioactual as varchar)
	)
	BEGIN
		SET @mesactual = @mesactual-1;
	END
	 
	IF(@mesactual = '1')
	BEGIN
		set @mesactual = '12';
		set @anioactual = @anioactual-1;
	END

	SELECT DimArticulo.nomb_art, COUNT(HechosVentas.cantidad) 'Num Ventas'
		FROM HechosVentas JOIN DimArticulo ON HechosVentas.id_art = DimArticulo.id_art
		WHERE MONTH(HechosVentas.fecha) = CAST((@mesactual) as varchar) 
		AND YEAR(HechosVentas.fecha) = CAST(@anioactual as varchar)
		GROUP BY DimArticulo.nomb_art
		ORDER BY COUNT(HechosVentas.cantidad) DESC;
END
EXEC sp_ProductoMasVendido

GO
CREATE PROCEDURE sp_IngresosMes @mes int
AS
BEGIN
	Select SUM(HechosVentas.monto_venta) Total
		FROM HechosVentas 
		WHERE MONTH(HechosVentas.fecha) = @mes and YEAR(HechosVentas.fecha) = YEAR(GETDATE())
END
EXEC sp_IngresosMes 1;

GO
CREATE PROCEDURE sp_ProductosTienda @sucursal varchar(15)
AS
	declare @mes int;
		set @mes = MONTH(GETDATE());
	declare @anio int;
		set @anio = YEAR(GETDATE());
BEGIN
	IF(@mes = '1')
	BEGIN
		set @mes = '12';
		set @anio = @anio-1;
	END

	Select DISTINCT DimArticulo.nomb_art Articulos
		FROM DimArticulo JOIN HechosVentas ON DimArticulo.id_art = HechosVentas.id_art
		JOIN DimTienda ON DimTienda.id_tienda = HechosVentas.id_tienda
		WHERE DimTienda.nomb_tienda = @sucursal
		AND YEAR(HechosVentas.fecha) = @anio;		
END
EXEC sp_ProductosTienda 'Sucursal Norte';

GO
CREATE PROCEDURE sp_VentasProductoTienda @sucursal varchar(15), @producto varchar (20)
AS
	declare @mes int;
		set @mes = MONTH(GETDATE());
	declare @anio int;
		set @anio = YEAR(GETDATE());
BEGIN
	IF(@mes = '1')
	BEGIN
		set @mes = '12';
		set @anio = @anio-1;
	END
	
	Select SUM(HechosVentas.cantidad) Cantidad
		FROM HechosVentas JOIN DimArticulo ON DimArticulo.id_art = HechosVentas.id_art
		JOIN DimTienda ON DimTienda.id_tienda = HechosVentas.id_tienda
		WHERE DimTienda.nomb_tienda = @sucursal
		AND DimArticulo.nomb_art = @producto
		AND YEAR(HechosVentas.fecha) = @anio;
END
EXEC sp_VentasProductoTienda 'Sucursal Norte' , 'Obleas';

GO

CREATE PROCEDURE sp_IngresosTienda @mes int, @tienda varchar(15)
AS
BEGIN
	SELECT SUM(HechosVentas.monto_venta) as monto_total
		FROM HechosVentas JOIN DimTienda ON HechosVentas.id_tienda = DimTienda.id_tienda
		Where YEAR(HechosVentas.fecha) = '' + YEAR(GETDATE()) + ''
		AND MONTH(HechosVentas.fecha) = @mes
		AND DimTienda.nomb_tienda = @tienda
		GROUP BY DimTienda.nomb_tienda
END	
EXEC sp_IngresosTienda 5, 'Sucursal Puebla'

GO
CREATE PROCEDURE sp_NoVentasTienda @mes int, @tienda varchar(15)
AS
BEGIN
	SELECT COUNT(HechosVentas.monto_venta) as no_ventas
		FROM HechosVentas JOIN DimTienda ON HechosVentas.id_tienda = DimTienda.id_tienda
		Where YEAR(HechosVentas.fecha) = '' + YEAR(GETDATE()) + ''
		AND MONTH(HechosVentas.fecha) = @mes
		AND DimTienda.nomb_tienda = @tienda
		GROUP BY DimTienda.nomb_tienda
END	
EXEC sp_NoVentasTienda 3, 'Sucursal Norte'

GO
CREATE PROCEDURE sp_NombresClientes
AS
BEGIN
	SELECT DimCliente.nomb_cte FROM DimCliente;
END
EXEC sp_NombresClientes

GO
CREATE PROCEDURE sp_ClPrAd @cliente varchar(25)
AS
BEGIN
	SELECT DISTINCT(DimArticulo.nomb_art) Criterio, SUM(HechosVentas.cantidad) Cantidad
		FROM DimArticulo JOIN HechosVentas ON DimArticulo.id_art = HechosVentas.id_art
		JOIN DimCliente ON DimCliente.id_cliente = HechosVentas.id_cliente
		WHERE DimCliente.nomb_cte = @cliente
		GROUP BY DimArticulo.nomb_art;
END
EXEC sp_ClPrAd 'Norman Arredondo'

GO
CREATE PROCEDURE sp_ClComSuc @cliente varchar(25)
AS
BEGIN
	SELECT DISTINCT(DimTienda.nomb_tienda) Criterio, COUNT(DISTINCT (HechosVentas.id_venta)) Cantidad
		FROM DimTienda JOIN HechosVentas ON DimTienda.id_tienda = HechosVentas.id_tienda
		JOIN DimCliente ON DimCliente.id_cliente = HechosVentas.id_cliente
		WHERE DimCliente.nomb_cte = @cliente
		GROUP BY DimTienda.nomb_tienda;
END
EXEC sp_ClComSuc 'Norman Arredondo'

GO
CREATE PROCEDURE sp_MontoComSuc @cliente varchar(25)
AS
BEGIN
	SELECT DISTINCT(DimArticulo.nomb_art) Criterio, SUM(HechosVentas.monto_venta) Cantidad
		FROM DimArticulo JOIN HechosVentas ON DimArticulo.id_art = HechosVentas.id_art
		JOIN DimCliente ON DimCliente.id_cliente = HechosVentas.id_cliente
		WHERE DimCliente.nomb_cte = @cliente
		GROUP BY DimArticulo.nomb_art;
END
EXEC sp_MontoComSuc 'Norman Arredondo'

GO
CREATE PROCEDURE sp_TotalCompras @cliente varchar(25)
AS
BEGIN
	SELECT COUNT(DISTINCT(HechosVentas.id_venta)) Total
		FROM DimCliente JOIN HechosVentas ON DimCliente.id_cliente = HechosVentas.id_cliente
		WHERE DimCliente.nomb_cte = @cliente;
END
EXEC sp_TotalCompras 'Salma Cruz'

GO
CREATE PROCEDURE sp_TotalProductos @cliente varchar(25)
AS
BEGIN
	SELECT SUM(HechosVentas.cantidad) Total
		FROM DimCliente JOIN HechosVentas ON DimCliente.id_cliente = HechosVentas.id_cliente
		WHERE DimCliente.nomb_cte = @cliente;
END
EXEC sp_TotalProductos'Norman Arredondo'

GO
CREATE PROCEDURE sp_MontoTotalCl @cliente varchar(25)
AS
BEGIN
	SELECT SUM(HechosVentas.monto_venta) Total
		FROM DimCliente JOIN HechosVentas ON DimCliente.id_cliente = HechosVentas.id_cliente
		WHERE DimCliente.nomb_cte = @cliente;
END
EXEC sp_MontoTotalCl 'Norman Arredondo'







