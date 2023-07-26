-- Database: canal11

-- DROP DATABASE IF EXISTS canal11;

/*CREATE DATABASE canal11
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Bolivia.1252'
    LC_CTYPE = 'Spanish_Bolivia.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;*/
	
	
	
-- public.categoria_activo definition

-- Drop table

-- DROP TABLE public.categoria_activo;

CREATE TABLE public.categoria_activo (
  id serial4 NOT NULL,
  nombre varchar(50) NOT NULL,
  CONSTRAINT categoria_activo_nombre_key UNIQUE (nombre),
  CONSTRAINT categoria_activo_pkey PRIMARY KEY (id)
);


-- public.comando definition

-- Drop table

-- DROP TABLE public.comando;

CREATE TABLE public.comando (
  id serial4 NOT NULL,
  cu varchar(50) NOT NULL,
  accion varchar(100) NOT NULL,
  parametro text NOT NULL,
  ejemplo text NOT NULL,
  asunto text NOT NULL,
  CONSTRAINT comando_pkey PRIMARY KEY (id)
);


-- public.estado_activo definition

-- Drop table

-- DROP TABLE public.estado_activo;

CREATE TABLE public.estado_activo (
  id serial4 NOT NULL,
  nombre varchar(100) NOT NULL,
  CONSTRAINT estado_activo_pkey PRIMARY KEY (id)
);


-- public.estado_mantenimiento definition

-- Drop table

-- DROP TABLE public.estado_mantenimiento;

CREATE TABLE public.estado_mantenimiento (
  id serial4 NOT NULL,
  nombre varchar(50) NOT NULL,
  CONSTRAINT estado_mantenimiento_pkey PRIMARY KEY (id)
);


-- public.fotografia definition

-- Drop table

-- DROP TABLE public.fotografia;

CREATE TABLE public.fotografia (
  id serial4 NOT NULL,
  url text NOT NULL,
  fecha date NOT NULL,
  id_tabla int4 NULL,
  tipo_tabla int4 NULL,
  CONSTRAINT fotografia_pkey PRIMARY KEY (id)
);


-- public.modulo2 definition

-- Drop table

-- DROP TABLE public.modulo2;

CREATE TABLE public.modulo2 (
  id serial4 NOT NULL,
  nombre text NOT NULL,
  descripcion text NOT NULL,
  file text NOT NULL,
  nivel int4 NOT NULL,
  estado bool NOT NULL,
  CONSTRAINT modulo2_pkey PRIMARY KEY (id)
);


-- public.pagina definition

-- Drop table

-- DROP TABLE public.pagina;

CREATE TABLE public.pagina (
  id serial4 NOT NULL,
  "path" text NULL,
  visitas int4 NULL DEFAULT 0,
  CONSTRAINT pagina_pkey PRIMARY KEY (id)
);


-- public.persona definition

-- Drop table

-- DROP TABLE public.persona;

CREATE TABLE public.persona (
  id serial4 NOT NULL,
  nombre varchar(50) NOT NULL,
  ci varchar(50) NOT NULL,
  fecha_nac date NOT NULL,
  genero varchar(50) NOT NULL,
  telefono varchar(50) NOT NULL,
  CONSTRAINT persona_ci_key UNIQUE (ci),
  CONSTRAINT persona_pkey PRIMARY KEY (id)
);


-- public.rol definition

-- Drop table

-- DROP TABLE public.rol;

CREATE TABLE public.rol (
  id serial4 NOT NULL,
  nombre text NOT NULL,
  descripcion text NOT NULL,
  estado bool NOT NULL,
  CONSTRAINT rol_pkey PRIMARY KEY (id)
);


-- public.tipo_ingreso definition

-- Drop table

-- DROP TABLE public.tipo_ingreso;

CREATE TABLE public.tipo_ingreso (
  id serial4 NOT NULL,
  nombre varchar(100) NOT NULL,
  CONSTRAINT tipo_ingreso_pkey PRIMARY KEY (id)
);


