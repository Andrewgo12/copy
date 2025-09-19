-- Postgres
-- Por si existe el esquema public por defecto
-- ALTER Schema public RENAME TO profiles;
--SET DEFAULT_TABLESPACE = 'cross';
CREATE SCHEMA profiles;
SET search_path = profiles, pg_catalog;
CREATE TABLE auth (
    authusernams character varying(100) NOT NULL, -- Nombre de usuario
    authuserpasss character varying(100) NOT NULL, -- Clave
    authrealname character varying(100) NOT NULL, -- Nombres reales del usuario
    authrealape1 character varying(100) DEFAULT NULL, -- Primer apellido real del usuario
    authrealape2 character varying(100) DEFAULT NULL, -- Segundo apellido  real del usuario
    authemail character varying(100) DEFAULT NULL, -- Email
    applcodigos character varying(10) NOT NULL, -- C��digo de la aplicaci��n
    stylcodigos character varying(10) NOT NULL, --C��digo del estilo
    langcodigos character varying(10) NOT NULL, -- C��digo del lenguaje
    profcodigos character varying(10) NOT NULL, -- C��digo del perfil
    authestados character varying(1) NOT NULL DEFAULT 'A'-- Codigo del perfil
);

CREATE TABLE authschema (
    authusernams character varying(100) NOT NULL, -- Nombre de usuario
    schecodigon varchar(30) NOT NULL
);

CREATE TABLE profiles (
	profcodigos character varying(10) NOT NULL, -- C��digo del perfil
	applcodigos character varying(10) NOT NULL, -- C��digo de la aplicaci��n
	profnombres character varying(100) NOT NULL, -- Nombre del perfil
	profdescrips text 							-- Descripci��n
);

CREATE TABLE applications (
	applcodigos character varying(10) NOT NULL, -- C��digo de la aplicaci��n
	applnombres character varying(100) NOT NULL, -- Nombre de la aplicaci��n
	applobservas text 							-- Descripci��n
);

CREATE TABLE style(
	stylcodigos character varying(10) NOT NULL, --C��digo del estilo
	applcodigos character varying(10) NOT NULL, -- C��igo de la aplicaci��n
	stylnombres character varying(100) NOT NULL, -- Nombre del estilo
	stylobservas text 							-- Descripci��n
);

CREATE TABLE language(
	langcodigos character varying(10) NOT NULL, --C��digo del lenguaje
	langnombres character varying(100) NOT NULL, -- Nombre del lenguaje
	langobservas text 							-- Descripci��n
);

CREATE TABLE permisions(
	schecodigon character varying(30) NOT NULL, -- C��digo del schema
	profcodigos character varying(10) NOT NULL, -- C��digo del perfil
	applcodigos character varying(10) NOT NULL, -- C��igo de la aplicaci��n
	commnombres character varying(100) NOT NULL -- Nombre del lenguaje	
);

CREATE TABLE schema
(
  schecodigon varchar(30) NOT NULL,
  schenombres varchar(100) NOT NULL,
  schedbusers varchar(100) NOT NULL,
  schedbkeys varchar(100) NOT NULL,
  scheobservas text,
  scheestados varchar(1) DEFAULT 'A'
) ;

CREATE TABLE numerador (
    numecodigos varchar(30) NOT NULL,
    numedescrips text,
    numeproximon integer
);
-- End Postgres