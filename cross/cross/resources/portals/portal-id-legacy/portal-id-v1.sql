--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.19
-- Dumped by pg_dump version 9.6.18

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: aplicaciones; Type: TABLE; Schema: public; Owner: fullengi
--

CREATE TABLE public.aplicaciones (
    aplicodigon integer NOT NULL,
    aplinombres character varying(70) NOT NULL,
    aplidescrips character varying(250),
    usuacodigos character varying(20) NOT NULL,
    aplifecregd timestamp(0) without time zone DEFAULT now() NOT NULL,
    apliestados character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.aplicaciones OWNER TO fullengi;

--
-- Name: TABLE aplicaciones; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON TABLE public.aplicaciones IS 'Tabla que almacena la información de los aplicaciones.';


--
-- Name: clientes_sec; Type: SEQUENCE; Schema: public; Owner: fullengi_portaliddb
--

CREATE SEQUENCE public.clientes_sec
    START WITH 74
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 99999
    CACHE 1
    CYCLE;


ALTER TABLE public.clientes_sec OWNER TO fullengi_portaliddb;

--
-- Name: clientes; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.clientes (
    cliecodigon integer DEFAULT nextval('public.clientes_sec'::regclass) NOT NULL,
    tiidcodigos character varying(3) NOT NULL,
    clieidentifs character varying(15) NOT NULL,
    clienombres character varying(250) NOT NULL,
    paiscodigos character varying(3) NOT NULL,
    cliedireccis character varying(150),
    clietelfijs character varying(15),
    cliepagwebs character varying(120),
    cliecontacts character varying(60) NOT NULL,
    cliecelconts character varying(20),
    cliemailcons character varying(60) NOT NULL,
    esclcodigos character varying(3) DEFAULT 'EC1'::character varying NOT NULL,
    ticlcodigos character varying(3) DEFAULT 'TC1'::character varying NOT NULL,
    cliefcharegd timestamp(0) without time zone DEFAULT now() NOT NULL,
    clieactivos character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.clientes OWNER TO fullengi_portaliddb;

--
-- Name: TABLE clientes; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON TABLE public.clientes IS 'Tabla que almacena la información de los tipos de clientes.';


--
-- Name: COLUMN clientes.cliecodigon; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliecodigon IS 'Código del cliente.';


--
-- Name: COLUMN clientes.tiidcodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.tiidcodigos IS 'Código del tipo de identificación.';


--
-- Name: COLUMN clientes.clieidentifs; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.clieidentifs IS 'Número de identificación del cliente.';


--
-- Name: COLUMN clientes.clienombres; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.clienombres IS 'Nombre del clientes.';


--
-- Name: COLUMN clientes.paiscodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.paiscodigos IS 'Código del país.';


--
-- Name: COLUMN clientes.cliedireccis; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliedireccis IS 'Dirección.';


--
-- Name: COLUMN clientes.clietelfijs; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.clietelfijs IS 'Teléfono.';


--
-- Name: COLUMN clientes.cliepagwebs; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliepagwebs IS 'Página Web de la empresa.';


--
-- Name: COLUMN clientes.cliecontacts; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliecontacts IS 'Nombre del contacto de la empresa.';


--
-- Name: COLUMN clientes.cliecelconts; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliecelconts IS 'Celular o whatsapp del contacto de la empresa.';


--
-- Name: COLUMN clientes.cliemailcons; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliemailcons IS 'Correo del contacto de la empresa.';


--
-- Name: COLUMN clientes.esclcodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.esclcodigos IS 'Código del estado del cliente.';


--
-- Name: COLUMN clientes.ticlcodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.ticlcodigos IS 'Código del tipo de cliente.';


--
-- Name: COLUMN clientes.cliefcharegd; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.cliefcharegd IS 'Fecha de registro.';


--
-- Name: COLUMN clientes.clieactivos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.clientes.clieactivos IS 'Estado del registro.';


--
-- Name: directorioactivos_sec; Type: SEQUENCE; Schema: public; Owner: fullengi_portaliddb
--

CREATE SEQUENCE public.directorioactivos_sec
    START WITH 74
    INCREMENT BY 1
    MINVALUE 0
    MAXVALUE 99999
    CACHE 1
    CYCLE;


ALTER TABLE public.directorioactivos_sec OWNER TO fullengi_portaliddb;

--
-- Name: directorioactivos; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.directorioactivos (
    diaccodigos integer DEFAULT nextval('public.directorioactivos_sec'::regclass) NOT NULL,
    cliecodigon integer NOT NULL,
    diacdireccis character varying(200) NOT NULL,
    diacpuertos character varying(4) NOT NULL,
    diacldaps character(1) DEFAULT 'N'::bpchar NOT NULL,
    diacusernams character varying(200),
    diacpasswds character varying(200),
    diacdominios character varying(200),
    diacfcharegd timestamp(0) without time zone DEFAULT now() NOT NULL,
    diacestados character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.directorioactivos OWNER TO fullengi_portaliddb;

--
-- Name: TABLE directorioactivos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON TABLE public.directorioactivos IS 'Tabla que almacena la información de los directorios activos de los clientes.';


--
-- Name: COLUMN directorioactivos.diaccodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diaccodigos IS 'Código del directorio activo.';


--
-- Name: COLUMN directorioactivos.cliecodigon; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.cliecodigon IS 'Código del clientes.';


--
-- Name: COLUMN directorioactivos.diacdireccis; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacdireccis IS 'Dirección del directorio activo.';


--
-- Name: COLUMN directorioactivos.diacpuertos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacpuertos IS 'Puerto del directorio activo.';


--
-- Name: COLUMN directorioactivos.diacldaps; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacldaps IS 'Tiene LDAP TLS/SSL ?';


--
-- Name: COLUMN directorioactivos.diacusernams; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacusernams IS 'Usuario.';


--
-- Name: COLUMN directorioactivos.diacpasswds; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacpasswds IS 'Contraseña.';


--
-- Name: COLUMN directorioactivos.diacdominios; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacdominios IS 'Dominio.';


--
-- Name: COLUMN directorioactivos.diacfcharegd; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacfcharegd IS 'Fecha de registro.';


--
-- Name: COLUMN directorioactivos.diacestados; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.directorioactivos.diacestados IS 'Estado del registro.';


--
-- Name: estadosclientes; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.estadosclientes (
    esclcodigos character varying(3) NOT NULL,
    esclnombres character varying(50) NOT NULL,
    escldescrips character varying(100),
    esclfcharegd timestamp(0) without time zone DEFAULT now() NOT NULL,
    esclactivos character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.estadosclientes OWNER TO fullengi_portaliddb;

--
-- Name: TABLE estadosclientes; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON TABLE public.estadosclientes IS 'Tabla que almacena la información de los estados de clientes.';


--
-- Name: COLUMN estadosclientes.esclcodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.estadosclientes.esclcodigos IS 'Código del tipo de clientes.';


--
-- Name: COLUMN estadosclientes.esclnombres; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.estadosclientes.esclnombres IS 'Nombre del tipo de clientes.';


--
-- Name: COLUMN estadosclientes.escldescrips; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.estadosclientes.escldescrips IS 'Descripción.';


--
-- Name: COLUMN estadosclientes.esclfcharegd; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.estadosclientes.esclfcharegd IS 'Fecha de registro.';


--
-- Name: COLUMN estadosclientes.esclactivos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.estadosclientes.esclactivos IS 'Estado del registro.';


--
-- Name: metodosauths; Type: TABLE; Schema: public; Owner: fullengi
--

CREATE TABLE public.metodosauths (
    meaucodigon integer NOT NULL,
    meaunombres character varying(70) NOT NULL,
    meaudescrips character varying(50),
    usuacodigos character varying(20) NOT NULL,
    meaufecregd timestamp(0) without time zone DEFAULT now() NOT NULL,
    meauestados character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.metodosauths OWNER TO fullengi;

--
-- Name: TABLE metodosauths; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON TABLE public.metodosauths IS 'Tabla que almacena la información de los métodos de autenticación.';


--
-- Name: COLUMN metodosauths.meaucodigon; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.metodosauths.meaucodigon IS 'Código del método de autenticación.';


--
-- Name: COLUMN metodosauths.meaunombres; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.metodosauths.meaunombres IS 'Nombre del método de autenticación.';


--
-- Name: COLUMN metodosauths.meaudescrips; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.metodosauths.meaudescrips IS 'Descripción.';


--
-- Name: COLUMN metodosauths.usuacodigos; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.metodosauths.usuacodigos IS 'Usuario de registro.';


--
-- Name: COLUMN metodosauths.meaufecregd; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.metodosauths.meaufecregd IS 'Fecha de registro.';


--
-- Name: COLUMN metodosauths.meauestados; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.metodosauths.meauestados IS 'Estado del registro.';


--
-- Name: onegatelogs; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.onegatelogs (
    ongacodigon integer NOT NULL,
    ongafechas date NOT NULL,
    ongahorad character varying(15) NOT NULL,
    onganodos character varying(5) NOT NULL,
    ongaidonegas character varying(15) NOT NULL,
    ongavirhosts character varying(5) NOT NULL,
    ongacadenas text NOT NULL,
    ongaarchivs character varying(80),
    ongafechains timestamp(0) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.onegatelogs OWNER TO fullengi_portaliddb;

--
-- Name: onegatelogs_ongacodigon_seq; Type: SEQUENCE; Schema: public; Owner: fullengi_portaliddb
--

CREATE SEQUENCE public.onegatelogs_ongacodigon_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.onegatelogs_ongacodigon_seq OWNER TO fullengi_portaliddb;

--
-- Name: onegatelogs_ongacodigon_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: fullengi_portaliddb
--

ALTER SEQUENCE public.onegatelogs_ongacodigon_seq OWNED BY public.onegatelogs.ongacodigon;


--
-- Name: paises; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.paises (
    paiscodigos character varying(3) NOT NULL,
    paisnombres character varying(80) NOT NULL,
    paiscodalf2s character varying(2),
    paiscoddomis character varying(3),
    paisfcharegd timestamp(0) without time zone DEFAULT now() NOT NULL,
    paisactivos character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.paises OWNER TO fullengi_portaliddb;

--
-- Name: TABLE paises; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON TABLE public.paises IS 'Tabla que almacena la información de los países.';


--
-- Name: COLUMN paises.paiscodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.paises.paiscodigos IS 'Código del país ISO 3166 ALPHA-3.';


--
-- Name: COLUMN paises.paisnombres; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.paises.paisnombres IS 'Nombre del país.';


--
-- Name: COLUMN paises.paiscodalf2s; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.paises.paiscodalf2s IS 'Código del país ISO 3166 ALPHA-2.';


--
-- Name: COLUMN paises.paiscoddomis; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.paises.paiscoddomis IS 'Código del dominio de nivel superior.';


--
-- Name: COLUMN paises.paisfcharegd; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.paises.paisfcharegd IS 'Fecha de registro.';


--
-- Name: COLUMN paises.paisactivos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.paises.paisactivos IS 'Estado del registro.';


--
-- Name: publicaciones_publcodigon_seq; Type: SEQUENCE; Schema: public; Owner: fullengi
--

CREATE SEQUENCE public.publicaciones_publcodigon_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.publicaciones_publcodigon_seq OWNER TO fullengi;

--
-- Name: publicaciones; Type: TABLE; Schema: public; Owner: fullengi
--

CREATE TABLE public.publicaciones (
    publcodigon integer DEFAULT nextval('public.publicaciones_publcodigon_seq'::regclass) NOT NULL,
    cliecodigon integer NOT NULL,
    publgrupusrs text NOT NULL,
    aplicodigon integer NOT NULL,
    publpuerton integer NOT NULL,
    meaucodigon integer NOT NULL,
    publurls text NOT NULL,
    publipss character varying(250) NOT NULL,
    publhorarios text NOT NULL,
    usuacodigos character varying(20) NOT NULL,
    publfecregd timestamp(0) without time zone DEFAULT now() NOT NULL,
    publestados character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.publicaciones OWNER TO fullengi;

--
-- Name: TABLE publicaciones; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON TABLE public.publicaciones IS 'Tabla que almacena la información de los recursos publicados.';


--
-- Name: COLUMN publicaciones.publcodigon; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publcodigon IS 'Código de la publicación.';


--
-- Name: COLUMN publicaciones.cliecodigon; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.cliecodigon IS 'Código del cliente.';


--
-- Name: COLUMN publicaciones.publgrupusrs; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publgrupusrs IS 'Grupos de usuarios.';


--
-- Name: COLUMN publicaciones.aplicodigon; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.aplicodigon IS 'Código de la aplicación.';


--
-- Name: COLUMN publicaciones.publpuerton; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publpuerton IS 'Puerto.';


--
-- Name: COLUMN publicaciones.meaucodigon; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.meaucodigon IS 'Método de autenticación.';


--
-- Name: COLUMN publicaciones.publurls; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publurls IS 'URL.';


--
-- Name: COLUMN publicaciones.publipss; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publipss IS 'IPs.';


--
-- Name: COLUMN publicaciones.publhorarios; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publhorarios IS 'Horarios.';


--
-- Name: COLUMN publicaciones.usuacodigos; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.usuacodigos IS 'Usuario de registro.';


--
-- Name: COLUMN publicaciones.publfecregd; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publfecregd IS 'Fecha de registro.';


--
-- Name: COLUMN publicaciones.publestados; Type: COMMENT; Schema: public; Owner: fullengi
--

COMMENT ON COLUMN public.publicaciones.publestados IS 'Estado del registro.';


--
-- Name: tiposclientes; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.tiposclientes (
    ticlcodigos character varying(3) NOT NULL,
    ticlnombres character varying(70) NOT NULL,
    ticldescrips character varying(100),
    ticlfcharegd timestamp(0) without time zone DEFAULT now() NOT NULL,
    ticlestados character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.tiposclientes OWNER TO fullengi_portaliddb;

--
-- Name: TABLE tiposclientes; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON TABLE public.tiposclientes IS 'Tabla que almacena la información de los tipos de clientes.';


--
-- Name: COLUMN tiposclientes.ticlcodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposclientes.ticlcodigos IS 'Código del tipo de clientes.';


--
-- Name: COLUMN tiposclientes.ticlnombres; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposclientes.ticlnombres IS 'Nombre del tipo de clientes.';


--
-- Name: COLUMN tiposclientes.ticldescrips; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposclientes.ticldescrips IS 'Descripción.';


--
-- Name: COLUMN tiposclientes.ticlfcharegd; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposclientes.ticlfcharegd IS 'Fecha de registro.';


--
-- Name: COLUMN tiposclientes.ticlestados; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposclientes.ticlestados IS 'Estado del registro.';


--
-- Name: tiposidentifis; Type: TABLE; Schema: public; Owner: fullengi_portaliddb
--

CREATE TABLE public.tiposidentifis (
    tiidcodigos character varying(3) NOT NULL,
    tiidnombres character varying(60) NOT NULL,
    tiidfcharegd timestamp(0) without time zone DEFAULT now() NOT NULL,
    tiidactivos character(1) DEFAULT 'A'::bpchar NOT NULL
);


ALTER TABLE public.tiposidentifis OWNER TO fullengi_portaliddb;

--
-- Name: TABLE tiposidentifis; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON TABLE public.tiposidentifis IS 'Tabla que almacena la información de los tipos de identificación.';


--
-- Name: COLUMN tiposidentifis.tiidcodigos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposidentifis.tiidcodigos IS 'Código del tipo de identificación.';


--
-- Name: COLUMN tiposidentifis.tiidnombres; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposidentifis.tiidnombres IS 'Nombre del tipo de identificación.';


--
-- Name: COLUMN tiposidentifis.tiidfcharegd; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposidentifis.tiidfcharegd IS 'Fecha de registro.';


--
-- Name: COLUMN tiposidentifis.tiidactivos; Type: COMMENT; Schema: public; Owner: fullengi_portaliddb
--

COMMENT ON COLUMN public.tiposidentifis.tiidactivos IS 'Estado del registro.';


--
-- Name: onegatelogs ongacodigon; Type: DEFAULT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.onegatelogs ALTER COLUMN ongacodigon SET DEFAULT nextval('public.onegatelogs_ongacodigon_seq'::regclass);


--
-- Data for Name: aplicaciones; Type: TABLE DATA; Schema: public; Owner: fullengi
--

INSERT INTO public.aplicaciones VALUES (1, 'CROSS', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (2, 'Docunet', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (3, 'Alfresco', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (4, 'Office 365', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (5, 'VMware', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (6, 'G Suite', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (7, 'Microsoft Dynamics', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');
INSERT INTO public.aplicaciones VALUES (8, 'BonitaSoft', NULL, 'cazapata', '2020-09-29 16:15:48', 'A');


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--

INSERT INTO public.clientes VALUES (74, 'CC', '9512700', 'Ricardo Martinez', 'COL', '', '6628828', 'www.portail-id.com', 'Ricardo Martinez', '3184529632', 'ricardo@gmail.com', 'EC1', 'TC1', '2020-09-29 13:38:43', 'A');
INSERT INTO public.clientes VALUES (75, 'NIT', '900061350-9', 'FULLENGINE S.A.', 'COL', '', '', '', 'CARLOS ZAPATA', '', 'cazapata@fullengine.com', 'EC1', 'G10', '2020-10-13 19:40:20', 'A');


--
-- Name: clientes_sec; Type: SEQUENCE SET; Schema: public; Owner: fullengi_portaliddb
--

SELECT pg_catalog.setval('public.clientes_sec', 75, true);


--
-- Data for Name: directorioactivos; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--



--
-- Name: directorioactivos_sec; Type: SEQUENCE SET; Schema: public; Owner: fullengi_portaliddb
--

SELECT pg_catalog.setval('public.directorioactivos_sec', 74, false);


--
-- Data for Name: estadosclientes; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--

INSERT INTO public.estadosclientes VALUES ('EC1', 'Activo', NULL, '2020-05-18 00:19:33', 'A');
INSERT INTO public.estadosclientes VALUES ('EC2', 'Inactivo', NULL, '2020-05-18 00:19:33', 'A');
INSERT INTO public.estadosclientes VALUES ('EC3', 'Bloqueado', NULL, '2020-05-18 00:19:33', 'A');
INSERT INTO public.estadosclientes VALUES ('EC4', 'En mora', NULL, '2020-05-18 00:19:33', 'A');
INSERT INTO public.estadosclientes VALUES ('EC5', 'Suspendido', NULL, '2020-05-18 00:19:33', 'A');


--
-- Data for Name: metodosauths; Type: TABLE DATA; Schema: public; Owner: fullengi
--

INSERT INTO public.metodosauths VALUES (1, 'Web', NULL, 'cazapata', '2020-09-29 15:25:22', 'A');
INSERT INTO public.metodosauths VALUES (2, 'LDAP', NULL, 'cazapata', '2020-09-29 15:25:22', 'A');


--
-- Data for Name: onegatelogs; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--

INSERT INTO public.onegatelogs VALUES (1, '2020-05-08', '02:27:44.740', '[01]', '(4oa2-veBo)', '(01)', 'usuario,ip, metodo auth,navegador,recurso', NULL, '2020-08-02 12:44:00');
INSERT INTO public.onegatelogs VALUES (2, '2020-05-08', '02:27:44.740', '[01]', '(4oa2-veBo)', '(01)', 'usuario,ip, metodo auth,navegador,recurso', 'OK', '2020-08-02 12:44:27');
INSERT INTO public.onegatelogs VALUES (3, '2020-05-08', '02:27:44.740', '[01]', '(4oa2-veBo)', '(01)', 'usuario,ip, metodo auth,navegador,recurso', 'OK', '2020-08-02 22:17:08');
INSERT INTO public.onegatelogs VALUES (4, '2020-05-10', '02:27:44.740', '[01]', '(4oa2-veBo)', '(01)', 'usuario,ip, metodo auth,navegador,recurso', 'OK', '2020-08-02 22:18:33');
INSERT INTO public.onegatelogs VALUES (5, '2020-05-10', '02:40:44.740', '[01]', '(4oa2-veBo)', '(01)', 'usuario,ip, metodo auth,navegador,recurso', NULL, '2020-08-02 22:18:53');
INSERT INTO public.onegatelogs VALUES (6, '2020-05-10', '04:49:44.740', '[01]', '(4oa2-veBo)', '(01)', 'usuario,ip, metodo auth,navegador,recurso', 'LOGS_ONEGATE.xlsx', '2020-08-03 07:49:29');


--
-- Name: onegatelogs_ongacodigon_seq; Type: SEQUENCE SET; Schema: public; Owner: fullengi_portaliddb
--

SELECT pg_catalog.setval('public.onegatelogs_ongacodigon_seq', 6, true);


--
-- Data for Name: paises; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--

INSERT INTO public.paises VALUES ('AFG', 'Afganistán', 'AF', '.af', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ALA', 'Islas de Åland', 'AX', '.ax', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ALB', 'Albania', 'AL', '.al', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('DZA', 'Argelia', 'DZ', '.dz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ASM', 'Samoa Americana', 'AS', '.as', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('AND', 'Andorra', 'AD', '.ad', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('AGO', 'Angola', 'AO', '.ao', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('AIA', 'Anguila', 'AI', '.ai', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ATA', 'Antártida', 'AQ', '.aq', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ATG', 'Antigua y Barbuda', 'AG', '.ag', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ARG', 'Argentina', 'AR', '.ar', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ARM', 'Armenia', 'AM', '.am', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ABW', 'Aruba', 'AW', '.aw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('AUS', 'Australia', 'AU', '.au', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('AUT', 'Austria', 'AT', '.at', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('AZE', 'Azerbaiyán', 'AZ', '.az', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BHS', 'Bahamas', 'BS', '.bs', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BHR', 'Baréin', 'BH', '.bh', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BGD', 'Bangladesh', 'BD', '.bd', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BRB', 'Barbados', 'BB', '.bb', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BLR', 'Bielorrusia', 'BY', '.by', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BEL', 'Bélgica', 'BE', '.be', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BLZ', 'Belice', 'BZ', '.bz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BEN', 'Benín', 'BJ', '.bj', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BMU', 'Bermuda', 'BM', '.bm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BTN', 'Bután', 'BT', '.bt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BOL', 'Bolivia', 'BO', '.bo', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BES', 'Bonaire, San Eustaquio y Saba', 'BQ', '.bq', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BIH', 'Bosnia y Herzegovina', 'BA', '.ba', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BWA', 'Botsuana', 'BW', '.bw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BVT', 'Isla Bouvet', 'BV', '.bv', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BRA', 'Brasil', 'BR', '.br', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IOT', 'Territorio Británico del Océano Índico', 'IO', '.io', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VGB', 'Islas Vírgenes Británicas', 'VG', '.vg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BRN', 'Brunei', 'BN', '.bn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BGR', 'Bulgaria', 'BG', '.bg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BFA', 'Burkina Faso', 'BF', '.bf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BDI', 'Burundi', 'BI', '.bi', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KHM', 'Camboya', 'KH', '.kh', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CMR', 'Camerún', 'CM', '.cm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CAN', 'Canadá', 'CA', '.ca', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CPV', 'Cabo Verde', 'CV', '.cv', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CYM', 'Islas Caimán', 'KY', '.ky', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CAF', 'República de África Central', 'CF', '.cf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TCD', 'Chad', 'TD', '.td', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CHL', 'Chile', 'CL', '.cl', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CHN', 'China', 'CN', '.cn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CXR', 'Isla de Pascua', 'CX', '.cx', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CCK', 'Islas Cocos', 'CC', '.cc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('COL', 'Colombia', 'CO', '.co', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('COM', 'Comoras', 'KM', '.km', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('COK', 'Islas Cook', 'CK', '.ck', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CRI', 'Costa Rica', 'CR', '.cr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('HRV', 'Croacia', 'HR', '.hr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CUB', 'Cuba', 'CU', '.cu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CUW', 'Curazao', 'CW', '.cw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CYP', 'Chipre', 'CY', '.cy', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CZE', 'República Checa', 'CZ', '.cz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('COD', 'República Democrática del Congo', 'CD', '.cd', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('DNK', 'Dinamarca', 'DK', '.dk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('DJI', 'Yibuti', 'DJ', '.dj', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('DMA', 'Dominica', 'DM', '.dm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('DOM', 'República Dominicana', 'DO', '.do', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TLS', 'Timor Oriental', 'TL', '.tl', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ECU', 'Ecuador', 'EC', '.ec', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('EGY', 'Egipto', 'EG', '.eg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SLV', 'El Salvador', 'SV', '.sv', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GNQ', 'Guinea Ecuatorial', 'GQ', '.gq', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ERI', 'Eritrea', 'ER', '.er', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('EST', 'Estonia', 'EE', '.ee', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ETH', 'Etiopía', 'ET', '.et', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('FLK', 'Islas Malvinas', 'FK', '.fk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('FRO', 'Islas Faroe', 'FO', '.fo', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('FJI', 'Fiji', 'FJ', '.fj', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('FIN', 'Finlandia', 'FI', '.fi', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('FRA', 'Francia', 'FR', '.fr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GUF', 'Guayana Francesa', 'GF', '.gf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PYF', 'Polinesia Francesa', 'PF', '.pf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ATF', 'Territorios del sur Franceses', 'TF', '.tf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GAB', 'Gabón', 'GA', '.ga', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GMB', 'Gambia', 'GM', '.gm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GEO', 'Georgia', 'GE', '.ge', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('DEU', 'Alemania', 'DE', '.de', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GHA', 'Ghana', 'GH', '.gh', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GIB', 'Gibraltar', 'GI', '.gi', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GRC', 'Grecia', 'GR', '.gr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GRL', 'Groenlandia', 'GL', '.gl', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GRD', 'Granada', 'GD', '.gd', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GLP', 'Guadalupe', 'GP', '.gp', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GUM', 'Guam', 'GU', '.gu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GTM', 'Guatemala', 'GT', '.gt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GGY', 'Guernsey', 'GG', '.gg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GIN', 'Guinea', 'GN', '.gn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GNB', 'Guinea Bissau', 'GW', '.gw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GUY', 'Guyana', 'GY', '.gy', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('HTI', 'Haití', 'HT', '.ht', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('HMD', 'Islas Heard y McDonald', 'HM', '.hm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('HND', 'Honduras', 'HN', '.hn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('HKG', 'Hong Kong', 'HK', '.hk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('HUN', 'Hungría', 'HU', '.hu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ISL', 'Islandia', 'IS', '.is', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IND', 'India', 'IN', '.in', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IDN', 'Indonesia', 'ID', '.id', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IRN', 'Irán', 'IR', '.ir', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IRQ', 'Irak', 'IQ', '.iq', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IRL', 'Irlanda', 'IE', '.ie', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('IMN', 'Isla de Man', 'IM', '.im', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ISR', 'Israel', 'IL', '.il', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ITA', 'Italia', 'IT', '.it', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CIV', 'Costa de Marfil', 'CI', '.ci', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('JAM', 'Jamaica', 'JM', '.jm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('JPN', 'Japón', 'JP', '.jp', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('JEY', 'Jersey', 'JE', '.je', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('JOR', 'Jordania', 'JO', '.jo', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KAZ', 'Kazajistán', 'KZ', '.kz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KEN', 'Kenia', 'KE', '.ke', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KIR', 'Kiribati', 'KI', '.ki', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('XKX', 'Kosovo', 'XK', '', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KWT', 'Kuwait', 'KW', '.kw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KGZ', 'Kirguistán', 'KG', '.kg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LAO', 'Laos', 'LA', '.la', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LVA', 'Letonia', 'LV', '.lv', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LBN', 'Líbano', 'LB', '.lb', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LSO', 'Lesoto', 'LS', '.ls', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LBR', 'Liberia', 'LR', '.lr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LBY', 'Libia', 'LY', '.ly', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LIE', 'Liechtenstein', 'LI', '.li', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LTU', 'Lituania', 'LT', '.lt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LUX', 'Luxemburgo', 'LU', '.lu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MAC', 'Macao', 'MO', '.mo', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MKD', 'Macedonia', 'MK', '.mk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MDG', 'Madagascar', 'MG', '.mg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MWI', 'Malaui', 'MW', '.mw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MYS', 'Malasia', 'MY', '.my', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MDV', 'Maldivas', 'MV', '.mv', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MLI', 'Malí', 'ML', '.ml', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MLT', 'Malta', 'MT', '.mt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MHL', 'Islas Marshall', 'MH', '.mh', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MTQ', 'Martinica', 'MQ', '.mq', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MRT', 'Mauritania', 'MR', '.mr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MUS', 'Mauricio', 'MU', '.mu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MYT', 'Mayotte', 'YT', '.yt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MEX', 'México', 'MX', '.mx', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('FSM', 'Micronesia', 'FM', '.fm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MDA', 'Moldavia', 'MD', '.md', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MCO', 'Mónaco', 'MC', '.mc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MNG', 'Mongolia', 'MN', '.mn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MNE', 'Montenegro', 'ME', '.me', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MSR', 'Montserrat', 'MS', '.ms', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MAR', 'Marruecos', 'MA', '.ma', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MOZ', 'Mozambique', 'MZ', '.mz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MMR', 'Myanmar', 'MM', '.mm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NAM', 'Namibia', 'NA', '.na', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NRU', 'Nauru', 'NR', '.nr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NPL', 'Nepal', 'NP', '.np', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NLD', 'Países Bajos', 'NL', '.nl', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ANT', 'Antillas Holandesas', 'AN', '.an', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NCL', 'Nueva Caledonia', 'NC', '.nc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NZL', 'Nueva Zelanda', 'NZ', '.nz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NIC', 'Nicaragua', 'NI', '.ni', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NER', 'Níger', 'NE', '.ne', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NGA', 'Nigeria', 'NG', '.ng', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NIU', 'Niue', 'NU', '.nu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NFK', 'Isla Norfolk', 'NF', '.nf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PRK', 'Corea del Norte', 'KP', '.kp', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MNP', 'Islas Marianas del Norte', 'MP', '.mp', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('NOR', 'Noruega', 'NO', '.no', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('OMN', 'Omán', 'OM', '.om', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PAK', 'Pakistán', 'PK', '.pk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PLW', 'Palaos', 'PW', '.pw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PSE', 'Territorios Palestinos', 'PS', '.ps', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PAN', 'Panamá', 'PA', '.pa', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PNG', 'Papúa Nueva Guinea', 'PG', '.pg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PRY', 'Paraguay', 'PY', '.py', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PER', 'Perú', 'PE', '.pe', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PHL', 'Filipinas', 'PH', '.ph', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PCN', 'Islas Pitcairn', 'PN', '.pn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('POL', 'Polonia', 'PL', '.pl', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PRT', 'Portugal', 'PT', '.pt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('PRI', 'Puerto Rico', 'PR', '.pr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('QAT', 'Catar', 'QA', '.qa', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('COG', 'República del Congo', 'CG', '.cg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('REU', 'Reunión', 'RE', '.re', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ROU', 'Rumanía', 'RO', '.ro', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('RUS', 'Rusia', 'RU', '.ru', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('RWA', 'Ruanda', 'RW', '.rw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('BLM', 'San Bartolomé', 'BL', '.gp', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SHN', 'Santa Elena', 'SH', '.sh', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KNA', 'San Cristóbal y Nieves', 'KN', '.kn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LCA', 'Santa Lucía', 'LC', '.lc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('MAF', 'San Martín', 'MF', '.gp', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SPM', 'San Pedro y Miguelón', 'PM', '.pm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VCT', 'San Vicente y las Granadinas', 'VC', '.vc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('WSM', 'Samoa Occidental', 'WS', '.ws', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SMR', 'San Marino', 'SM', '.sm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('STP', 'Santo Tomé y Príncipe', 'ST', '.st', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SAU', 'Arabia Saudita', 'SA', '.sa', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SEN', 'Senegal', 'SN', '.sn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SRB', 'Serbia', 'RS', '.rs', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SCG', 'Serbia y Montenegro', 'CS', '.cs', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SYC', 'Seychelles', 'SC', '.sc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SLE', 'Sierra Leona', 'SL', '.sl', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SGP', 'Singapur', 'SG', '.sg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SXM', 'San Martín', 'SX', '.sx', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SVK', 'Eslovaquia', 'SK', '.sk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SVN', 'Eslovenia', 'SI', '.si', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SLB', 'Islas Salomón', 'SB', '.sb', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SOM', 'Somalia', 'SO', '.so', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ZAF', 'Sudáfrica', 'ZA', '.za', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SGS', 'Islas Georgia del Sur y Sandwich del Sur', 'GS', '.gs', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('KOR', 'Corea del Sur', 'KR', '.kr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SSD', 'Sudán del Sur', 'SS', '', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ESP', 'España', 'ES', '.es', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('LKA', 'Sri Lanka', 'LK', '.lk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SDN', 'Sudán', 'SD', '.sd', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SUR', 'Surinam', 'SR', '.sr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SJM', 'Islas Svalbard y Jan Mayen', 'SJ', '.sj', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SWZ', 'Suazilandia', 'SZ', '.sz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SWE', 'Suecia', 'SE', '.se', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('CHE', 'Suiza', 'CH', '.ch', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('SYR', 'Siria', 'SY', '.sy', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TWN', 'Taiwán', 'TW', '.tw', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TJK', 'Tayikistán', 'TJ', '.tj', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TZA', 'Tanzania', 'TZ', '.tz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('THA', 'Tailandia', 'TH', '.th', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TGO', 'República Togolesa', 'TG', '.tg', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TKL', 'Islas Tokelau', 'TK', '.tk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TON', 'Tonga', 'TO', '.to', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TTO', 'Trinidad y Tobago', 'TT', '.tt', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TUN', 'Túnez', 'TN', '.tn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TUR', 'Turquía', 'TR', '.tr', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TKM', 'Turkmenistán', 'TM', '.tm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TCA', 'Islas Turcos y Caicos', 'TC', '.tc', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('TUV', 'Tuvalu', 'TV', '.tv', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VIR', 'Islas Vírgenes de los EE.UU.', 'VI', '.vi', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('UGA', 'Uganda', 'UG', '.ug', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('UKR', 'Ucrania', 'UA', '.ua', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ARE', 'Emiratos Árabes Unidos', 'AE', '.ae', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('GBR', 'Reino Unido', 'GB', '.uk', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('USA', 'Estados Unidos (USA)', 'US', '.us', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('UMI', 'Islas menores alejadas de los Estados Unidos', 'UM', '.um', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('URY', 'Uruguay', 'UY', '.uy', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('UZB', 'Uzbekistán', 'UZ', '.uz', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VUT', 'Vanuatu', 'VU', '.vu', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VAT', 'Vaticano', 'VA', '.va', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VEN', 'Venezuela', 'VE', '.ve', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('VNM', 'Vietnam', 'VN', '.vn', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('WLF', 'Wallis y Futuna', 'WF', '.wf', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ESH', 'Sahara Occidental', 'EH', '.eh', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('YEM', 'Yemen', 'YE', '.ye', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ZMB', 'Zambia', 'ZM', '.zm', '2020-05-18 01:30:25', 'A');
INSERT INTO public.paises VALUES ('ZWE', 'Zimbabue', 'ZW', '.zw', '2020-05-18 01:30:25', 'A');


--
-- Data for Name: publicaciones; Type: TABLE DATA; Schema: public; Owner: fullengi
--

INSERT INTO public.publicaciones VALUES (1, 74, 'Administrativo / Sistemas', 1, 8080, 1, 'http://172.30.100.105/cross/apps/CROSS7WORK/ASAP/applications/general/index.php', '172.30.100.105', '08:00 - 18:00', '', '2020-09-29 17:53:19', 'A');


--
-- Name: publicaciones_publcodigon_seq; Type: SEQUENCE SET; Schema: public; Owner: fullengi
--

SELECT pg_catalog.setval('public.publicaciones_publcodigon_seq', 1, true);


--
-- Data for Name: tiposclientes; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--

INSERT INTO public.tiposclientes VALUES ('G1', 'Sector Gobierno - Educación', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G2', 'Sector Gobierno - Servicios públicos', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G3', 'Sector Gobierno - Recreación', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G4', 'Sector Gobierno - Salud', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G5', 'Sector Gobierno - Telecomunicaciones', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G6', 'Sector Gobierno - Transporte', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G7', 'Sector Gobierno - Financiero', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G8', 'Sector Gobierno - Turístico', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G9', 'Sector Gobierno - De las artes', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G10', 'Sector Gobierno - Ambiental', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G11', 'Sector Gobierno - Minero, Energía', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G12', 'Sector Gobierno - Industrial', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G13', 'Sector Gobierno - Emergencia (Bomberos,Cruz Roja,Defensa civil', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G14', 'Sector Gobierno - Emergencia (Fuerzas armadas y de policía', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G15', 'Sector Gobierno - Organismos de control y vigilancia', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('G50', 'Sector Gobierno - Otros', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P1', 'Sector Privado - Educación', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P2', 'Sector Privado - Servicios públicos', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P3', 'Sector Privado - Recreación', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P4', 'Sector Privado - Salud', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P5', 'Sector Privado - Telecomunicaciones', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P6', 'Sector Privado - Transporte', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P7', 'Sector Privado - Financiero', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P8', 'Sector Privado - Turístico', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P9', 'Sector Privado - De las artes', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P10', 'Sector Privado - Ambiental', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P11', 'Sector Privado - Minero, Energía', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P12', 'Sector Privado - Industrial', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P13', 'Sector Privado - Comercio', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P14', 'Sector Privado - Construcción', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P15', 'Sector Privado - Ganadero', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P16', 'Sector Privado - Agrícola', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P17', 'Sector Privado - Pesquero', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P18', 'Sector Privado - Administración', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P19', 'Sector Privado - Seguridad privada', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P20', 'Sector Privado - Empresas de tecnología', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P21', 'Sector Privado - Servicios de consultoría', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P22', 'Sector Privado - Otros servicios', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('P50', 'Sector Privado - Otros', NULL, '2020-05-18 00:20:27', 'A');
INSERT INTO public.tiposclientes VALUES ('TC1', 'No especificado', NULL, '2020-05-18 00:20:27', 'A');


--
-- Data for Name: tiposidentifis; Type: TABLE DATA; Schema: public; Owner: fullengi_portaliddb
--

INSERT INTO public.tiposidentifis VALUES ('CC', 'Cédula de ciudadanía', '2020-05-19 01:08:40', 'A');
INSERT INTO public.tiposidentifis VALUES ('NIT', 'Número de identificación tributaria', '2020-05-19 01:08:40', 'A');
INSERT INTO public.tiposidentifis VALUES ('PA', 'Pasaporte', '2020-05-19 01:08:40', 'A');


--
-- Name: aplicaciones aplicaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi
--

ALTER TABLE ONLY public.aplicaciones
    ADD CONSTRAINT aplicaciones_pkey PRIMARY KEY (aplicodigon);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (cliecodigon);


--
-- Name: directorioactivos directorioactivos_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.directorioactivos
    ADD CONSTRAINT directorioactivos_pkey PRIMARY KEY (diaccodigos);


--
-- Name: estadosclientes estadosclientes_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.estadosclientes
    ADD CONSTRAINT estadosclientes_pkey PRIMARY KEY (esclcodigos);


--
-- Name: metodosauths metodosauths_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi
--

ALTER TABLE ONLY public.metodosauths
    ADD CONSTRAINT metodosauths_pkey PRIMARY KEY (meaucodigon);


--
-- Name: onegatelogs onegatelogs_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.onegatelogs
    ADD CONSTRAINT onegatelogs_pkey PRIMARY KEY (ongacodigon);


--
-- Name: paises paises_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.paises
    ADD CONSTRAINT paises_pkey PRIMARY KEY (paiscodigos);


--
-- Name: publicaciones publicaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi
--

ALTER TABLE ONLY public.publicaciones
    ADD CONSTRAINT publicaciones_pkey PRIMARY KEY (publcodigon);


--
-- Name: tiposclientes tiposclientes_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.tiposclientes
    ADD CONSTRAINT tiposclientes_pkey PRIMARY KEY (ticlcodigos);


--
-- Name: tiposidentifis tiposidentifis_pkey; Type: CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.tiposidentifis
    ADD CONSTRAINT tiposidentifis_pkey PRIMARY KEY (tiidcodigos);


--
-- Name: clientes clientes_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_fkey FOREIGN KEY (tiidcodigos) REFERENCES public.tiposidentifis(tiidcodigos);


--
-- Name: clientes clientes_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_fkey1 FOREIGN KEY (paiscodigos) REFERENCES public.paises(paiscodigos);


--
-- Name: clientes clientes_fkey2; Type: FK CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_fkey2 FOREIGN KEY (esclcodigos) REFERENCES public.estadosclientes(esclcodigos);


--
-- Name: clientes clientes_fkey3; Type: FK CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_fkey3 FOREIGN KEY (ticlcodigos) REFERENCES public.tiposclientes(ticlcodigos);


--
-- Name: directorioactivos directorioactivos_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fullengi_portaliddb
--

ALTER TABLE ONLY public.directorioactivos
    ADD CONSTRAINT directorioactivos_fkey FOREIGN KEY (cliecodigon) REFERENCES public.clientes(cliecodigon);


--
-- Name: publicaciones publicaciones_fkey; Type: FK CONSTRAINT; Schema: public; Owner: fullengi
--

ALTER TABLE ONLY public.publicaciones
    ADD CONSTRAINT publicaciones_fkey FOREIGN KEY (cliecodigon) REFERENCES public.clientes(cliecodigon);


--
-- Name: publicaciones publicaciones_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: fullengi
--

ALTER TABLE ONLY public.publicaciones
    ADD CONSTRAINT publicaciones_fkey1 FOREIGN KEY (aplicodigon) REFERENCES public.aplicaciones(aplicodigon);


--
-- Name: publicaciones publicaciones_fkey2; Type: FK CONSTRAINT; Schema: public; Owner: fullengi
--

ALTER TABLE ONLY public.publicaciones
    ADD CONSTRAINT publicaciones_fkey2 FOREIGN KEY (meaucodigon) REFERENCES public.metodosauths(meaucodigon);


--
-- Name: TABLE aplicaciones; Type: ACL; Schema: public; Owner: fullengi
--

GRANT ALL ON TABLE public.aplicaciones TO fullengi_admin WITH GRANT OPTION;


--
-- Name: SEQUENCE clientes_sec; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

REVOKE ALL ON SEQUENCE public.clientes_sec FROM fullengi_portaliddb;
GRANT ALL ON SEQUENCE public.clientes_sec TO fullengi_portaliddb WITH GRANT OPTION;
GRANT ALL ON SEQUENCE public.clientes_sec TO fullengi_admin WITH GRANT OPTION;


--
-- Name: TABLE clientes; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.clientes TO fullengi_admin;


--
-- Name: SEQUENCE directorioactivos_sec; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

REVOKE ALL ON SEQUENCE public.directorioactivos_sec FROM fullengi_portaliddb;
GRANT ALL ON SEQUENCE public.directorioactivos_sec TO fullengi_portaliddb WITH GRANT OPTION;
GRANT ALL ON SEQUENCE public.directorioactivos_sec TO fullengi_admin WITH GRANT OPTION;


--
-- Name: TABLE directorioactivos; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.directorioactivos TO fullengi_admin;


--
-- Name: TABLE estadosclientes; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.estadosclientes TO fullengi_admin;


--
-- Name: TABLE metodosauths; Type: ACL; Schema: public; Owner: fullengi
--

GRANT ALL ON TABLE public.metodosauths TO fullengi_admin;


--
-- Name: TABLE onegatelogs; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.onegatelogs TO fullengi_sunticusr;


--
-- Name: SEQUENCE onegatelogs_ongacodigon_seq; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT SELECT,USAGE ON SEQUENCE public.onegatelogs_ongacodigon_seq TO fullengi_sunticusr;


--
-- Name: TABLE paises; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.paises TO fullengi_admin;


--
-- Name: SEQUENCE publicaciones_publcodigon_seq; Type: ACL; Schema: public; Owner: fullengi
--

GRANT ALL ON SEQUENCE public.publicaciones_publcodigon_seq TO fullengi_admin WITH GRANT OPTION;


--
-- Name: TABLE publicaciones; Type: ACL; Schema: public; Owner: fullengi
--

GRANT ALL ON TABLE public.publicaciones TO fullengi_admin;


--
-- Name: TABLE tiposclientes; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.tiposclientes TO fullengi_admin;


--
-- Name: TABLE tiposidentifis; Type: ACL; Schema: public; Owner: fullengi_portaliddb
--

GRANT ALL ON TABLE public.tiposidentifis TO fullengi_admin;


--
-- PostgreSQL database dump complete
--