-- public.ubicacion definition

-- Drop table

-- DROP TABLE public.ubicacion;

CREATE TABLE public.ubicacion (
  id serial4 NOT NULL,
  descripcion varchar(50) NOT NULL,
  latitud varchar(50) NOT NULL,
  longitud varchar(50) NOT NULL,
  CONSTRAINT ubicacion_pkey PRIMARY KEY (id)
);


-- public.accion2 definition

-- Drop table

-- DROP TABLE public.accion2;

CREATE TABLE public.accion2 (
  id_modulo int4 NOT NULL,
  id serial4 NOT NULL,
  nombre text NOT NULL,
  param text NOT NULL,
  descripcion text NOT NULL,
  estado bool NOT NULL,
  CONSTRAINT accion2_pkey PRIMARY KEY (id_modulo, id),
  CONSTRAINT accion2_id_modulo_fkey FOREIGN KEY (id_modulo) REFERENCES public.modulo2(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.ambiente definition

-- Drop table

-- DROP TABLE public.ambiente;

CREATE TABLE public.ambiente (
  id serial4 NOT NULL,
  nombre varchar(50) NOT NULL,
  dimension varchar(50) NOT NULL,
  id_persona int4 NOT NULL,
  id_ubicacion int4 NOT NULL,
  CONSTRAINT ambiente_pkey PRIMARY KEY (id),
  CONSTRAINT ambiente_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES public.persona(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT ambiente_id_ubicacion_fkey FOREIGN KEY (id_ubicacion) REFERENCES public.ubicacion(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.modulo_rol definition

-- Drop table

-- DROP TABLE public.modulo_rol;

CREATE TABLE public.modulo_rol (
  id_rol int4 NOT NULL,
  id_modulo serial4 NOT NULL,
  CONSTRAINT modulo_rol_pkey PRIMARY KEY (id_rol, id_modulo),
  CONSTRAINT modulo_rol_id_modulo_fkey FOREIGN KEY (id_modulo) REFERENCES public.modulo2(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT modulo_rol_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.rol(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.users definition

-- Drop table

-- DROP TABLE public.users;

CREATE TABLE public.users (
  id serial4 NOT NULL,
  "name" varchar(50) NOT NULL,
  "password" text NOT NULL,
  email varchar(50) NOT NULL,
  id_persona int4 NOT NULL,
  created_at timestamp NULL,
  updated_at timestamp NULL,
  CONSTRAINT users_email_key UNIQUE (email),
  CONSTRAINT users_name_key UNIQUE (name),
  CONSTRAINT users_pkey PRIMARY KEY (id),
  CONSTRAINT users_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES public.persona(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.usuario definition

-- Drop table

-- DROP TABLE public.usuario;

CREATE TABLE public.usuario (
  id serial4 NOT NULL,
  usuario varchar(50) NOT NULL,
  "password" text NOT NULL,
  email varchar(50) NOT NULL,
  permiso varchar(50) NOT NULL,
  id_persona int4 NOT NULL,
  created_at timestamp NULL,
  updated_at timestamp NULL,
  CONSTRAINT usuario_email_key UNIQUE (email),
  CONSTRAINT usuario_pkey PRIMARY KEY (id),
  CONSTRAINT usuario_usuario_key UNIQUE (usuario),
  CONSTRAINT usuario_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES public.persona(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.activo definition

-- Drop table

-- DROP TABLE public.activo;

CREATE TABLE public.activo (
  id serial4 NOT NULL,
  codigo varchar(50) NOT NULL,
  nombre varchar(50) NOT NULL,
  fecha_ingreso date NOT NULL,
  vida_util int4 NULL,
  valor numeric NOT NULL,
  periodo_mantenimiento int4 NOT NULL,
  ultimo_mantenimiento date NULL,
  id_ambiente int4 NOT NULL,
  id_categoria int4 NOT NULL,
  id_tipo_ingreso int4 NOT NULL,
  id_estado int4 NOT NULL,
  CONSTRAINT activo_codigo_key UNIQUE (codigo),
  CONSTRAINT activo_pkey PRIMARY KEY (id),
  CONSTRAINT activo_id_ambiente_fkey FOREIGN KEY (id_ambiente) REFERENCES public.ambiente(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT activo_id_categoria_fkey FOREIGN KEY (id_categoria) REFERENCES public.categoria_activo(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT activo_id_estado_fkey FOREIGN KEY (id_estado) REFERENCES public.estado_activo(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT activo_id_tipo_ingreso_fkey FOREIGN KEY (id_tipo_ingreso) REFERENCES public.tipo_ingreso(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.orden_mantenimiento definition

-- Drop table

-- DROP TABLE public.orden_mantenimiento;

CREATE TABLE public.orden_mantenimiento (
  id serial4 NOT NULL,
  tipo varchar(50) NOT NULL,
  fecha_solicitud date NOT NULL,
  descripcion varchar(500) NULL,
  id_activo int4 NOT NULL,
  id_estado_mantenimiento int4 NOT NULL,
  CONSTRAINT orden_mantenimiento_pkey PRIMARY KEY (id),
  CONSTRAINT orden_mantenimiento_id_activo_fkey FOREIGN KEY (id_activo) REFERENCES public.activo(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT orden_mantenimiento_id_estado_mantenimiento_fkey FOREIGN KEY (id_estado_mantenimiento) REFERENCES public.estado_mantenimiento(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.permiso2 definition

-- Drop table

-- DROP TABLE public.permiso2;

CREATE TABLE public.permiso2 (
  id_user int4 NOT NULL,
  id_rol int4 NOT NULL,
  usuario text NOT NULL,
  fecha_inicio date NOT NULL,
  fecha_fin date NOT NULL,
  estado bool NOT NULL,
  CONSTRAINT permiso2_pkey PRIMARY KEY (id_user, id_rol),
  CONSTRAINT permiso2_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.rol(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT permiso2_id_user_fkey FOREIGN KEY (id_user) REFERENCES public.users(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.salida_activo definition

-- Drop table

-- DROP TABLE public.salida_activo;

CREATE TABLE public.salida_activo (
  id serial4 NOT NULL,
  fecha date NOT NULL,
  id_activo int4 NULL,
  CONSTRAINT salida_activo_pkey PRIMARY KEY (id),
  CONSTRAINT salida_activo_id_activo_fkey FOREIGN KEY (id_activo) REFERENCES public.activo(id) ON DELETE CASCADE ON UPDATE CASCADE
);


-- public.traslado_activo definition

-- Drop table

-- DROP TABLE public.traslado_activo;

CREATE TABLE public.traslado_activo (
  id serial4 NOT NULL,
  descripcion varchar(100) NOT NULL,
  fecha_traslado date NOT NULL,
  id_activo int4 NOT NULL,
  id_ambiente int4 NOT NULL,
  id_persona int4 NOT NULL,
  CONSTRAINT traslado_activo_pkey PRIMARY KEY (id),
  CONSTRAINT traslado_activo_id_activo_fkey FOREIGN KEY (id_activo) REFERENCES public.activo(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT traslado_activo_id_ambiente_fkey FOREIGN KEY (id_ambiente) REFERENCES public.ambiente(id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT traslado_activo_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES public.persona(id) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO public.persona
(id, nombre, ci, fecha_nac, genero, telefono)
VALUES(1, 'juaquin chumacero', '12345678', '2023-01-12', 'm', '72181211');
INSERT INTO public.persona
(id, nombre, ci, fecha_nac, genero, telefono)
VALUES(2, 'alejandra lopez', '87654321', '2023-01-12', 'f', '75781211');
INSERT INTO public.persona
(id, nombre, ci, fecha_nac, genero, telefono)
VALUES(3, 'belen herrera', '78945612', '2023-01-12', 'f', '72851211');

INSERT INTO public.users
(id, "name", "password", email, id_persona, created_at, updated_at)
VALUES(1, 'henrry', '$2y$10$27yYVjEXzk.f7BJc5KGoduPq/Z.hNt.QOadVXnUHaUlB/qWh/7prm', 'henrryrocajoffre@gmail.com', 1, '2023-01-10 22:54:47.000', '2023-01-10 22:54:47.000');
INSERT INTO public.users
(id, "name", "password", email, id_persona, created_at, updated_at)
VALUES(2, 'darwin', '$2y$10$27yYVjEXzk.f7BJc5KGoduPq/Z.hNt.QOadVXnUHaUlB/qWh/7prm', 'darwinjr40@gmail.com', 2, '2023-01-10 22:54:47.000', '2023-01-10 22:54:47.000');
INSERT INTO public.users
(id, "name", "password", email, id_persona, created_at, updated_at)
VALUES(3, 'javier', '$2y$10$27yYVjEXzk.f7BJc5KGoduPq/Z.hNt.QOadVXnUHaUlB/qWh/7prm', 'javier193061@gmail.com', 3, '2023-01-10 22:54:47.000', '2023-01-10 22:54:47.000');

INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(1, 'Personas', 'OK', 'personas', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(2, 'Activos', 'OK', 'activos', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(3, 'Categorias', 'OK', 'categorias', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(4, 'Usuarios', 'OK', 'usuarios', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(5, 'Ambiente', 'OK', 'ambientes', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(6, 'Ubicaciones', 'OK', 'ubicaciones', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(7, 'Traslados', 'OK', 'traslados', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(8, 'Mantenimientos', 'OK', 'mantenimientos', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(9, 'Reportes', 'OK', 'reportes', 1, true);
INSERT INTO public.modulo2
(id, nombre, descripcion, file, nivel, estado)
VALUES(10, 'Estadisticas', 'OK', 'estadisticas', 1, true);

INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(1, 1, 'Registrar', 'create', 'Registrar Persona ', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(1, 2, 'Listar', 'index', 'Listar Persona ', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(2, 3, 'Registrar', 'create', 'Registrar Activo', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(2, 4, 'Listar', 'index', ' Listar Activo', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(3, 5, 'Registrar', 'create', 'Registrar Categoria', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(3, 6, 'Listar', 'index', ' Listar Categoria', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(4, 7, 'Registrar', 'create', 'Registrar Usuario', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(4, 8, 'Listar', 'index', 'Listar Usuario', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(5, 9, 'Registrar', 'create', 'Registrar Ambiente', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(5, 10, 'Listar', 'index', 'Listar Ambiente', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(6, 11, 'Registrar', 'create', 'Registrar Ubicacion', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(6, 12, 'Listar', 'index', 'Listar Ubicacion', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(7, 13, 'Registrar', 'create', 'Registrar Traslado', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(7, 14, 'Listar', 'index', 'Listar Traslado', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(8, 15, 'Registrar', 'create', 'Registrar Mantenimiento', true);
INSERT INTO public.accion2
(id_modulo, id, nombre, param, descripcion, estado)
VALUES(8, 16, 'Listar', 'index', 'Listar Mantenimiento', true);

INSERT INTO public.ubicacion
(id, descripcion, latitud, longitud)
VALUES(1, 'se movio', '-63.197418', '-17.777614');
INSERT INTO public.ubicacion
(id, descripcion, latitud, longitud)
VALUES(2, 'nueva ubicacion', '-63.197418', '-17.777614');
INSERT INTO public.ubicacion
(id, descripcion, latitud, longitud)
VALUES(3, 'se movio #1', '-63.197418', '-17.777614');
INSERT INTO public.ubicacion
(id, descripcion, latitud, longitud)
VALUES(4, 'ventana', '-63.197418', '-17.777614');

INSERT INTO public.ambiente
(id, nombre, dimension, id_persona, id_ubicacion)
VALUES(1, 'sala1', '5x6 m', 1, 1);
INSERT INTO public.ambiente
(id, nombre, dimension, id_persona, id_ubicacion)
VALUES(2, 'sala2', '5x4 m', 2, 3);
INSERT INTO public.ambiente
(id, nombre, dimension, id_persona, id_ubicacion)
VALUES(3, 'sala3', '5x10 m', 2, 2);

INSERT INTO public.categoria_activo
(id, nombre)
VALUES(1, 'Circulante');
INSERT INTO public.categoria_activo
(id, nombre)
VALUES(2, 'fijo');
INSERT INTO public.categoria_activo
(id, nombre)
VALUES(3, 'Diferido');
INSERT INTO public.categoria_activo
(id, nombre)
VALUES(4, 'aaaa');

INSERT INTO public.estado_activo
(id, nombre)
VALUES(1, 'bueno');
INSERT INTO public.estado_activo
(id, nombre)
VALUES(2, 'malo');
INSERT INTO public.estado_activo
(id, nombre)
VALUES(3, 'regular');

INSERT INTO public.tipo_ingreso
(id, nombre)
VALUES(1, 'traspaso');
INSERT INTO public.tipo_ingreso
(id, nombre)
VALUES(2, 'compra');
INSERT INTO public.tipo_ingreso
(id, nombre)
VALUES(3, 'prestamo');

INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(2, 'xyz', 'camara 350', '2021-11-24', 48, 1800, 12, '2021-11-24', 2, 2, 1, 2);
INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(3, '123', 'mesa ', '2021-04-20', 12, 1000, 24, '2021-04-20', 2, 2, 2, 1);
INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(4, 'qwe', 'monitor samsung 22', '2021-11-26', 36, 1400, 12, '2021-11-26', 1, 2, 1, 1);
INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(5, 'rty', 'camara sony 512', '2021-04-20', 48, 1800, 12, '2021-04-20', 2, 2, 1, 2);
INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(6, 'uio', 'mesa melaminica 1.20x80', '2021-04-20', 12, 1000, 24, '2021-04-20', 2, 2, 2, 1);
INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(7, 'aaaa', 'tasa', '2023-01-12', 24, 24, 24, '2023-01-12', 3, 2, 3, 2);
INSERT INTO public.activo
(id, codigo, nombre, fecha_ingreso, vida_util, valor, periodo_mantenimiento, ultimo_mantenimiento, id_ambiente, id_categoria, id_tipo_ingreso, id_estado)
VALUES(1, 'abc', 'monitor hp 20', '2021-11-25', 36, 1400, 13, '2021-11-25', 1, 2, 1, 1);



INSERT INTO public.estado_mantenimiento
(id, nombre)
VALUES(1, 'proceso');
INSERT INTO public.estado_mantenimiento
(id, nombre)
VALUES(2, 'finalizado');


INSERT INTO public.fotografia
(id, url, fecha, id_tabla, tipo_tabla)
VALUES(1, 'https://s3service12.s3.amazonaws.com/bakbaner.png', '2000-04-24', 1, 1);
INSERT INTO public.fotografia
(id, url, fecha, id_tabla, tipo_tabla)
VALUES(2, 'https://s3service12.s3.amazonaws.com/bakbaner.png', '1998-07-18', 1, 1);
INSERT INTO public.fotografia
(id, url, fecha, id_tabla, tipo_tabla)
VALUES(4, 'https://s3service12.s3.amazonaws.com/bakbaner.png', '1998-07-18', 2, 2);
INSERT INTO public.fotografia
(id, url, fecha, id_tabla, tipo_tabla)
VALUES(5, 'http://miempresa.fun/juan/S3-CANAL11/ACTIVOS/pikachu_63c075e8a3a07.png', '2023-01-12', 7, 2);
INSERT INTO public.fotografia
(id, url, fecha, id_tabla, tipo_tabla)
VALUES(6, 'http://miempresa.fun/juan/S3-CANAL11/ACTIVOS/QR/qr-1673557486.svg', '2023-01-12', 7, 2);


INSERT INTO public.rol
(id, nombre, descripcion, estado)
VALUES(1, 'admin', 'acceso completo', true);
INSERT INTO public.rol
(id, nombre, descripcion, estado)
VALUES(2, 'responsable', 'acceso a ciertas cosas', true);
INSERT INTO public.rol
(id, nombre, descripcion, estado)
VALUES(3, 'empresa', 'encargado del mantenimiento', true);


INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 1);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 2);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 3);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 4);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 5);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 6);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 7);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 8);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 9);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(2, 3);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(2, 5);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(2, 6);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(2, 8);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(2, 9);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(3, 8);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(1, 10);
INSERT INTO public.modulo_rol
(id_rol, id_modulo)
VALUES(2, 2);


INSERT INTO public.orden_mantenimiento
(id, tipo, fecha_solicitud, descripcion, id_activo, id_estado_mantenimiento)
VALUES(1, 'echo', '2023-01-12', ' ', 1, 1);
INSERT INTO public.orden_mantenimiento
(id, tipo, fecha_solicitud, descripcion, id_activo, id_estado_mantenimiento)
VALUES(2, 'echo', '2023-01-12', ' ', 2, 2);
INSERT INTO public.orden_mantenimiento
(id, tipo, fecha_solicitud, descripcion, id_activo, id_estado_mantenimiento)
VALUES(3, 'echo', '2023-01-12', ' ', 3, 2);





INSERT INTO public.permiso2
(id_user, id_rol, usuario, fecha_inicio, fecha_fin, estado)
VALUES(3, 1, 'javier', '2023-11-01', '2026-12-01', true);
INSERT INTO public.permiso2
(id_user, id_rol, usuario, fecha_inicio, fecha_fin, estado)
VALUES(2, 2, 'darwin', '2023-11-01', '2026-12-01', true);
INSERT INTO public.permiso2
(id_user, id_rol, usuario, fecha_inicio, fecha_fin, estado)
VALUES(1, 3, 'henrry', '2023-11-01', '2026-12-01', true);








INSERT INTO public.salida_activo
(id, fecha, id_activo)
VALUES(1, '2000-04-24', 1);
INSERT INTO public.salida_activo
(id, fecha, id_activo)
VALUES(2, '1998-07-18', 2);





INSERT INTO public.traslado_activo
(id, descripcion, fecha_traslado, id_activo, id_ambiente, id_persona)
VALUES(1, 'por motivo de espacio', '2023-01-12', 1, 2, 2);
INSERT INTO public.traslado_activo
(id, descripcion, fecha_traslado, id_activo, id_ambiente, id_persona)
VALUES(2, 'por motivo personal', '2023-01-12', 1, 2, 1);
INSERT INTO public.traslado_activo
(id, descripcion, fecha_traslado, id_activo, id_ambiente, id_persona)
VALUES(3, 'por motivo de no darle uso', '2023-01-12', 2, 3, 3);




INSERT INTO public.usuario
(id, usuario, "password", email, permiso, id_persona, created_at, updated_at)
VALUES(1, 'henrry', '1234', 'henrryrocajoffre@gmail.com', 'ALL', 1, NULL, NULL);
INSERT INTO public.usuario
(id, usuario, "password", email, permiso, id_persona, created_at, updated_at)
VALUES(2, 'darwin', '1234', 'darwinjr40@gmail.com', 'ALL', 2, NULL, NULL);
INSERT INTO public.usuario
(id, usuario, "password", email, permiso, id_persona, created_at, updated_at)
VALUES(3, 'javier', '1234', 'javier193061@gmail.com', 'ALL', 3, NULL, NULL);



