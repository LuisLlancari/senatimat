USE senatimat;

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	SELECT	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes SED ON SED.idsede = EST.idsede
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$


DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar
(
	IN _apellidos 			VARCHAR(40),
	IN _nombres 			VARCHAR(40),
	IN _tipodocumento		CHAR(1),
	IN _nrodocumento		CHAR(8),
	IN _fechanacimiento	DATE,
	IN _idcarrera 			INT,
	IN _idsede 				INT,
	IN _fotografia 		VARCHAR(100)
)
BEGIN
	-- Validar el contenido de _fotografia
	IF _fotografia = '' THEN 
		SET _fotografia = NULL;
	END IF;

	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(_apellidos, _nombres, _tipodocumento, _nrodocumento, _fechanacimiento, _idcarrera, _idsede, _fotografia);
END $$

UPDATE estudiantes
SET fotografia = NULL
WHERE fotografia = 'unafoto.jpg' OR
		fotografia = '';

/*
CALL spu_estudiantes_registrar('Francia Minaya', 'Jhon', 'D', '12345678', '1984-09-20', 5, 1, '');
CALL spu_estudiantes_registrar('Munayco', 'José', 'D', '77779999', '1999-09-20', 3, 2, NULL); */
CALL spu_estudiantes_registrar('Prada', 'Teresa', 'C', '01234567', '2002-09-25', 3, 2, '');
SELECT * FROM estudiantes;


DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END $$

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END $$

CALL spu_carreras_listar(3);

-- LISTANDO COLABORADORES 
	SELECT * FROM colaboradores

DELIMITER$$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
	SELECT COLB.idcolaborador,
			 COLB.apellidos,COLB.nombres,
			 COLB.telefono,
			 CARG.cargo,SED.sede,
			 COLB.tipocontrato,COLB.cv,
			 COLB.direccion
	FROM colaboradores COLB
	INNER JOIN cargos CARG ON CARG.idcargo = COLB.idcargo
	INNER JOIN sedes SED ON SED.idsede = COLB.idsede
	WHERE COLB.estado ='1';
END$$

CALL spu_colaboradores_listar();

-- AGREGANDO COLABORADORES

DELIMITER$$
CREATE PROCEDURE spu_colaboradores_agregar
(
	IN apellidos_ 		VARCHAR(40),
	IN nombres_			VARCHAR(40),
	IN telefono_ 		CHAR(12),
	IN idcargo_  		INT,
	IN idsede_ 			INT,
	IN tipocontrato_ 	CHAR(1),
	IN direccion_ 		VARCHAR(40),
	IN cv_ 				VARCHAR(100)
)
BEGIN
	IF cv_ = '' THEN 
		SET cv_ = NULL;
	END IF;
	
	INSERT INTO colaboradores
	(apellidos, nombres, idcargo, idsede, telefono, tipocontrato, direccion, cv)VALUES
	(apellidos_, nombres_, idcargo_, idsede_, telefono_, tipocontrato_, direccion_, cv_);
END$$

CALL spu_colaboradores_agregar('Pachas','Melany','96691378',3,2,'C','algun lugar', NULL);

-- Listar Cargos

DELIMITER $$
CREATE PROCEDURE spu_cargos_listar()
BEGIN
	SELECT * FROM cargos ORDER BY 1;
END $$
	SELECT * FROM colaboradores ORDER BY 1;


