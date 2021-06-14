create database dw;

use dw;

create table DimCliente(
	id_cliente int not null,
	nomb_cte varchar (50),
	tel_cte varchar (15), 
	dir_cte varchar (40), 
	primary key (id_cliente)
);

create table DimTiempo(
	fecha date,
	anio int,
	mes int,
	dia int,
	primary key (fecha)
);

create table DimTienda(
	id_tienda int not null,
	nomb_tienda varchar (40),
	direc_tienda varchar (40),  
	tel_tienda varchar(15), 
	nomb_edo varchar (40),
	primary key (id_tienda)
);

create table DimArticulo(
	id_art int not null,
	nomb_art varchar (40),
	nomb_proveedor varchar (40),
	marca_art varchar (40),
	primary key (id_art)
);

create table HechosVentas (
	id_venta int not null,
	fecha date not null,
	id_tienda int not null,
	id_cliente int not null,
	id_art int not null,
	cantidad int,
	monto_venta float,
	monto_costo float,
	primary key (id_venta, fecha, id_tienda, id_cliente, id_art),
	foreign key (fecha) references DimTiempo,
	foreign key (id_tienda) references DimTienda,
	foreign key (id_cliente) references DimCliente,
	foreign key (id_art) references DimArticulo
);
