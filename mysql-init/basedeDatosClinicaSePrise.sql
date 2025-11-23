###############################################################################
# CREACIÓN DE LA BASE DE DATOS
###############################################################################

-- Si no existe, crea la base de datos
CREATE DATABASE IF NOT EXISTS clinicaMedicaSePrise
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

-- Seleccionar la base de datos
USE clinicaMedicaSePrise;

###############################################################################
# TABLA: consultorio
###############################################################################
CREATE TABLE IF NOT EXISTS `consultorio` (
  `idConsultorio` int(4) NOT NULL AUTO_INCREMENT,
  `consultorioNombre` varchar(100) NOT NULL,
  `area` varchar(200) NOT NULL,
  PRIMARY KEY (`idConsultorio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `consultorio` (`idConsultorio`, `consultorioNombre`, `area`) VALUES
(28, 'Consultorio 1', 'Traumatologia')
ON DUPLICATE KEY UPDATE consultorioNombre=VALUES(consultorioNombre), area=VALUES(area);

###############################################################################
# TABLA: consultorioinsumo
###############################################################################
CREATE TABLE IF NOT EXISTS `consultorioinsumo` (
  `idConsultorio` int(4) NOT NULL,
  `idInsumo` int(4) NOT NULL,
  PRIMARY KEY (`idConsultorio`, `idInsumo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

###############################################################################
# TABLA: especialista
###############################################################################
CREATE TABLE IF NOT EXISTS `especialista` (
  `idEspecialista` int(4) NOT NULL AUTO_INCREMENT,
  `nombreEspecialista` varchar(200) NOT NULL,
  `apellidoEspecialista` varchar(200) NOT NULL,
  `matriculaEspecialista` varchar(20) NOT NULL,
  `consultorioSalaEstudio` varchar(50) NOT NULL,
  `espacioEspecialista` int(4) NOT NULL,
  PRIMARY KEY (`idEspecialista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `especialista` (`idEspecialista`, `nombreEspecialista`, `apellidoEspecialista`, `matriculaEspecialista`, `consultorioSalaEstudio`, `espacioEspecialista`) VALUES
(28, 'Marcelo', 'Sartress', '23522177', 'Consultorio', 28),
(29, 'Laura', 'Hiadalgo', '24522177', 'Sala de Estudios', 15)
ON DUPLICATE KEY UPDATE nombreEspecialista=VALUES(nombreEspecialista), apellidoEspecialista=VALUES(apellidoEspecialista);

###############################################################################
# TABLA: insumo
###############################################################################
CREATE TABLE IF NOT EXISTS `insumo` (
  `idInsumo` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `cantidad` int(6) NOT NULL,
  `cantidadStock` int(6) NOT NULL,
  PRIMARY KEY (`idInsumo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `insumo` (`idInsumo`, `nombre`, `descripcion`, `cantidad`, `cantidadStock`) VALUES
(21, 'Estetoscopios', 'Estetoscopios', 10, 10)
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre), cantidad=VALUES(cantidad);

###############################################################################
# TABLA: observacion
###############################################################################
CREATE TABLE IF NOT EXISTS `observacion` (
  `idObservacion` int(4) NOT NULL AUTO_INCREMENT,
  `idReservaTurno` int(4) NOT NULL,
  `textoObservacion` varchar(500) NOT NULL,
  PRIMARY KEY (`idObservacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `observacion` (`idObservacion`, `idReservaTurno`, `textoObservacion`) VALUES
(6, 37, 'Paciente atendido')
ON DUPLICATE KEY UPDATE textoObservacion=VALUES(textoObservacion);

###############################################################################
# TABLA: paciente
###############################################################################
CREATE TABLE IF NOT EXISTS `paciente` (
  `idPaciente` int(4) NOT NULL AUTO_INCREMENT,
  `numDocumentoPaciente` int(20) NOT NULL UNIQUE,
  `nombrePaciente` varchar(100) NOT NULL,
  `apellidoPaciente` varchar(200) NOT NULL,
  `domicilioPaciente` varchar(400) NOT NULL,
  `mailPaciente` varchar(200) NOT NULL,
  `telefonoPaciente` varchar(50) NOT NULL,
  `poseeObraSocial` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idPaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `paciente` (`idPaciente`, `numDocumentoPaciente`, `nombrePaciente`, `apellidoPaciente`, `domicilioPaciente`, `mailPaciente`, `telefonoPaciente`, `poseeObraSocial`) VALUES
(19, 26522177, 'Fernando', 'Espindola', 'Nicolas Vila 470', 'f@mail.com', '555', 1)
ON DUPLICATE KEY UPDATE nombrePaciente=VALUES(nombrePaciente), apellidoPaciente=VALUES(apellidoPaciente);

###############################################################################
# TABLA: pagoatencion
###############################################################################
CREATE TABLE IF NOT EXISTS `pagoatencion` (
  `idPagoAtencion` int(4) NOT NULL AUTO_INCREMENT,
  `idReservaTurno` int(4) NOT NULL,
  `montoAtencion` int(10) NOT NULL,
  `montoFinalAtencion` int(10) NOT NULL,
  `formaPagoAtencion` varchar(100) NOT NULL,
  `cuotasAtencion` int(1) NOT NULL,
  PRIMARY KEY (`idPagoAtencion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `pagoatencion` (`idPagoAtencion`, `idReservaTurno`, `montoAtencion`, `montoFinalAtencion`, `formaPagoAtencion`, `cuotasAtencion`) VALUES
(5, 37, 0, 0, 'efectivo', 1)
ON DUPLICATE KEY UPDATE montoAtencion=VALUES(montoAtencion);

###############################################################################
# TABLA: reservaturno
###############################################################################
CREATE TABLE IF NOT EXISTS `reservaturno` (
  `idReservaTurno` int(4) NOT NULL AUTO_INCREMENT,
  `idTurno` int(4) NOT NULL,
  `idPaciente` int(4) NOT NULL,
  `montoFinal` int(10) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Ingresado',
  PRIMARY KEY (`idReservaTurno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `reservaturno` (`idReservaTurno`, `idTurno`, `idPaciente`, `montoFinal`, `estado`) VALUES
(37, 44, 19, 41600, 'Pagado'),
(38, 45, 19, 12000, 'En Espera')
ON DUPLICATE KEY UPDATE estado=VALUES(estado);

###############################################################################
# TABLA: salaestudio
###############################################################################
CREATE TABLE IF NOT EXISTS `salaestudio` (
  `idsalaestudio` int(4) NOT NULL AUTO_INCREMENT,
  `salaEstudioNombre` varchar(100) NOT NULL,
  `area` varchar(100) NOT NULL,
  PRIMARY KEY (`idsalaestudio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `salaestudio` (`idsalaestudio`, `salaEstudioNombre`, `area`) VALUES
(15, 'Radiografias', 'Rayos X')
ON DUPLICATE KEY UPDATE salaEstudioNombre=VALUES(salaEstudioNombre);

###############################################################################
# TABLA: salaestudioinsumo
###############################################################################
CREATE TABLE IF NOT EXISTS `salaestudioinsumo` (
  `idSalaEstudio` int(4) NOT NULL,
  `idInsumo` int(4) NOT NULL,
  PRIMARY KEY (`idSalaEstudio`, `idInsumo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

###############################################################################
# TABLA: turno
###############################################################################
CREATE TABLE IF NOT EXISTS `turno` (
  `idTurno` int(4) NOT NULL AUTO_INCREMENT,
  `diaTurno` varchar(10) NOT NULL,
  `horaTurno` varchar(10) NOT NULL,
  `idEspecialista` int(4) NOT NULL,
  `costo` int(10) NOT NULL DEFAULT 0,
  `estadoTurno` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idTurno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `turno` (`idTurno`, `diaTurno`, `horaTurno`, `idEspecialista`, `costo`, `estadoTurno`) VALUES
(44, '13/11/2024', '16:00', 28, 52000, 1),
(45, '13/11/2024', '16:00', 29, 15000, 1)
ON DUPLICATE KEY UPDATE costo=VALUES(costo);

###############################################################################
# TABLA: usuario
###############################################################################
CREATE TABLE IF NOT EXISTS `usuario` (
  `idusuario` int(4) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `perfil` varchar(30) NOT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `usuario` (`idusuario`, `usuario`, `password`, `perfil`) VALUES
(10, '21522177', '1', 'Administrador'),
(11, '22522177', '1', 'Recepcionista'),
(12, '23522177', '1', 'Doctor'),
(13, '26522177', '1', 'Paciente'),
(14, '24522177', '1', 'Doctor')
ON DUPLICATE KEY UPDATE password=VALUES(password), perfil=VALUES(perfil);

###############################################################################
# FIN DEL SCRIPT
###############################################################################
