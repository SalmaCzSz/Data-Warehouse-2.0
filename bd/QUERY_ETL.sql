-- Proceso ETL

BEGIN TRANSACTION
USE ventas_proy
USE DW

-- DimTiempo_ fecha, año, mes y día
SELECT * FROM DimTiempo
-- datos que se obtienen de la BD operacional
SELECT fecha_vta, YEAR(fecha_vta), MONTH(fecha_vta), DAY(fecha_vta) 
	FROM venta

-- DimTienda: id_tienda, nomb_tienda, direc_tienda, tel_tienda, nomb_edo
SELECT * FROM DimTienda
-- datos que se obtienen de la BD operacional
SELECT id_tienda, nomb_tienda, direc_tienda, tel_tienda, nom_edo
	FROM tienda JOIN estado ON tienda.id_edo = estado.id_Edo

-- DimCliente: id_cliente, nomb_cte, tel_cte, dir_cte
SELECT * FROM DimCliente
-- datos que se obtienen de la BD operacional
SELECT id_cliente as id_cliente, nom_clie as nom_clie, tel_clie as tel_clie, dir_clie as dir_clie
	FROM CLIENTES

-- DimArticulo: id_art, nomb_art, nomb_proveedor, marca_art
SELECT * FROM DimArticulo
-- datos que se obtienen de la BD operacional
SELECT id_articulo as id_articulo, nom_art as nom_art, nom_proveedor as nom_proveedor, marca_art as marca_art
	FROM articulo

-- HechosVentas: id_venta, fecha, id_tienda, id_cliente, id_art, cantidad, monto_venta, monto_costo
SELECT * FROM HECHOSVENTAS
-- datos que se obtienen de la BD operacional
SELECT venta.id_vta as id_venta, fecha_vta as fecha, venta.id_tienda as id_tienda, id_cliente as id_cliente, 
	   id_art as id_art, cant_art as cant_art, cant_art * (prec_art * (1 + tasa_iva/100)) as monto_venta, cost_actual_art as monto_costo
	FROM vta_art JOIN venta on vta_art.id_vta = venta.id_vta
		JOIN articulo on vta_art.id_Art = articulo.id_articulo

 

USE Ventas_Proy
begin transaction
-- Registros nuevos para probar proceso ETL en conjunto
-- Estado
insert into ESTADO(id_edo, nom_edo) values (03, 'Puebla');
SELECT * FROM ESTADO;

-- Tienda
insert into TIENDA(id_tienda, nomb_tienda, direc_tienda, tel_tienda, no_emps_tda, id_edo) values
	(03, 'Sucursal Puebla', 'Plaza Angelópolis 72450 Puebla', 5552579200, 2, 03);
SELECT * FROM TIENDA;

-- Articulo Tienda
insert into ART_TIENDA(id_tienda, id_articulo, prec_art, exist_art) values
	(02, 10, 200, 15),
	(03, 11, 100, 15),
	(02, 12, 3, 15),
	(03, 20, 500, 15),
	(01, 21, 250, 15),
	(03, 22, 200, 15)
;
SELECT * FROM ART_TIENDA;

-- Venta
insert into VENTA(id_vta, id_tienda, id_cliente, fecha_vta, iva_vta, total_vta) values
	(04, 03, 01, '2021/05/01', 16, 1160),
	(05, 01, 03, '2021/05/10', 16, 232),
	(06, 02, 02, '2021/05/10', 16, 249.4),
	(07, 01, 01, '2021/05/15', 16, 1856),
	(08, 01, 03, '2021/05/18', 16, 464)
;
SELECT * FROM VENTA;

-- Venta Artículo
insert into VTA_ART(id_vta, id_tienda, id_art, cant_art, prec_art,tasa_iva) values
	(04, 03, 20, 2, 500, 16),
	(05, 01, 10, 1, 200, 16),
	(06, 02, 10, 1, 200, 16), --10 $200*1	
	(06, 02, 12, 5, 3, 16), --12 $5 * 3 15
	(07, 01, 22, 8, 200, 16),
	(08, 01, 10, 2, 200, 16)
; 
SELECT * FROM VTA_ART;

-- rollback 
-- commit

use DW
SELECT * FROM DimTiempo;
SELECT * FROM DimCliente;
SELECT * FROM DimArticulo;
SELECT * FROM DimTiempo;
SELECT * FROM HechosVentas;
