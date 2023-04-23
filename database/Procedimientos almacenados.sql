-- USE senatimat;

DROP PROCEDURE IF EXISTS spu_estudiantes_getfoto;
DROP PROCEDURE IF EXISTS spu_estudiantes_eliminar;
DROP PROCEDURE IF EXISTS spu_colaborador_getcv;
DROP PROCEDURE IF EXISTS spu_colaboradores_eliminar;
DROP PROCEDURE IF EXISTS spu_cargos_listar;
DROP PROCEDURE IF EXISTS spu_colaboradores_agregar; 
DROP PROCEDURE IF EXISTS spu_colaboradores_listar; 
DROP PROCEDURE IF EXISTS spu_sedes_listar; 
DROP PROCEDURE IF EXISTS spu_escuelas_listar; 
DROP PROCEDURE IF EXISTS spu_carreras_listar; 
DROP PROCEDURE IF EXISTS spu_estudiantes_registrar; 
DROP PROCEDURE IF EXISTS spu_estudiantes_listar; 


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

 

 



CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$


CREATE PROCEDURE spu_escuelas_listar()
BEGIN 
	SELECT * FROM escuelas ORDER BY 2;
END $$


CREATE PROCEDURE spu_carreras_listar(IN _idescuela INT)
BEGIN
	SELECT idcarrera, carrera 
		FROM carreras
		WHERE idescuela = _idescuela;
END $$

 
-- LISTANDO COLABORADORES 
 


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

 
-- AGREGANDO COLABORADORES
 


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

 
-- Listar Cargos
 


CREATE PROCEDURE spu_cargos_listar()
BEGIN
	SELECT * FROM cargos ORDER BY 1;
END $$
 	
 

-- PROCEDIMIENTO PARA ELIINAR COLABORADORES

CREATE PROCEDURE spu_colaboradores_eliminar(IN idcolaborador_ INT)
BEGIN
	 
	DELETE FROM colaboradores
	WHERE idcolaborador = idcolaborador_;
END$$

 

CREATE PROCEDURE spu_colaborador_getcv(IN idcolaborador_ INT)
BEGIN
	SELECT cv FROM colaboradores WHERE idcolaborador = idcolaborador_;
END$$

 

-- CREANDO EL ELIMINAR PARA ESTUDIANTES Y SU FOTO

CREATE PROCEDURE spu_estudiantes_eliminar(IN idestudiante_ INT)
BEGIN
	 
	DELETE FROM estudiantes
	WHERE idestudiante = idestudiante_;
END$$

 

CREATE PROCEDURE spu_estudiantes_getfoto(IN idestudiante_ INT)
BEGIN
	SELECT fotografia FROM estudiantes WHERE idestudiante = idestudiante_;
END$$
 

DELIMITER ;

