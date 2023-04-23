-- CREATE DATABASE senatimat;
-- USE senatimat;


DROP TABLE IF EXISTS `usuarios`;
DROP TABLE IF EXISTS `colaboradores`;
DROP TABLE IF EXISTS `estudiantes`;
DROP TABLE IF EXISTS `cargos`;
DROP TABLE IF EXISTS `sedes`;
DROP TABLE IF EXISTS `carreras`;
DROP TABLE IF EXISTS `escuelas`;

DROP PROCEDURE IF EXISTS spu_usuarios_login;
DROP PROCEDURE IF EXISTS spu_usuarios_registrar;


CREATE TABLE escuelas
(
	idescuela 		INT AUTO_INCREMENT PRIMARY KEY,
	escuela 			VARCHAR(50) 	NOT NULL,
	CONSTRAINT uk_escuela_esc UNIQUE (escuela)
)ENGINE = INNODB;

INSERT INTO escuelas (escuela) VALUES
	('ETI'), -- 1
	('Administración'), -- 2
	('Metal mecánica'); -- 3

 
-- ***** SEGUNDA TABLA ***** --
 
CREATE TABLE carreras
(
	idcarrera 		INT AUTO_INCREMENT PRIMARY KEY,
	idescuela 		INT 			NOT NULL,
	carrera 			VARCHAR(100)NOT NULL,
	CONSTRAINT fk_idescuela_car FOREIGN KEY (idescuela) REFERENCES escuelas (idescuela),
	CONSTRAINT uk_carrera_car UNIQUE (carrera)
)ENGINE = INNODB;

INSERT INTO carreras (idescuela, carrera) VALUES
	(1, 'Diseño Gráfico Digital'),
	(1, 'Ingeniería de Software con IA'),
	(1, 'Cyberseguridad'),
	(2, 'Administración de empresas'),
	(2, 'Administración Industrial'),
	(2, 'Prevencionista de Riesgo'),
	(3, 'Soldador Universal'),
	(3, 'Mecánico de mantenimiento'),
	(3, 'Soldador estructuras metálicas');

 
-- ****** TERCERA TABLA ******* --
 
CREATE TABLE sedes
(
	idsede 		INT AUTO_INCREMENT PRIMARY KEY,
	sede 			VARCHAR(40)		NOT NULL,
	CONSTRAINT uk_sede_sde UNIQUE (sede)
)ENGINE = INNODB;

INSERT INTO sedes (sede) VALUES
	('Chincha'),
	('Pisco'),
	('Ica'),
	('Ayacucho');

 
-- ******* CUARTA TABLA ********* --
 
CREATE TABLE estudiantes
(
	idestudiante 		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos			VARCHAR(40)		NOT NULL,
	nombres 				VARCHAR(40)		NOT NULL,
	tipodocumento 		CHAR(1)			NOT NULL DEFAULT 'D',
	nrodocumento		CHAR(8)			NOT NULL,
	fechanacimiento	DATE 				NOT NULL,
	idcarrera 			INT 				NOT NULL,
	idsede 				INT 				NOT NULL,
	fotografia 			VARCHAR(100)	NULL,
	fecharegistro		DATETIME 		NOT NULL DEFAULT NOW(),
	fechaupdate 		DATETIME 		NULL,
	estado 				CHAR(1)			NOT NULL DEFAULT '1',
	CONSTRAINT uk_nrodocumento_est UNIQUE (tipodocumento, nrodocumento),
	CONSTRAINT fk_idcarrera_est FOREIGN KEY (idcarrera) REFERENCES carreras (idcarrera),
	CONSTRAINT fk_idsede_est FOREIGN KEY (idsede) REFERENCES sedes (idsede)
)ENGINE = INNODB;

 

 


-- CREANDO TABLA CARGO
 
CREATE TABLE cargos
(
	idcargo 	INT AUTO_INCREMENT PRIMARY KEY,
	cargo 	VARCHAR(80),
	CONSTRAINT uk_cargo_cargos UNIQUE (cargo)	
)ENGINE INNODB;

INSERT INTO cargos (cargo) VALUES
('Instructor'),
('Jefe de centro'),
('Asist. Administrativo'),
('Asist. Academico'),
('Cordinador ETIA'),
('Coordinardor CIS');

-- CREANDO TABLA COLABORADORES
 
CREATE TABLE colaboradores
(
	idcolaborador	INT 		AUTO_INCREMENT PRIMARY KEY,
	apellidos 		VARCHAR(40)		NOT NULL,
	nombres			VARCHAR(40) 	NOT NULL,
	idcargo 			INT 				NOT NULL,
	idsede			INT 				NOT NULL,
	telefono 		CHAR(12)			NOT NULL,
	tipocontrato 	CHAR(1)			NOT NULL,
	cv 				VARCHAR (100) 	NULL,
	direccion 		VARCHAR (40)   NOT NULL,
	fecharegistro 	DATETIME 		NOT NULL DEFAULT NOW(),
	fechaupdate 	DATETIME			NULL,
	estado 			CHAR(1) 			DEFAULT '1',
	CONSTRAINT fk_idcargo_colab FOREIGN KEY (idcargo) REFERENCES cargos(idcargo),
	CONSTRAINT fk_idsede_colab FOREIGN KEY (idsede) REFERENCES sedes(idsede)

)ENGINE =INNODB;

 
 
-- TABLA USUARIOS
 
CREATE TABLE usuarios
(
	idusuario 		INT  			AUTO_INCREMENT  PRIMARY KEY,
	usuario 			VARCHAR(20) NOT NULL,
	clave 			VARCHAR(90) NOT NULL,
	fecharegistro 	DATETIME 	DEFAULT NOW(),
	estado 			CHAR(1) 		DEFAULT '1',
	CONSTRAINT un_usuario_usu UNIQUE(usuario)
)ENGINE = INNODB;


 


 

DELIMITER $$
 CREATE PROCEDURE spu_usuarios_login(IN _usuario VARCHAR(20))
BEGIN
	SELECT	idusuario, usuario, clave
	FROM usuarios 
	WHERE usuario = _usuario AND estado = '1';
END $$

 CREATE PROCEDURE spu_usuarios_registrar
(
	IN usuario_ VARCHAR(20),
	IN clave_ VARCHAR(90)
)
BEGIN 
	INSERT INTO usuarios (usuario, clave) VALUES
	(usuario_, clave_);
END $$

DELIMITER ;