-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2024 at 02:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

 /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
 /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
 /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 /*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinicaseprice`
--

DELIMITER $$

/* -------------------- PROCEDURES -------------------- */

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarDatosPacientes`
(IN `pDni` INT, IN `pDireccion` VARCHAR(50), IN `pMail` VARCHAR(50),
 IN `pTelefono` VARCHAR(20), IN `pCobertura` VARCHAR(20),
 IN `pNombreObraSocial` VARCHAR(50), IN `pPlanObraSocial` VARCHAR(50),
 IN `pNro_Afiliado` VARCHAR(50))
BEGIN
    UPDATE paciente
    SET Direccion = pDireccion,
        Mail = pMail,
        Telefono = pTelefono,
        Cobertura = pCobertura,
        NombreObraSocial = pNombreObraSocial,
        Plan_Obra_Social = pPlanObraSocial,
        Nro_Afiliado = pNro_Afiliado
    WHERE Dni = pDni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ActualizarInsumos`
(IN `pNombreInsumo` VARCHAR(30), IN `pCantidad` INT(10),
 IN `pObservaciones` VARCHAR(200), IN `pId` INT(10))
BEGIN
    UPDATE insumos
    SET Nombre = pNombreInsumo,
        Cantidad = pCantidad,
        Observaciones = pObservaciones,
        FechaIngreso = CURDATE()
    WHERE id_Insumo = pId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarInsumos`
(IN `pNombreInsumo` VARCHAR(30), IN `pCantidad` INT(10),
 IN `pObservaciones` VARCHAR(200))
BEGIN
    INSERT INTO insumos (Nombre, Cantidad, FechaIngreso, Observaciones)
    VALUES (pNombreInsumo, pCantidad, CURDATE(), pObservaciones);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Autorizar_Pagar_Consulta`
(IN `pIdProfesional` INT, IN `pIdTurno` INT, IN `pFormaDePago` VARCHAR(20))
BEGIN
    INSERT INTO honorariosprofesionales(id_Turno, id_Profesional, FormaPago)
    VALUES (pIdTurno, pIdProfesional, pFormaDePago);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarEstudio` (IN `ENombre` VARCHAR(255))
BEGIN
    SELECT id_Estudio, Nombre
    FROM estudioslaboratorio
    WHERE Nombre = ENombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarPacientes` (IN `pDni` INT)
BEGIN
    SELECT Dni, Nombre, Apellido, Direccion, FechaNac, Mail, Telefono,
           Cobertura, NombreObraSocial, Plan_Obra_Social, Nro_Afiliado
    FROM paciente
    WHERE Dni = pDni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `BuscarProfesionaldelaSalud`
(IN `idProfesional` INT)
BEGIN
    SELECT id_Profesional, Nombre, Apellido, Especialidad
    FROM profesional
    WHERE id_Profesional = idProfesional;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CancelarTurno`
(IN `pIdTurno` INT, IN `pIdHorario` INT)
BEGIN
    DELETE FROM turnosconsultorios WHERE id_Turno = pIdTurno;

    UPDATE horarioatencion
    SET estado = 1
    WHERE id_Horario = pIdHorario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarHorario` (IN `pIdHorario` INT)
