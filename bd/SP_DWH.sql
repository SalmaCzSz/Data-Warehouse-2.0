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