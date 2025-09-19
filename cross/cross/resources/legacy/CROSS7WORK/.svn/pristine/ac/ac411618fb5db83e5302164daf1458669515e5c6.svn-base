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
    applcodigos character varying(10) NOT NULL, -- C骴igo de la aplicaci髇
    stylcodigos character varying(10) NOT NULL, --C骴igo del estilo
    langcodigos character varying(10) NOT NULL, -- C骴igo del lenguaje
    profcodigos character varying(10) NOT NULL, -- C骴igo del perfil
    authestados character varying(1) NOT NULL DEFAULT 'A'-- Codigo del perfil
);

CREATE TABLE authschema (
    authusernams character varying(100) NOT NULL, -- Nombre de usuario
    schecodigon varchar(30) NOT NULL
);

CREATE TABLE profiles (
	profcodigos character varying(10) NOT NULL, -- C骴igo del perfil
	applcodigos character varying(10) NOT NULL, -- C骴igo de la aplicaci髇
	profnombres character varying(100) NOT NULL, -- Nombre del perfil
	profdescrips text -- Descripci贸n
);

CREATE TABLE applications (
	applcodigos character varying(10) NOT NULL, -- C骴igo de la aplicaci髇
	applnombres character varying(100) NOT NULL, -- Nombre de la aplicaci贸n
	applobservas text -- Descripci贸n
);

CREATE TABLE style(
	stylcodigos character varying(10) NOT NULL, --C骴igo del estilo
	applcodigos character varying(10) NOT NULL, -- C骴igo de la aplicaci髇
	stylnombres character varying(100) NOT NULL, -- Nombre del estilo
	stylobservas text -- Descripci贸n
);

CREATE TABLE language(
	langcodigos character varying(10) NOT NULL, --Codigo del lenguaje
	langnombres character varying(100) NOT NULL, -- Nombre del lenguaje
	langobservas text -- Descripci贸n
);

CREATE TABLE permisions(
	schecodigon character varying(30) NOT NULL, -- C骴igo del schema
	profcodigos character varying(10) NOT NULL, -- C骴igo del perfil
	applcodigos character varying(10) NOT NULL, -- C骴igo de la aplicaci髇
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
