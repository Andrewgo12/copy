-- PostgreSQL database dump
-- Dumped from database version 9.2.24
-- Dumped by pg_dump version 11.1
-- Started on 2021-08-16 11:59:59
SET client_encoding = 'UTF8';
--SELECT pg_catalog.set_config('search_path', '', false);
--DROP DATABASE "dbCROSS7";
--CREATE DATABASE "dbCROSS7" WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'es_CO.UTF-8' LC_CTYPE = 'es_CO.UTF-8';

CREATE TABLE acemcompromi (
    compcodigos varchar(30) NOT NULL,
    acemcodigos integer NOT NULL,
    accofecrevn integer,
    accoobservas text,
    accoactivas varchar(2)
);
ALTER TABLE acemcompromi OWNER TO crosssunticusr;

CREATE TABLE acta (
    actacodigos varchar(30) NOT NULL,
    ordenumeros varchar(30),
    tarecodigos varchar(30),
    actaestacts varchar(30),
    actaestants varchar(30),
    actafechingn integer,
    usuacodigos varchar(30),
    orgacodigos varchar(30),
    actaactivas varchar(30),
    actafechfinn integer,
    actafechinin integer,
    actafechvenn integer
);
ALTER TABLE acta OWNER TO crosssunticusr;

CREATE TABLE actaempresa (
    actacodigos varchar(30) NOT NULL,
    acemnumeros varchar(30) NOT NULL,
    esaccodigos varchar(30),
    acemfeccren integer,
    acemfecaten integer,
    acemhorainn integer,
    acemhorafin integer,
    orgacodigos varchar(30),
    acemusuars varchar(100),
    acemobservas text,
    acemusumods varchar(100),
    acemradicas varchar(30),
    acemactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE actaempresa OWNER TO crosssunticusr;

CREATE TABLE actaestorden (
    acescodigos varchar(30) NOT NULL,
    actacodigos varchar(30),
    acesestrecis varchar(30),
    acesestentrs varchar(30),
    acesfechmovs integer
);
ALTER TABLE actaestorden OWNER TO crosssunticusr;

CREATE TABLE actatmp (
    actmcodigos varchar(30) NOT NULL,
    actmnombres varchar(100),
    actmfechregn integer,
    usuacodigos varchar(30),
    actmactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE actatmp OWNER TO crosssunticusr;

CREATE TABLE activiacta (
    acaccodigon integer NOT NULL,
    actacodigos varchar(30) NOT NULL,
    acemcodigos integer NOT NULL,
    acticodigos varchar(30) NOT NULL,
    acacactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE activiacta OWNER TO crosssunticusr;

CREATE TABLE actividad (
    acticodigos varchar(30) NOT NULL,
    actinombres varchar(100),
    activalorn double precision,
    actiobservas text,
    actiactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE actividad OWNER TO crosssunticusr;

CREATE TABLE activitarea (
    tarecodigos varchar(30) NOT NULL,
    acticodigos varchar(30) NOT NULL,
    actavalorn double precision,
    actaobligats varchar(30),
    actaordenn integer,
    actaporcetan double precision,
    actaactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE activitarea OWNER TO crosssunticusr;

CREATE TABLE agendapriori (
    agprcodigos varchar(30) NOT NULL,
    agprnombres varchar(200),
    agprdescrips text,
    agpractivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE agendapriori OWNER TO crosssunticusr;

CREATE TABLE anexos (
    ordenumeros varchar(30) NOT NULL,
    anexcodigon integer NOT NULL,
    anexnombarch varchar(100) NOT NULL,
    anexfechingn integer,
    usuacodigos varchar(30)
);
ALTER TABLE anexos OWNER TO crosssunticusr;

CREATE TABLE archivoaux (
    araucodigon integer NOT NULL,
    araulinean integer NOT NULL,
    archcodigon integer,
    araufecregn integer,
    usuacodigos varchar(30),
    araucruds varchar(10),
    arauestados varchar(1) DEFAULT 'P'::varchar
);
ALTER TABLE archivoaux OWNER TO crosssunticusr;

CREATE TABLE archivos (
    archcodigon integer NOT NULL,
    archidrefes varchar(30) NOT NULL,
    archreferes varchar(30) NOT NULL,
    archnombres varchar(100) NOT NULL,
    archmimetys varchar(100),
    archtamanon integer NOT NULL,
    archcontens text,
    archfechan integer NOT NULL,
    archextensis varchar(3)
);
ALTER TABLE archivos OWNER TO crosssunticusr;

CREATE TABLE bodega (
    bodecodigos varchar(30) NOT NULL,
    tibocodigos varchar(30) NOT NULL,
    bodenombres varchar(100) NOT NULL,
    orgacodigos varchar(30) NOT NULL,
    bodefechcred varchar(30) NOT NULL,
    bodefechfind varchar(30),
    bodedescrips text,
    bodeestados varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE bodega OWNER TO crosssunticusr;

CREATE TABLE campconffoem (
    cacfcodigon integer NOT NULL,
    cacfnombres varchar(150) NOT NULL,
    cacfprocedes varchar(150) NOT NULL
);
ALTER TABLE campconffoem OWNER TO crosssunticusr;

CREATE TABLE campconfform (
    cacocodigon integer NOT NULL,
    caconombres varchar(150) NOT NULL,
    cacoprocedes varchar(150) NOT NULL
);
ALTER TABLE campconfform OWNER TO crosssunticusr;

CREATE TABLE campconfproc (
    cacocodigon integer NOT NULL,
    caconombres varchar(150) NOT NULL,
    cacoprocedes varchar(150) NOT NULL
);
ALTER TABLE campconfproc OWNER TO crosssunticusr;

CREATE TABLE cargo (
    cargcodigos varchar(30) NOT NULL,
    cargnombres varchar(100),
    cargdescrips varchar(150),
    cargactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE cargo OWNER TO crosssunticusr;

CREATE TABLE categoria (
    catecodigon integer NOT NULL,
    catenombres varchar(100) NOT NULL,
    catedescris text,
    cateactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE categoria OWNER TO crosssunticusr;

CREATE TABLE causa (
    tiorcodigos varchar(30) NOT NULL,
    evencodigos varchar(30) NOT NULL,
    causcodigos varchar(30) NOT NULL,
    causnombres varchar(150),
    causdescrips text,
    causactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE causa OWNER TO crosssunticusr;

CREATE TABLE cliente (
    cliecodigos varchar(30) NOT NULL,
    clieidentifs varchar(30),
    ticlcodigos varchar(30),
    clienombres varchar(150),
    clierepprnos varchar(20),
    clierepsenos varchar(30),
    cliereppraps varchar(30),
    clierepseaps varchar(30),
    clielocalizs varchar(100),
    clietelefons varchar(13),
    locacodigos varchar(30),
    cliepagwebs varchar(100),
    cliemails varchar(100),
    esclcodigos varchar(30),
    tiidcodigos varchar(2),
    grclcodigos varchar(30),
    clienumfaxs varchar(13),
    clieaparaers varchar(200),
    clieactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE cliente OWNER TO crosssunticusr;

CREATE TABLE compromiso (
    compcodigos varchar(30) NOT NULL,
    compdescris varchar(255) NOT NULL,
    compactivos varchar(2) DEFAULT 'A'::varchar
);
ALTER TABLE compromiso OWNER TO crosssunticusr;

CREATE TABLE comunicacion (
    comucodigos varchar(30) NOT NULL,
    ordenumeros varchar(30) NOT NULL,
    focacodigos varchar(30) NOT NULL,
    comuasuntos varchar(200) NOT NULL,
    comutextos text NOT NULL,
    comuestados varchar(30),
    comuusuagen varchar(30) NOT NULL,
    usuacodigos varchar(30),
    comufecregn integer NOT NULL,
    comufecenvn integer
);
ALTER TABLE comunicacion OWNER TO crosssunticusr;

CREATE TABLE concepmovimi (
    comocodigos varchar(30) NOT NULL,
    comonombres varchar(100) NOT NULL,
    comosentidos varchar(1) NOT NULL,
    comodescrips text,
    comoactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE concepmovimi OWNER TO crosssunticusr;

CREATE TABLE configarchiv (
    cogacodigos varchar(30) NOT NULL,
    coganombres varchar(200) NOT NULL,
    cogaobservas text,
    tiarcodigos varchar(30),
    cogamarmaess varchar(30),
    cogamardetas varchar(30),
    cogaposmaess integer,
    cogaposdetas integer,
    cogasepainis varchar(100),
    cogasepafins varchar(100),
    coarencabezs varchar(1) DEFAULT 'S'::varchar,
    coarextencis varchar(100)
);
ALTER TABLE configarchiv OWNER TO crosssunticusr;

CREATE TABLE configdimension (
    codicodigon integer NOT NULL,
    codidominios varchar(100) NOT NULL,
    codidomicams varchar(100),
    codidomivals varchar(100),
    codireglas text,
    codiexclusis varchar(1),
    dimecodigon integer NOT NULL
);
ALTER TABLE configdimension OWNER TO crosssunticusr;

CREATE TABLE configforema (
    cofecodigon integer NOT NULL,
    cofenombres varchar(150) NOT NULL,
    foemcodigos varchar(30) NOT NULL
);
ALTER TABLE configforema OWNER TO crosssunticusr;

CREATE TABLE configformat (
    cofocodigon integer NOT NULL,
    cofonombres varchar(150) NOT NULL,
    focacodigos varchar(30) NOT NULL
);
ALTER TABLE configformat OWNER TO crosssunticusr;

CREATE TABLE configproces (
    coprcodigon integer NOT NULL,
    coprnombres varchar(150) NOT NULL,
    proccodigos varchar(30) NOT NULL
);
ALTER TABLE configproces OWNER TO crosssunticusr;

CREATE TABLE contacto (
    contcodigon integer NOT NULL,
    contindentis varchar(100),
    tiidcodigos varchar(2),
    cliecodigon varchar(100),
    contprinoms varchar(20),
    contsegnoms varchar(30),
    contpriapes varchar(30),
    contsegapes varchar(30),
    contfecnacis integer,
    contedadn integer,
    contsexos varchar(1),
    contemail varchar(100),
    locacodigos varchar(30),
    contdirecios varchar(100),
    conttelefons varchar(13),
    contnumcels varchar(13),
    contobservs text,
    contactivas varchar(1) DEFAULT 'A'::varchar,
    grincodigos varchar(30)
);
ALTER TABLE contacto OWNER TO crosssunticusr;

CREATE TABLE contrato (
    contnics varchar(30) NOT NULL,
    clieidentifs varchar(30) NOT NULL,
    ticocodigos varchar(30) NOT NULL,
    contobjetos varchar(350) NOT NULL,
    timocodigos varchar(30) NOT NULL,
    contmonton double precision,
    fopacodigos varchar(30) NOT NULL,
    contfchainin integer NOT NULL,
    contfchafinn integer,
    contfchfirmn integer,
    contestados varchar(1) DEFAULT 'A'::varchar,
    contdescrips text
);
ALTER TABLE contrato OWNER TO crosssunticusr;

CREATE TABLE detaconfarch (
    decocodigon integer NOT NULL,
    cogacodigos varchar(30),
    decodescris varchar(200) NOT NULL,
    decolon_posn integer,
    decotipos varchar(30),
    decoformats varchar(30),
    decovalinis varchar(100),
    decovalfins varchar(100)
);
ALTER TABLE detaconfarch OWNER TO crosssunticusr;

CREATE TABLE detaconffoem (
    cofecodigon integer NOT NULL,
    cacfcodigon integer NOT NULL,
    decfoperados varchar(30) NOT NULL,
    decfvalors varchar(30)
);
ALTER TABLE detaconffoem OWNER TO crosssunticusr;

CREATE TABLE detaconfform (
    cofocodigon integer NOT NULL,
    cacocodigon integer NOT NULL,
    decooperados varchar(30) NOT NULL,
    decovalors varchar(30) NOT NULL
);
ALTER TABLE detaconfform OWNER TO crosssunticusr;

CREATE TABLE detaconfproc (
    coprcodigon integer NOT NULL,
    cacocodigon integer NOT NULL,
    decooperados varchar(30) NOT NULL,
    decovalors text NOT NULL
);
ALTER TABLE detaconfproc OWNER TO crosssunticusr;

CREATE TABLE detacttarest (
    valicodigos varchar(30) NOT NULL,
    acticodigos varchar(30) NOT NULL
);
ALTER TABLE detacttarest OWNER TO crosssunticusr;

CREATE TABLE detalledimens (
    dimecodigon integer NOT NULL,
    dedinombres varchar(30) NOT NULL,
    deditipodats varchar(100) NOT NULL,
    deditamtips integer NOT NULL,
    dediformatos varchar(30),
    dediorigens text,
    deditipobjes varchar(100) NOT NULL,
    dedivalidas text,
    dedinotnulls varchar(1) NOT NULL,
    dededidefaults varchar(100),
    dediordenn integer NOT NULL,
    dedijseventos varchar(255)
);
ALTER TABLE detalledimens OWNER TO crosssunticusr;

CREATE TABLE detallvalida (
    valicodigos varchar(30) NOT NULL,
    devacodigos varchar(30) NOT NULL,
    devanomcams varchar(50),
    devaoperados varchar(30),
    devavalors varchar(150)
);
ALTER TABLE detallvalida OWNER TO crosssunticusr;

CREATE TABLE detarespusua (
    reuscodigon integer NOT NULL,
    derucodigon integer NOT NULL,
    pregcodigon integer NOT NULL,
    oprecodigon integer,
    deruvalorabis text
);
ALTER TABLE detarespusua OWNER TO crosssunticusr;

CREATE TABLE detaretape (
    retpcodigos varchar(30) NOT NULL,
    drtpcodigos varchar(30) NOT NULL,
    orgacodigos varchar(30) NOT NULL
);
ALTER TABLE detaretape OWNER TO crosssunticusr;

CREATE TABLE dimension (
    dimecodigon integer NOT NULL,
    dimedescrips text,
    dimefechcren integer,
    dimeusuarios varchar(30),
    dimefechupdn integer
);
ALTER TABLE dimension OWNER TO crosssunticusr;

CREATE TABLE ejetematico (
    ejtecodigon integer NOT NULL,
    ejtenombres varchar(100) NOT NULL,
    ejtedescrips text
);
ALTER TABLE ejetematico OWNER TO crosssunticusr;

CREATE TABLE email (
    emaicodigos varchar(30) NOT NULL,
    ordenumeros varchar(30) NOT NULL,
    foemcodigos varchar(30),
    orgacodigos varchar(30),
    emaiparas varchar(100) NOT NULL,
    emaidesdes varchar(100) NOT NULL,
    emaiasuntos varchar(200) NOT NULL,
    emaitextos text NOT NULL,
    emaiestados varchar(10) NOT NULL,
    usuacodigos varchar(30) NOT NULL,
    emaifecregn integer NOT NULL,
    emaifecenvn integer,
    emaiadjuntos varchar(500)
);
ALTER TABLE email OWNER TO crosssunticusr;

CREATE TABLE entrada (
    entrcodigon integer NOT NULL,
    entrusucreas varchar(100) NOT NULL,
    entrfechorun bigint NOT NULL,
    agprcodigos varchar(30),
    catecodigon integer NOT NULL,
    entrdescris text NOT NULL,
    entrduracion bigint NOT NULL,
    entractivas varchar(2) DEFAULT 'A'::varchar
);
ALTER TABLE entrada OWNER TO crosssunticusr;

CREATE TABLE equivalenciacaso (
    eqcacodigon integer NOT NULL,
    equicodigon integer NOT NULL,
    ordenumeros varchar(30) NOT NULL,
    equifecharen integer NOT NULL
);
ALTER TABLE equivalenciacaso OWNER TO crosssunticusr;

CREATE TABLE equivalencias (
    equicodigon integer NOT NULL,
    equitablcros varchar(30) NOT NULL,
    equicampcros varchar(15) NOT NULL,
    equivalcros varchar(15) NOT NULL,
    equinomcros varchar(250) NOT NULL,
    equiareacros varchar(30) NOT NULL,
    equitabldocs varchar(30) NOT NULL,
    equicampdocs varchar(15) NOT NULL,
    equivaldocs integer NOT NULL,
    equinomdocs varchar(250) NOT NULL,
    equiareadocs varchar(30) NOT NULL,
    equiseridocs varchar(30) NOT NULL,
    equifechacrn integer NOT NULL,
    equiestados varchar(1) NOT NULL
);
ALTER TABLE equivalencias OWNER TO crosssunticusr;

CREATE TABLE estadoacta (
    esaccodigos varchar(30) NOT NULL,
    esacnombres varchar(100),
    esacdescrips text,
    esacactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE estadoacta OWNER TO crosssunticusr;

CREATE TABLE estadoclient (
    esclcodigos varchar(30) NOT NULL,
    esclnombres varchar(150),
    escldescrips text,
    esclactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE estadoclient OWNER TO crosssunticusr;

CREATE TABLE estadoentrada (
    esencodigos varchar(1) NOT NULL,
    esennombres varchar(100) NOT NULL,
    esenactivas varchar(1) DEFAULT 'A'::varchar NOT NULL
);
ALTER TABLE estadoentrada OWNER TO crosssunticusr;

CREATE TABLE estadogrupo (
    esgrcodigos varchar(30) NOT NULL,
    esgrnombres varchar(100),
    esgrdescrips text,
    esgractivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE estadogrupo OWNER TO crosssunticusr;

CREATE TABLE estadoorgani (
    esorcodigos varchar(30) NOT NULL,
    esornombres varchar(100),
    esordescrips text,
    esoractivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE estadoorgani OWNER TO crosssunticusr;

CREATE TABLE estadoproces (
    esprcodigos varchar(30) NOT NULL,
    esprnombres varchar(100),
    esprdescrips text,
    espractivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE estadoproces OWNER TO crosssunticusr;

CREATE TABLE estadotarea (
    tarecodigos varchar(30) NOT NULL,
    esaccodigos varchar(30) NOT NULL
);
ALTER TABLE estadotarea OWNER TO crosssunticusr;

CREATE TABLE estilo (
    esticodigos varchar(30) NOT NULL,
    estinombres varchar(200) NOT NULL,
    estidescrips varchar(300),
    estiarchivos text NOT NULL
);
ALTER TABLE estilo OWNER TO crosssunticusr;

CREATE TABLE etapestaord (
    etescodigos varchar(30) NOT NULL,
    ordenumeros varchar(30),
    etesestrecis varchar(30),
    etesestentrs varchar(30),
    etesfechmovs varchar(30)
);
ALTER TABLE etapestaord OWNER TO crosssunticusr;

CREATE TABLE evento (
    tiorcodigos varchar(30) NOT NULL,
    evencodigos varchar(30) NOT NULL,
    evennombres varchar(150),
    evendescrips text,
    evenactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE evento OWNER TO crosssunticusr;

CREATE TABLE extensarchiv (
    exarcodigos varchar(3) NOT NULL,
    exarnombres varchar(50),
    exarobservs text,
    exaractivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE extensarchiv OWNER TO crosssunticusr;

CREATE TABLE formapago (
    fopacodigos varchar(30) NOT NULL,
    fopanombres varchar(150) NOT NULL,
    fopatiempon varchar(30),
    fopacancuotn integer,
    fopadescrips text,
    fopaactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE formapago OWNER TO crosssunticusr;

CREATE TABLE formatocarta (
    focacodigos varchar(30) NOT NULL,
    focanombres varchar(100) NOT NULL,
    focaplantils text NOT NULL,
    focaestados varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE formatocarta OWNER TO crosssunticusr;

CREATE TABLE formatoemail (
    foemcodigos varchar(30) NOT NULL,
    foemnombres varchar(100) NOT NULL,
    foemasuntos varchar(200) NOT NULL,
    foemplantils text NOT NULL,
    foemestados varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE formatoemail OWNER TO crosssunticusr;

CREATE TABLE formulario (
    formcodigon integer NOT NULL,
    formnombres varchar(225) NOT NULL,
    formfeccrean integer NOT NULL,
    formintrodus text,
    formpredets varchar(1) DEFAULT 'N'::varchar,
    formactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE formulario OWNER TO crosssunticusr;

CREATE TABLE funciones (
    reglcodigos varchar(30) NOT NULL,
    funccodigos varchar(30) NOT NULL,
    funcnombres varchar(100),
    funcdescrips text
);
ALTER TABLE funciones OWNER TO crosssunticusr;

CREATE TABLE grupo (
    grupcodigon integer NOT NULL,
    grupcodigos varchar(30) NOT NULL,
    grupnombres varchar(100),
    esgrcodigos varchar(30),
    grupfchainin integer NOT NULL,
    grupfchafinn integer,
    grupactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE grupo OWNER TO crosssunticusr;

CREATE TABLE grupodetalle (
    grupcodigon integer NOT NULL,
    perscodigos varchar(30) NOT NULL,
    persrespons varchar(1) DEFAULT 'N'::varchar
);
ALTER TABLE grupodetalle OWNER TO crosssunticusr;

CREATE TABLE gruporecurso (
    grrecodigos varchar(30) NOT NULL,
    grrenombres varchar(100) NOT NULL,
    grredescrips text,
    grreactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE gruporecurso OWNER TO crosssunticusr;

CREATE TABLE gruposinteres (
    grincodigos varchar(30) NOT NULL,
    grinnombres varchar(150),
    grindescrips text,
    grinactivos char(1) DEFAULT 'A'::bpchar NOT NULL
);
ALTER TABLE gruposinteres OWNER TO crosssunticusr;

CREATE TABLE hactividad (
    hactcodigon integer NOT NULL,
    acticodigos varchar(30) NOT NULL,
    activalorn double precision,
    hactfechregn integer
);
ALTER TABLE hactividad OWNER TO crosssunticusr;

CREATE TABLE hactivitarea (
    hactcodigon integer NOT NULL,
    acticodigos varchar(30) NOT NULL,
    actavalorn double precision,
    actaobligats varchar(30),
    actaordenn integer,
    actaporcetan double precision,
    hactfechreg integer
);
ALTER TABLE hactivitarea OWNER TO crosssunticusr;

CREATE TABLE infractor (
    tiidcodigos varchar(2),
    infrcodigos varchar(30) NOT NULL,
    ticlcodigos varchar(30),
    infrnombres varchar(150),
    infrrepreses varchar(100),
    infrlocalizs varchar(100),
    infrtelefons varchar(100),
    locacodigos varchar(30),
    infrnumfaxs varchar(100),
    infractivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE infractor OWNER TO crosssunticusr;

CREATE TABLE integralog (
    inlocodigon integer NOT NULL,
    inlofchaejin integer NOT NULL,
    inloidcrosss varchar(30) NOT NULL,
    inlofchaejfn integer,
    inlousuarios varchar(30),
    inloapps varchar(100) NOT NULL,
    inloerrors text,
    inloestados varchar(1) DEFAULT 'F'::varchar
);
ALTER TABLE integralog OWNER TO crosssunticusr;

CREATE TABLE intelogdoc (
    inlocodigon integer NOT NULL,
    nmbre_srie varchar(100),
    nmbre_tpo_crpta varchar(100),
    nmbre_crpta varchar(200),
    nmbre_tpo_dcto varchar(100),
    nmbre_dcto varchar(200),
    ext varchar(30),
    fncnrio varchar(200),
    c_indice1 varchar(100),
    c_indice2 varchar(100),
    c_indice3 varchar(100),
    c_indice4 varchar(100),
    c_descripcion text,
    d_indice1 varchar(100),
    d_indice2 varchar(100),
    d_indice3 varchar(100),
    d_indice4 varchar(100),
    d_indice5 varchar(100),
    d_indice6 varchar(100),
    d_indice7 varchar(100),
    d_indice8 varchar(100),
    d_indice9 varchar(100),
    d_descripcion text,
    d_id_cross varchar(100) NOT NULL,
    exto varchar(100),
    texto_error text
);
ALTER TABLE intelogdoc OWNER TO crosssunticusr;

CREATE TABLE lenguaje (
    lengcodigos varchar(30) NOT NULL,
    lengnombres varchar(200) NOT NULL,
    lengdescrips text
);
ALTER TABLE lenguaje OWNER TO crosssunticusr;

CREATE TABLE limcumtarea (
    tarecodigos varchar(30) NOT NULL,
    licucodigos varchar(30) NOT NULL,
    litacantiemn integer,
    unticodigos varchar(30)
);
ALTER TABLE limcumtarea OWNER TO crosssunticusr;

CREATE TABLE limitecumpli (
    licucodigos varchar(30) NOT NULL,
    licunombres varchar(100),
    licudescris text,
    licufeccrean integer,
    licuactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE limitecumpli OWNER TO crosssunticusr;

CREATE TABLE llave (
    llavcodigos varchar(30) NOT NULL,
    llavusuauts varchar(30) NOT NULL,
    llavususols varchar(30) NOT NULL,
    usuacodigos varchar(30),
    llavusuutis varchar(30),
    llavfecingd integer,
    llavfecinid integer,
    llavfecvend integer,
    llavfecusod integer,
    llavobservs text,
    llavvalors varchar(100),
    ordenumeros varchar(30),
    llavactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE llave OWNER TO crosssunticusr;

CREATE TABLE localizacion (
    locacodigos varchar(30) NOT NULL,
    locanombres varchar(200),
    locadescrips text,
    tilocodigos varchar(30),
    locacodpadrs varchar(30),
    locaordenn integer,
    locazonas varchar(30),
    locaestados varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE localizacion OWNER TO crosssunticusr;

CREATE TABLE logrotacion (
    loroorolcods varchar(30) NOT NULL,
    loroornecods varchar(30) NOT NULL,
    loroornenoms varchar(100) NOT NULL,
    loroorcopaos varchar(30) NOT NULL,
    loroorcopans varchar(30) NOT NULL,
    loroordpads text,
    loroordnews text,
    lorofechregn integer,
    usuacodigos varchar(100) NOT NULL
);
ALTER TABLE logrotacion OWNER TO crosssunticusr;

CREATE TABLE mediorecepcion (
    merecodigos varchar(30) NOT NULL,
    merenombres varchar(150) NOT NULL,
    mereescrips text,
    mereactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE mediorecepcion OWNER TO crosssunticusr;

CREATE TABLE modeloresp (
    morecodigon integer NOT NULL,
    morenombres varchar(100) NOT NULL,
    moredescrips text
);
ALTER TABLE modeloresp OWNER TO crosssunticusr;

CREATE TABLE movimialmace (
    moalcodigos varchar(30) NOT NULL,
    bodecodigos varchar(30) NOT NULL,
    recucodigos varchar(30) NOT NULL,
    moalfechmovd integer NOT NULL,
    comocodigos varchar(30) NOT NULL,
    moalcantrecf double precision NOT NULL,
    perscodigos varchar(30) NOT NULL,
    tidocodigos varchar(30) NOT NULL,
    moalnumedocs varchar(30) NOT NULL,
    moalsignos varchar(1) NOT NULL
);
ALTER TABLE movimialmace OWNER TO crosssunticusr;

CREATE TABLE numerador (
    numecodigos varchar(30) NOT NULL,
    numedescrips text,
    numeproximon integer
);
ALTER TABLE numerador OWNER TO crosssunticusr;

CREATE TABLE objeto (
    objecodigon integer NOT NULL,
    objenombres varchar(100) NOT NULL,
    objedescrips text,
    objeactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE objeto OWNER TO crosssunticusr;

CREATE TABLE opcionrepues (
    oprecodigon integer NOT NULL,
    opredescrisp text NOT NULL,
    morecodigon integer,
    opreactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE opcionrepues OWNER TO crosssunticusr;

CREATE TABLE orden (
    ordenumeros varchar(30) NOT NULL,
    proccodigos varchar(30),
    ordesitiejes varchar(100),
    usuacodigos varchar(30),
    ordeestaacs varchar(30),
    ordeobservs text,
    ordefecingd integer,
    ordefecregd integer,
    ordefecvend integer,
    ordefecfinad integer,
    ordefecentn integer
);
ALTER TABLE orden OWNER TO crosssunticusr;

CREATE TABLE orden_log (
    orlonumeron integer NOT NULL,
    orlousuarios varchar(30),
    orlofecingd integer,
    ordenumeros varchar(30) NOT NULL,
    proccodigos varchar(30),
    ordesitiejes varchar(100),
    usuacodigos varchar(30),
    ordeestaacs varchar(30),
    ordeobservs text,
    ordefecingd integer,
    ordefecregd integer,
    ordefecvend integer,
    ordefecfinad integer,
    ordefecentn integer
);
ALTER TABLE orden_log OWNER TO crosssunticusr;

CREATE TABLE ordenempresa (
    ordenumeros varchar(30) NOT NULL,
    contidentis varchar(30),
    priocodigos varchar(30),
    tiorcodigos varchar(30),
    evencodigos varchar(30),
    causcodigos varchar(30),
    orgacodigos varchar(30),
    merecodigos varchar(30),
    locacodigos varchar(30),
    oremradicas varchar(30),
    infrcodigos varchar(30),
    oremsolucios text,
    paciindentis varchar(100)
);
ALTER TABLE ordenempresa OWNER TO crosssunticusr;

CREATE TABLE ordenempresa_log (
    orlonumeron integer NOT NULL,
    ordenumeros varchar(30) NOT NULL,
    contidentis varchar(30),
    priocodigos varchar(30),
    tiorcodigos varchar(30),
    evencodigos varchar(30),
    causcodigos varchar(30),
    orgacodigos varchar(30),
    merecodigos varchar(30),
    locacodigos varchar(30),
    oremradicas varchar(30),
    infrcodigos varchar(30),
    oremsolucios text,
    paciindentis varchar(100)
);
ALTER TABLE ordenempresa_log OWNER TO crosssunticusr;

CREATE TABLE organentrada (
    entrcodigon integer NOT NULL,
    orgacodigos varchar(30) NOT NULL,
    perscodigos varchar(30)
);
ALTER TABLE organentrada OWNER TO crosssunticusr;

CREATE TABLE organizacion (
    orgacodigos varchar(30) NOT NULL,
    organombres varchar(100),
    tiorcodigos varchar(30),
    orgacgpads varchar(30),
    orgaordenn integer,
    orgafechcred integer,
    esorcodigos varchar(30),
    grupcodigos varchar(30),
    orgatelefo1s varchar(30),
    orgatelefo2s varchar(30),
    locacodigos varchar(30),
    orgaemails varchar(200),
    orgaactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE organizacion OWNER TO crosssunticusr;

CREATE TABLE organumerador (
    orgacodigos varchar(30) NOT NULL,
    numeproximon integer
);
ALTER TABLE organumerador OWNER TO crosssunticusr;

CREATE TABLE personal (
    perscodigos varchar(30) NOT NULL,
    persidentifs varchar(30),
    persnombres varchar(100),
    persapell1s varchar(100),
    persapell2s varchar(100),
    persusrnams varchar(100),
    cargcodigos varchar(30),
    persprofecs varchar(100),
    perstelefo1 varchar(30),
    perstelefo2 varchar(30),
    locacodigos varchar(30),
    persdireccis varchar(100),
    persemails varchar(150),
    perscontacts varchar(100),
    perstelcont varchar(30),
    persestadoc varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE personal OWNER TO crosssunticusr;

CREATE TABLE preentrada (
    preecodigon integer NOT NULL,
    catecodigon integer NOT NULL,
    contcodigon integer NOT NULL,
    preedescris text,
    preefecregn integer,
    entrcodigon integer
);
ALTER TABLE preentrada OWNER TO crosssunticusr;

CREATE TABLE pregformula (
    prfocodigon integer NOT NULL,
    formcodigon integer NOT NULL,
    pregcodigon integer NOT NULL,
    pregpadren integer,
    objecodigon integer,
    prfoordenn integer
);
ALTER TABLE pregformula OWNER TO crosssunticusr;

CREATE TABLE pregunta (
    pregcodigon integer NOT NULL,
    pregdescris text NOT NULL,
    temacodigon integer NOT NULL,
    morecodigon integer,
    pregtipopres varchar(1),
    pregactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE pregunta OWNER TO crosssunticusr;

CREATE TABLE prioridad (
    priocodigos varchar(30) NOT NULL,
    prionombres varchar(200),
    priodescrips text,
    prioactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE prioridad OWNER TO crosssunticusr;

CREATE TABLE proceso (
    proccodigos varchar(30) NOT NULL,
    procnombres varchar(100),
    procdescris text,
    perscodigos varchar(30),
    procestinis varchar(30),
    procestfins varchar(30),
    procfeccren integer,
    orgacodigos varchar(30) NOT NULL,
    proctiempon integer,
    procactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE proceso OWNER TO crosssunticusr;

CREATE TABLE producto (
    prodcodigos varchar(30) NOT NULL,
    prodnombres varchar(200) NOT NULL,
    marccodigos varchar(30),
    modecodigos varchar(30),
    tiprcodigos varchar(30) NOT NULL,
    prodversions varchar(30),
    proddescrips text,
    prodcoston double precision,
    prodvalorn double precision,
    prodfechinin integer,
    prodfechfinn integer,
    prodfotos varchar(200),
    prodactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE producto OWNER TO crosssunticusr;

CREATE TABLE proveedor (
    provcodigos varchar(30) NOT NULL,
    provnombres varchar(100) NOT NULL,
    provnnomreprs varchar(100),
    provdireccis varchar(100),
    protelefons varchar(30),
    provemails varchar(100),
    provwebs varchar(100),
    paiscodigos varchar(30),
    depacodigos varchar(30),
    ciudcodigos varchar(30),
    provactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE proveedor OWNER TO crosssunticusr;

CREATE TABLE proveerecurs (
    prrecodigos varchar(30) NOT NULL,
    provcodigos varchar(30) NOT NULL,
    recucodigos varchar(30) NOT NULL,
    prrevalorecf double precision
);
ALTER TABLE proveerecurs OWNER TO crosssunticusr;

CREATE TABLE recorrido (
    recocodigos varchar(30) NOT NULL,
    ordenumeros varchar(30) NOT NULL,
    actacodigos varchar(30) NOT NULL,
    recoactpads varchar(30),
    recoobligats varchar(3),
    recoinstancs varchar(1),
    recofecingn integer,
    recoactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE recorrido OWNER TO crosssunticusr;

CREATE TABLE recurso (
    recucodigos varchar(30) NOT NULL,
    recunombres varchar(150) NOT NULL,
    grrecodigos varchar(30) NOT NULL,
    tirecodigos varchar(30) NOT NULL,
    unmecodigos varchar(30) NOT NULL,
    recudescrips text,
    recuactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE recurso OWNER TO crosssunticusr;

CREATE TABLE recuseribode (
    resbnumedocu varchar(30) NOT NULL,
    recucodigos varchar(30) NOT NULL,
    resbserirecu varchar(20) NOT NULL,
    resbbodeactu varchar(50) NOT NULL,
    resbbodeante varchar(30) NOT NULL,
    resbfechmovi integer NOT NULL,
    perscodigos varchar(30) NOT NULL
);
ALTER TABLE recuseribode OWNER TO crosssunticusr;

CREATE TABLE refercross (
    ordenumexps varchar(100),
    ordenumeros varchar(30),
    actacodigos varchar(30),
    entrcodigon integer NOT NULL,
    recrcodigon integer NOT NULL
);
ALTER TABLE refercross OWNER TO crosssunticusr;

CREATE TABLE reglas (
    reglcodigos varchar(30) NOT NULL,
    reglnombres varchar(200) NOT NULL,
    regldescrips text NOT NULL
);
ALTER TABLE reglas OWNER TO crosssunticusr;

CREATE TABLE relatarepers (
    retpcodigos varchar(30) NOT NULL,
    proccodigos varchar(30) NOT NULL,
    tarecodigos varchar(30) NOT NULL,
    retpfeccren integer,
    retpactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE relatarepers OWNER TO crosssunticusr;

CREATE TABLE reportes (
    repocodigon integer NOT NULL,
    reponombres varchar(100) NOT NULL,
    lengcodigos varchar(30) NOT NULL
);
ALTER TABLE reportes OWNER TO crosssunticusr;

CREATE TABLE reportescampos (
    repocodigon integer NOT NULL,
    recacodigon integer NOT NULL,
    lengcodigos varchar(30) NOT NULL,
    recanombres text
);
ALTER TABLE reportescampos OWNER TO crosssunticusr;

CREATE TABLE respuepregun (
    prfocodigon integer NOT NULL,
    reprcodigon integer NOT NULL,
    oprecodigon integer NOT NULL,
    oprepadren integer,
    reprordenn integer,
    reprpeson integer
);
ALTER TABLE respuepregun OWNER TO crosssunticusr;

CREATE TABLE respuestausu (
    reuscodigon integer NOT NULL,
    formcodigon integer NOT NULL,
    reusfecingn integer NOT NULL,
    usuacodigos varchar(30) NOT NULL,
    reusdirips varchar(200),
    ordenumeros varchar(30),
    orgacodigos varchar(30),
    contindentis varchar(30),
    paciindentis varchar(100)
);
ALTER TABLE respuestausu OWNER TO crosssunticusr;

CREATE TABLE ruta (
    rutacodigon integer NOT NULL,
    proccodigos varchar(30) NOT NULL,
    tarecodigos varchar(30) NOT NULL,
    rutaesactas varchar(30) NOT NULL,
    rutatarsigs varchar(30),
    rutainitars varchar(2),
    rutaporcumn double precision,
    rutacantien integer
);
ALTER TABLE ruta OWNER TO crosssunticusr;

CREATE TABLE rutaregla (
    rutacodigon integer NOT NULL,
    reglcodigos varchar(30) NOT NULL
);
ALTER TABLE rutaregla OWNER TO crosssunticusr;

CREATE TABLE saldo (
    bodecodigos varchar(30) NOT NULL,
    recucodigos varchar(30) NOT NULL,
    saldnumdocs varchar(30) NOT NULL,
    saldrecsaldn double precision NOT NULL,
    saldfechregn double precision NOT NULL
);
ALTER TABLE saldo OWNER TO crosssunticusr;

CREATE TABLE saldoserie (
    bodecodigos varchar(30) NOT NULL,
    recucodigos varchar(30) NOT NULL,
    saserecseris varchar(30) NOT NULL,
    sasefechregn double precision NOT NULL
);
ALTER TABLE saldoserie OWNER TO crosssunticusr;

CREATE TABLE sexo (
    sexocodigos varchar(1) NOT NULL,
    sexonombres varchar(9),
    sexoobservs text,
    sexoactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE sexo OWNER TO crosssunticusr;

CREATE TABLE solicitante (
    solicodigos varchar(30) NOT NULL,
    contcodigon integer,
    cliecodigos varchar(30),
    solifecregn integer,
    usuacodigos varchar(30),
    soliactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE solicitante OWNER TO crosssunticusr;

CREATE TABLE tablastipole (
    tatlcodigos varchar(30) NOT NULL,
    tatlnomtabls varchar(30) NOT NULL,
    tatlnomcacos varchar(200) NOT NULL,
    tatlnocadess varchar(30) NOT NULL,
    tatlvalcods varchar(200) NOT NULL,
    tatlvaldescs text,
    langcodigos varchar(100),
    tatlvaldesls text
);
ALTER TABLE tablastipole OWNER TO crosssunticusr;

CREATE TABLE tarea (
    tarecodigos varchar(30) NOT NULL,
    tarenombres varchar(100),
    orgacodigos varchar(30),
    taredescris text,
    tareactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tarea OWNER TO crosssunticusr;

CREATE TABLE tareassincro (
    tasicodigon integer NOT NULL,
    proccodigos varchar(30) NOT NULL,
    tasisigtareas varchar(30) NOT NULL,
    tasiacttareas varchar(30) NOT NULL,
    tasiesactas varchar(30) NOT NULL,
    tasiindice integer,
    tasitipsincs varchar(30)
);
ALTER TABLE tareassincro OWNER TO crosssunticusr;

CREATE TABLE tema (
    temacodigon integer NOT NULL,
    ejtecodigon integer NOT NULL,
    temanombres varchar(100) NOT NULL,
    temadescrips text
);
ALTER TABLE tema OWNER TO crosssunticusr;

CREATE TABLE tipoarchivo (
    tiarcodigos varchar(30) NOT NULL,
    tiarnombres varchar(200) NOT NULL,
    tiarobservas text,
    tiarestados varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipoarchivo OWNER TO crosssunticusr;

CREATE TABLE tipobodega (
    tibocodigos varchar(30) NOT NULL,
    tibonombres varchar(100) NOT NULL,
    tibodescrips text
);
ALTER TABLE tipobodega OWNER TO crosssunticusr;

CREATE TABLE tipocliente (
    ticlcodigos varchar(30) NOT NULL,
    ticlnombres varchar(150),
    ticldescrips text,
    ticlactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipocliente OWNER TO crosssunticusr;

CREATE TABLE tipocontrato (
    ticocodigos varchar(30) NOT NULL,
    ticonombres varchar(150) NOT NULL,
    ticodescrips text,
    ticoactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipocontrato OWNER TO crosssunticusr;

CREATE TABLE tipodocument (
    tidocodigos varchar(30) NOT NULL,
    tidonombres varchar(150) NOT NULL,
    tidodescrips text,
    tidoactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipodocument OWNER TO crosssunticusr;

CREATE TABLE tipoexamen (
    tiexcodigos varchar(30) NOT NULL,
    tiexnombres varchar(150),
    tiexdescrips text,
    tiexactivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipoexamen OWNER TO crosssunticusr;

CREATE TABLE tipoidentifi (
    tiidcodigos varchar(2) NOT NULL,
    tiidnombres varchar(22),
    tiiddescrips text,
    tiidactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipoidentifi OWNER TO crosssunticusr;

CREATE TABLE tipolocaliza (
    tilocodigos varchar(30) NOT NULL,
    tilonombres varchar(200),
    tilodesc text,
    tilocodpadrs varchar(30),
    tiloimagens varchar(200),
    tiloestados varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipolocaliza OWNER TO crosssunticusr;

CREATE TABLE tipomoneda (
    timocodigos varchar(30) NOT NULL,
    timonombres varchar(150) NOT NULL,
    timoequivaln double precision,
    timodescrips text,
    timoactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipomoneda OWNER TO crosssunticusr;

CREATE TABLE tipoorden (
    tiorcodigos varchar(30) NOT NULL,
    tiornombres varchar(150),
    tiordescrips text,
    tioractivos varchar(1) DEFAULT 'A'::varchar,
    tiorpeson bigint DEFAULT 0
);
ALTER TABLE tipoorden OWNER TO crosssunticusr;

CREATE TABLE tipoorgani (
    tiorcodigos varchar(30) NOT NULL,
    tiornombres varchar(200),
    tiordesc text,
    tiorcodpadrs varchar(30),
    tioractivos varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipoorgani OWNER TO crosssunticusr;

CREATE TABLE tipoproducto (
    tiprcodigos varchar(30) NOT NULL,
    tiprnombres varchar(200) NOT NULL,
    tiprdescrips text,
    tipractivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE tipoproducto OWNER TO crosssunticusr;

CREATE TABLE tiporecurso (
    tirecodigos varchar(30) NOT NULL,
    tirenombres varchar(100) NOT NULL,
    tiredescrips text
);
ALTER TABLE tiporecurso OWNER TO crosssunticusr;

CREATE TABLE transfertarea (
    trtacodigos varchar(30) NOT NULL,
    tarecodigos varchar(30) NOT NULL,
    orgacodigos varchar(30) NOT NULL,
    trtafechan integer NOT NULL,
    "trtafecingn" integer NOT NULL,
    trtaobservas text
);
ALTER TABLE transfertarea OWNER TO crosssunticusr;

CREATE TABLE unidadmedida (
    unmecodigos varchar(30) NOT NULL,
    unmenombres varchar(100) NOT NULL,
    unmesiglas varchar(10) NOT NULL,
    unmedescrips text,
    unmeactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE unidadmedida OWNER TO crosssunticusr;

CREATE TABLE unidadtiempo (
    unticodigos varchar(30) NOT NULL,
    untinombres varchar(100),
    untidescris text,
    untiactivas varchar(1) DEFAULT 'A'::varchar
);
ALTER TABLE unidadtiempo OWNER TO crosssunticusr;

CREATE TABLE validacion (
    valicodigos varchar(30) NOT NULL,
    proccodigos varchar(30),
    tarecodigos varchar(30),
    valiestacts varchar(30),
    valiestants varchar(30),
    validescrips text
);
ALTER TABLE validacion OWNER TO crosssunticusr;

CREATE TABLE valordimension (
    dimecodigon integer NOT NULL,
    dedinombres varchar(12) NOT NULL,
    vadicodigon integer NOT NULL,
    vadidominios varchar(100) NOT NULL,
    vadidomivals varchar(100) NOT NULL,
    vadivalors text NOT NULL
);
ALTER TABLE valordimension OWNER TO crosssunticusr;

CREATE VIEW "view_solicitante" AS 
SELECT "solicitante"."solicodigos" ,"solicitante"."contcodigon" ,
 "contacto"."contindentis" || ' -- ' || COALESCE("contacto"."contprinoms", '') || ' ' || COALESCE("contacto"."contsegnoms", '') || ' ' || COALESCE("contacto"."contpriapes", '') || ' ' || COALESCE("contacto"."contsegapes", '') AS "contnombres",
 "solicitante"."cliecodigos" ,"cliente"."clienombres" ,"solicitante"."solifecregn" ,"solicitante"."usuacodigos" ,"solicitante"."soliactivos" 
 FROM "solicitante" LEFT JOIN "cliente" ON ("solicitante"."cliecodigos"="cliente"."cliecodigos"), "contacto" 
 WHERE "solicitante"."contcodigon"="contacto"."contcodigon" ;

ALTER TABLE "view_solicitante" OWNER TO crosssunticusr;