BEGIN
    DELETE FROM horarioatencion WHERE id_Horario = pIdHorario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarHorarioEstudios` (IN `pIdHorario` INT)
BEGIN
    DELETE FROM horarioatencionestudio WHERE id_Horario = pIdHorario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `FinalizarAtencion` (IN `pIdOrden` INT)
BEGIN
    UPDATE ordenes
    SET estado = 'Atendido'
    WHERE id_Orden = pIdOrden;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `FinalizarAtencionLaboratorio` (IN `pIdOrden` INT)
BEGIN
    UPDATE ordenlaboratorio
    SET estado = 'Atendido'
    WHERE id_OrdenLaboratorio = pIdOrden;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `IngresoLogin`
(IN `Usu` VARCHAR(20), IN `Pass` VARCHAR(15))
SELECT NomRol
FROM usuario u
INNER JOIN roles r ON u.RolUsu = r.RolUsu
WHERE NombreUsu = Usu AND PassUsu = Pass AND Activo = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarHorario`
(IN `pIdProfesional` INT, IN `pFecha` DATE, IN `pHora` VARCHAR(6))
BEGIN
    INSERT INTO horarioatencion (id_Profesional, fecha, hora, estado)
    VALUES (pIdProfesional, pFecha, pHora, 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarHorarioEstudio`
(IN `id_Estudio` INT, IN `pFecha` DATE, IN `pHora` VARCHAR(6))
BEGIN
    INSERT INTO horarioatencionestudio (id_Estudio, fecha, hora, estado)
    VALUES (id_Estudio, pFecha, pHora, 1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertarPaciente`
(IN `pDNI` INT, IN `pNombre` VARCHAR(50), IN `pApellido` VARCHAR(50),
 IN `pFechaNac` DATE, IN `pTelefono` VARCHAR(20), IN `pDireccion` VARCHAR(50),
 IN `pMail` VARCHAR(30), IN `pCobertura` VARCHAR(20),
 IN `pNombreObraSocial` VARCHAR(50), IN `pPlanObraSocial` VARCHAR(50),
 IN `pNro_Afiliado` VARCHAR(50), OUT `rta` INT)
BEGIN
    DECLARE existe INT DEFAULT 0;

    SELECT COUNT(*) INTO existe FROM paciente WHERE DNI = pDNI;

    IF existe = 0 THEN
        INSERT INTO paciente (Dni, Nombre, Apellido, Direccion, FechaNac, Mail,
                              Telefono, Cobertura, NombreObraSocial,
                              Plan_Obra_Social, Nro_Afiliado)
        VALUES (pDNI, pNombre, pApellido, pDireccion, pFechaNac, pMail,
                pTelefono, pCobertura,
                IFNULL(pNombreObraSocial,0), IFNULL(pPlanObraSocial,0),
                IFNULL(pNro_Afiliado,0));

        SET rta = pDNI;
    ELSE
        SET rta = existe;
    END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarEspecialidadHorarios` ()
BEGIN
    SELECT H.fecha, H.hora, P.id_Profesional, P.Especialidad, P.Nombre, P.Apellido, H.id_Horario
    FROM profesional P
    INNER JOIN horarioatencion H ON P.id_Profesional = H.id_Profesional;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarEstudiosLaboratorio` ()
BEGIN
    SELECT *
    FROM estudiosLaboratorio
    ORDER BY id_Estudio;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarHorarios`
(IN `pIdProfesional` INT)
BEGIN
    SELECT P.id_Profesional, H.id_Horario, H.fecha, H.hora
    FROM profesional P
    INNER JOIN horarioatencion H ON P.id_Profesional = H.id_Profesional
    WHERE P.id_Profesional = pIdProfesional
      AND H.fecha >= CURDATE()
      AND H.estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarHorariosAtencionEstudios`
(IN `Estudio` VARCHAR(255))
SELECT *
FROM horarioatencionestudio
WHERE id_Estudio = Estudio$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarHorariosEpecialidad`
(IN `pEspecialidad` VARCHAR(20))
BEGIN
    SELECT H.fecha, H.hora, P.id_Profesional, P.Especialidad,
           P.Nombre, P.Apellido, H.id_Horario
    FROM profesional P
    INNER JOIN horarioatencion H ON P.id_Profesional = H.id_Profesional
    WHERE P.Especialidad = pEspecialidad
      AND H.fecha >= CURDATE()
      AND H.estado = 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarInsumos` ()
BEGIN
    SELECT *
    FROM insumos;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarOrdenesEstudioHoy2` ()
BEGIN
    SELECT O.FechaOrden, O.Id_Orden, O.DNI_Paciente,
           O.Nombre_Paciente, O.Apellido_Paciente,
           O.Especialidad,
           P.Nombre, P.Apellido,
           O.Estado
    FROM ordenes AS O
    INNER JOIN turnosconsultorios AS TC ON TC.id_Turno = O.id_Turno
    INNER JOIN horarioatencion AS H ON TC.id_Horario = H.id_Horario
    INNER JOIN profesional AS P ON H.id_Profesional = P.id_Profesional
    WHERE O.Estado = 'No Atendido'
      AND O.Especialidad IN ('Ecografía General','Resonancia Magnética','Radiología','Tomografía')
      AND O.FechaOrden = CURDATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarOrdenesLaboratorio` ()
BEGIN
    SELECT 
        O.FechaOrden,
        O.Id_OrdenLaboratorio,
        O.DniPaciente,
        P.Nombre,
        P.Apellido,
        E.Nombre AS 'Estudio',
        O.Estado
    FROM ordenlaboratorio AS O
    INNER JOIN paciente AS P ON O.DniPaciente = P.Dni
    INNER JOIN estudioslaboratorio AS E ON O.id_Estudio = E.id_Estudio
    WHERE O.Estado = 'No Atendido'
      AND O.FechaOrden = CURDATE();
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ListarOrdenesPorEspecialidad` ()
BEGIN
    SELECT 
        O.FechaOrden,
        O.Id_Orden,
        O.DNI_Paciente,
        O.Nombr
