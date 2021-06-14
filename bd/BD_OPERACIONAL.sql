create database Ventas_Proy;
use Ventas_Proy

create table clientes(
id_cliente int not null, 
nom_clie varchar (25),
tel_clie varchar (15),
dir_clie varchar(30), 
lim_credit varchar (50),
saldo_clie varchar (50)
primary key (id_cliente)
)

create table articulo (
id_articulo int not null,
nom_art varchar (30),
unidad_med_art varchar (15),
cost_actual_art int,
marca_art varchar (30),
tasa_iva_art float,
nom_proveedor varchar(30),
primary key (id_articulo)
)

create table estado (
id_edo int not null, 
nom_edo varchar (30)
primary key (id_edo)
)


create table tienda (
id_tienda int not null, 
nomb_tienda varchar (30), 
direc_tienda varchar (40),  
tel_tienda varchar (15),  
no_emps_tda varchar (5),  
id_edo int
primary key (id_tienda)
foreign key (id_edo) references estado
)

create table art_tienda(
id_tienda int,
id_articulo int, 
prec_art float,
exist_art int,
primary key (id_tienda,id_articulo),
foreign key (id_tienda) references tienda,
foreign key (id_articulo) references articulo
)

create table puesto(
id_puesto int not null,
nom_puesto varchar (20),
sueldo_x_hr int,
primary key (id_puesto)
)

create table empleado (
id_emp int not null, 
nomb_emp varchar (50), 
edad_emp varchar (5), 
direc_emp varchar (50), 
tel_emp varchar (15),  
id_puesto int, 
hrs_trab int, 
id_tienda int,
primary key (id_emp),
foreign key (id_puesto) references puesto,
foreign key (id_tienda) references tienda
)

create table venta(
id_vta int not null, 
id_tienda int,  
id_cliente int, 
fecha_vta date, 
iva_vta float, 
total_vta float,
primary key (id_vta,id_tienda),
foreign key (id_tienda) references tienda,
foreign key (id_cliente) references clientes
)

create table vta_art (
id_vta int not null, 
id_tienda int, 
id_art int, 
cant_art int, 
prec_art float, 
tasa_iva  float
primary key (id_vta, id_tienda, id_art),
foreign key (id_vta, id_tienda) references venta(id_vta, id_tienda),
foreign key (id_art) references articulo
)

BEGIN TRANSACTION
-- Estado
insert into ESTADO(id_edo, nom_edo) values 
	(01, 'Ciudad de Mexico'),
	(02, 'Estado de Mexico')
;
SELECT * FROM ESTADO;

-- Puesto
insert into PUESTO(id_puesto, nom_puesto, sueldo_x_hr) values
	(01, 'Gerente', 92.31),
	(02, 'Vendedor', 36.92)
;
SELECT * FROM PUESTO

-- Cliente
insert into CLIENTES(id_cliente, nom_clie, tel_clie, dir_clie, lim_credit, saldo_clie) values 
	(01, 'Norman Arredondo', 5513572468, 'No disponible', 1000, 0),
	(02, 'Salma Cruz', 5524681357, 'No disponible', 1000, 0),
	(03, 'Elena Garcia', 5518273645, 'No disponible', 1000, 0)
	
;
SELECT * FROM CLIENTES

-- Articulo
insert into ARTICULO(id_articulo, nom_art, unidad_med_art, cost_actual_art, marca_art, tasa_iva_art, nom_proveedor) values
	(10, 'Obleas', 'Caja', 200, 'Coronado', 16, 'Coronado'),
	(11, 'Cajeta', 'Kg', 100, 'Coronado', 16, 'Coronado'),
	(12, 'Paletas', 'Pieza', 3, 'Coronado', 16, 'Coronado'),
	(20, 'Galletas Amaranto', 'caja', 500, 'Nutrisa', 16, 'Nutrisa'),
	(21, 'Miel Abeja', 'Galon', 250, 'Nutrisa', 16, 'Nutrisa'),
	(22, 'Helado', 'KG', 200, 'Nutrisa', 16, 'Nutrisa')
;
SELECT * FROM ARTICULO

-- Tienda
insert into TIENDA(id_tienda, nomb_tienda, direc_tienda, tel_tienda, no_emps_tda, id_edo) values
	(01, 'Sucursal Norte', 'Sierra Vieja 2, lote 2, Cuautitlán', 5558619840, 2, 02),
	(02, 'Sucursal Centro', 'Vasco de Quiroga 05349', 5552579200, 2, 01)
;
SELECT * FROM TIENDA

-- Empleado
insert into EMPLEADO(id_emp, nomb_emp, edad_emp, direc_emp, tel_emp, id_puesto, hrs_trab, id_tienda) values
	(01, 'Gema Toledo', 27, 'No disponible', 5590897867, 01, 20, 01),
	(02, 'Martha Silva', 22, 'No disponible', 5510932846, 02, 15, 01),
	(03, 'Estela Granados', 25, 'No disponible', 5536908322, 01, 40, 02),
	(04, 'Julieta Morales', 23, 'No disponible', 5501908542, 02, 25, 02)
;
SELECT * FROM EMPLEADO

-- Articulo Tienda
insert into ART_TIENDA(id_tienda, id_articulo, prec_art, exist_art) values
	(01, 10, 200, 15),
	(01, 11, 100, 15),
	(01, 12, 3, 15),
	(02, 20, 500, 15),
	(02, 21, 250, 15),
	(02, 22, 200, 15)
;
SELECT * FROM ART_TIENDA

-- Venta
insert into VENTA(id_vta, id_tienda, id_cliente, fecha_vta, iva_vta, total_vta) values
	(01, 02, 01, '2021/04/01', 16, 1160),
	(02, 01, 03, '2021/04/01', 16, 232),
	(03, 02, 02, '2021/04/01', 16, 290)
;
SELECT * FROM VENTA

-- Venta Artículo
insert into VTA_ART(id_vta, id_tienda, id_art, cant_art, prec_art,tasa_iva) values
	(01, 02, 20, 2, 500, 16),
	(02, 01, 11, 2, 100, 16),
	(03, 02, 21, 1, 250, 16)
; 
SELECT * FROM VTA_ART;


--SP necesario para el proceso ETL
CREATE PROCEDURE sp_ObtenerFechas
AS
BEGIN
	select fecha_vta from venta 
		where YEAR(fecha_vta) =  YEAR(GETDATE()) AND MONTH(fecha_vta) = MONTH(GETDATE());
END
exec sp_ObtenerFechas