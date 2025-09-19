-- Tipos de bodega
CREATE TABLE tipobodega (
    tibocodigos character varying(30) NOT NULL,
    tibonombres character varying(100)NOT NULL,
    tibodescrips text
);
-- Bodegas
CREATE TABLE bodega (
    bodecodigos character varying(30) NOT NULL,
    tibocodigos character varying(30) NOT NULL,
    bodenonbres character varying(100)NOT NULL,
    bodedescrips character varying(150),
    orgacodigos character varying(30) NOT NULL,
    bodefechcred character varying(30)NOT NULL,
    bodefechfind character varying(30), -- Fecha en la que se desactivo
    bodeestados character varying(1) DEFAULT 'A'
);
-- Movimientos de almacen
CREATE TABLE movimialmace (
    moalcodigos character varying(30) NOT NULL,
    bodecodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    moalfechmovd integer NOT NULL,
    comocodigos character varying(30) NOT NULL,
    moalcantrecf double precision NOT NULL,
    perscodigos character varying(30) NOT NULL, --Personal que registra
    tidocodigos character varying(30) NOT NULL, -- TIPO DE DOCUMENTO
    moalnumedocs character varying(30) NOT NULL, -- NUMERO DE DOCUMENTO
    moalsignos character varying(1) NOT NULL -- SIGNO + O -
);
-- Movimientos de recusrsos seriados por bodega
CREATE TABLE recuseribode (
    resbnumedocu character varying(30) NOT NULL, -- Numero del documento
    recucodigos character varying(30) NOT NULL, 
    resbserirecu character varying(20) NOT NULL,
    resbbodeactu character varying(50) NOT NULL,
    resbbodeante character varying(30) NOT NULL,
    resbfechmovi integer NOT NULL,
    perscodigos character varying(30) NOT NULL
);
-- Conceptos de movimiento
CREATE TABLE concepmovimi (
    comocodigos character varying(30) NOT NULL,
    comonombres character varying(100) NOT NULL,
    comosentidos character varying(1) NOT NULL, -- + O - 
    comodescrips text
);
-- Tipos de documento
CREATE TABLE tipodocument (
    tidocodigos character varying(30) NOT NULL,
    tidonombres character varying(150) NOT NULL,
    tidodescrips text
);
-- Tipos de recurso, si es seriado o no
CREATE TABLE tiporecurso (
    tirecodigos character varying(30) NOT NULL,
    tirenombres character varying(100) NOT NULL,
    tiredescrips text
);
-- grupos de recursos, si es una herramienta, de dotacion etc
CREATE TABLE gruporecurso (
    grrecodigos character varying(30) NOT NULL,
    grrenombres character varying(100) NOT NULL,
    grredescrips character varying(150)
);
-- Recursos
CREATE TABLE recurso (
    recucodigos character varying(30) NOT NULL,
    recunombres character varying(150)NOT NULL,
    grrecodigos character varying(30) NOT NULL,
    tirecodigos character varying(30) NOT NULL,
    unmecodigos character varying(30) NOT NULL,
    recudescrips text
);
-- Unidades de medida
CREATE TABLE unidadmedida (
    unmecodigos character varying(30) NOT NULL,
    unmenombres character varying(100) NOT NULL,
    unmesiglas character varying(10) NOT NULL,
    unmedescrips text
);
-- Proveedores de recursos
CREATE TABLE proveedor (
    provcodigos character varying(30) NOT NULL,
    provnombres character varying(100)NOT NULL,
    provnnomreprs character varying(100),
    provdireccis character varying(100),
    protelefons character varying(30),
    provemails character varying(100),
    provwebs character varying(100),
    paiscodigos character varying(30), -- Desde localizacion
    depacodigos character varying(30), -- Desde localizacion
    ciudcodigos character varying(30) -- Desde localizacion
);
-- Recursos Vs proveedores
CREATE TABLE proveerecurs (
	prrecodigos character varying(30) NOT NULL,
    provcodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    prrevalorecf double precision
);