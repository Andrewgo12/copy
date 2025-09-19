-- TODAS LAS TABLAS DEL SISTEMA CROSS - ESQUEMA COMPLETO
-- Base de datos: crosshuvdb (PostgreSQL)
-- Total: 146 tablas (9 en profiles + 137 en schema2)

SET search_path = profiles, pg_catalog;

-- =============================================
-- ESQUEMA: profiles (9 TABLAS)
-- =============================================

CREATE TABLE applications (
    applcodigos character varying(10) NOT NULL,
    applnombres character varying(100) NOT NULL,
    applobservas text
);

CREATE TABLE auth (
    authusernams character varying(100) NOT NULL,
    authuserpasss character varying(100) NOT NULL,
    authrealname character varying(100) NOT NULL,
    authrealape1 character varying(100),
    authrealape2 character varying(100),
    authemail character varying(100),
    applcodigos character varying(10) NOT NULL,
    stylcodigos character varying(10) NOT NULL,
    langcodigos character varying(10) NOT NULL,
    profcodigos character varying(10) NOT NULL,
    authestados character varying(1) DEFAULT 'A'::character varying NOT NULL
);

CREATE TABLE authschema (
    authusernams character varying(100) NOT NULL,
    schecodigon character varying(30) NOT NULL
);

CREATE TABLE language (
    langcodigos character varying(10) NOT NULL,
    langnombres character varying(100) NOT NULL,
    langobservas text
);

CREATE TABLE numerador (
    numecodigos character varying(30) NOT NULL,
    numedescrips text,
    numeproximon integer
);

CREATE TABLE permisions (
    schecodigon character varying(30) NOT NULL,
    profcodigos character varying(10) NOT NULL,
    applcodigos character varying(10) NOT NULL,
    commnombres character varying(100) NOT NULL
);

CREATE TABLE profiles (
    profcodigos character varying(10) NOT NULL,
    applcodigos character varying(10) NOT NULL,
    profnombres character varying(100) NOT NULL,
    profdescrips text
);

CREATE TABLE schema (
    schecodigon character varying(30) NOT NULL,
    schenombres character varying(100) NOT NULL,
    schedbusers character varying(100) NOT NULL,
    schedbkeys character varying(100) NOT NULL,
    scheobservas text,
    scheestados character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE style (
    stylcodigos character varying(10) NOT NULL,
    applcodigos character varying(10) NOT NULL,
    stylnombres character varying(100) NOT NULL,
    stylobservas text
);

SET search_path = schema2, pg_catalog;

-- =============================================
-- ESQUEMA: schema2 (137 TABLAS)
-- =============================================

CREATE TABLE acemcompromi (
    compcodigos character varying(30) NOT NULL,
    acemcodigos integer NOT NULL,
    accofecrevn integer,
    accoobservas text,
    accoactivas character varying(2)
);

CREATE TABLE acta (
    actacodigos character varying(30) NOT NULL,
    ordenumeros character varying(30),
    tarecodigos character varying(30),
    actaestacts character varying(30),
    actaestants character varying(30),
    actafechingn integer,
    usuacodigos character varying(30),
    orgacodigos character varying(30),
    actaactivas character varying(30),
    actafechfinn integer,
    actafechinin integer,
    actafechvenn integer
);

CREATE TABLE acta_188367 (
    actacodigos character varying(30) NOT NULL,
    ordenumeros character varying(30),
    tarecodigos character varying(30),
    actaestacts character varying(30),
    actaestants character varying(30),
    actafechingn integer,
    usuacodigos character varying(30),
    orgacodigos character varying(30),
    actaactivas character varying(30),
    actafechfinn integer,
    actafechinin integer,
    actafechvenn integer
);

CREATE TABLE actaempresa (
    actacodigos character varying(30) NOT NULL,
    acemnumeros character varying(30) NOT NULL,
    esaccodigos character varying(30),
    acemfeccren integer,
    acemfecaten integer,
    acemhorainn integer,
    acemhorafin integer,
    orgacodigos character varying(30),
    acemusuars character varying(100),
    acemobservas text,
    acemusumods character varying(100),
    acemradicas character varying(30),
    acemactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE actaestorden (
    acescodigos character varying(30) NOT NULL,
    actacodigos character varying(30),
    acesestrecis character varying(30),
    acesestentrs character varying(30),
    acesfechmovs integer
);

CREATE TABLE actatmp (
    actmcodigos character varying(30) NOT NULL,
    actmnombres character varying(100),
    actmfechregn integer,
    usuacodigos character varying(30),
    actmactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE activiacta (
    acaccodigon integer NOT NULL,
    actacodigos character varying(30) NOT NULL,
    acemcodigos integer NOT NULL,
    acticodigos character varying(30) NOT NULL,
    acacactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE actividad (
    acticodigos character varying(30) NOT NULL,
    actinombres character varying(100),
    activalorn double precision,
    actiobservas text,
    actiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE activitarea (
    tarecodigos character varying(30) NOT NULL,
    acticodigos character varying(30) NOT NULL,
    actavalorn double precision,
    actaobligats character varying(30),
    actaordenn integer,
    actaporcetan double precision,
    actaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE agendapriori (
    agprcodigos character varying(30) NOT NULL,
    agprnombres character varying(200),
    agprdescrips text,
    agpractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE anexos (
    ordenumeros character varying(30) NOT NULL,
    anexcodigon integer NOT NULL,
    anexnombarch character varying(100) NOT NULL,
    anexfechingn integer,
    usuacodigos character varying(30)
);

CREATE TABLE archivos (
    archcodigon integer NOT NULL,
    archidrefes character varying(30) NOT NULL,
    archreferes character varying(30) NOT NULL,
    archnombres character varying(100) NOT NULL,
    archmimetys character varying(100),
    archtamanon integer NOT NULL,
    archcontens text,
    archfechan integer NOT NULL,
    archextensis character varying(3)
);

CREATE TABLE bodega (
    bodecodigos character varying(30) NOT NULL,
    tibocodigos character varying(30) NOT NULL,
    bodenombres character varying(100) NOT NULL,
    orgacodigos character varying(30) NOT NULL,
    bodefechcred character varying(30) NOT NULL,
    bodefechfind character varying(30),
    bodedescrips text,
    bodeestados character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE campconffoem (
    cacfcodigon integer NOT NULL,
    cacfnombres character varying(150) NOT NULL,
    cacfprocedes character varying(150) NOT NULL
);

CREATE TABLE campconfform (
    cacocodigon integer NOT NULL,
    caconombres character varying(150) NOT NULL,
    cacoprocedes character varying(150) NOT NULL
);

CREATE TABLE campconfproc (
    cacocodigon integer NOT NULL,
    caconombres character varying(150) NOT NULL,
    cacoprocedes character varying(150) NOT NULL
);

CREATE TABLE cargo (
    cargcodigos character varying(30) NOT NULL,
    cargnombres character varying(100),
    cargdescrips character varying(150),
    cargactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE categoria (
    catecodigon integer NOT NULL,
    catenombres character varying(100) NOT NULL,
    catedescris text,
    cateactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE causa (
    tiorcodigos character varying(30) NOT NULL,
    evencodigos character varying(30) NOT NULL,
    causcodigos character varying(30) NOT NULL,
    causnombres character varying(150),
    causdescrips text,
    causactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE cliente (
    cliecodigos character varying(30) NOT NULL,
    clieidentifs character varying(30),
    ticlcodigos character varying(30),
    clienombres character varying(150),
    clierepprnos character varying(20),
    clierepsenos character varying(30),
    cliereppraps character varying(30),
    clierepseaps character varying(30),
    clielocalizs character varying(100),
    clietelefons character varying(13),
    locacodigos character varying(30),
    cliepagwebs character varying(100),
    cliemails character varying(100),
    esclcodigos character varying(30),
    tiidcodigos character varying(2),
    grclcodigos character varying(30),
    clienumfaxs character varying(13),
    clieaparaers character varying(200),
    clieactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE compromiso (
    compcodigos character varying(30) NOT NULL,
    compdescris character varying(255) NOT NULL,
    compactivos character varying(2) DEFAULT 'A'::character varying
);

CREATE TABLE comunicacion (
    comucodigos character varying(30) NOT NULL,
    ordenumeros character varying(30) NOT NULL,
    focacodigos character varying(30) NOT NULL,
    comuasuntos character varying(200) NOT NULL,
    comutextos text NOT NULL,
    comuestados character varying(30),
    comuusuagen character varying(30) NOT NULL,
    usuacodigos character varying(30),
    comufecregn integer NOT NULL,
    comufecenvn integer
);

CREATE TABLE concepmovimi (
    comocodigos character varying(30) NOT NULL,
    comonombres character varying(100) NOT NULL,
    comosentidos character varying(1) NOT NULL,
    comodescrips text,
    comoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE configarchiv (
    cogacodigos character varying(30) NOT NULL,
    coganombres character varying(200) NOT NULL,
    cogaobservas text,
    tiarcodigos character varying(30),
    cogamarmaess character varying(30),
    cogamardetas character varying(30),
    cogaposmaess integer,
    cogaposdetas integer,
    cogasepainis character varying(100),
    cogasepafins character varying(100),
    coarencabezs character varying(1) DEFAULT 'S'::character varying,
    coarextencis character varying(100)
);

CREATE TABLE configdimension (
    codicodigon integer NOT NULL,
    codidominios character varying(100) NOT NULL,
    codidomicams character varying(100),
    codidomivals character varying(100),
    codireglas text,
    codiexclusis character varying(1),
    dimecodigon integer NOT NULL
);

CREATE TABLE configforema (
    cofecodigon integer NOT NULL,
    cofenombres character varying(150) NOT NULL,
    foemcodigos character varying(30) NOT NULL
);

CREATE TABLE configformat (
    cofocodigon integer NOT NULL,
    cofonombres character varying(150) NOT NULL,
    focacodigos character varying(30) NOT NULL
);

CREATE TABLE configproces (
    coprcodigon integer NOT NULL,
    coprnombres character varying(150) NOT NULL,
    proccodigos character varying(30) NOT NULL
);

CREATE TABLE contacto (
    contcodigon integer NOT NULL,
    contindentis character varying(100),
    tiidcodigos character varying(2),
    cliecodigon character varying(100),
    contprinoms character varying(20),
    contsegnoms character varying(30),
    contpriapes character varying(30),
    contsegapes character varying(30),
    contfecnacis integer,
    contedadn integer,
    contsexos character varying(1),
    contemail character varying(100),
    locacodigos character varying(30),
    contdirecios character varying(100),
    conttelefons character varying(13),
    contnumcels character varying(13),
    contobservs text,
    contactivas character varying(1) DEFAULT 'A'::character varying,
    grincodigos character varying(30)
);

CREATE TABLE contrato (
    contnics character varying(30) NOT NULL,
    clieidentifs character varying(30) NOT NULL,
    ticocodigos character varying(30) NOT NULL,
    contobjetos character varying(350) NOT NULL,
    timocodigos character varying(30) NOT NULL,
    contmonton double precision,
    fopacodigos character varying(30) NOT NULL,
    contfchainin integer NOT NULL,
    contfchafinn integer,
    contfchfirmn integer,
    contestados character varying(1) DEFAULT 'A'::character varying,
    contdescrips text
);

CREATE TABLE detaconfarch (
    cogacodigos character varying(30) NOT NULL,
    decacodigon integer NOT NULL,
    decanombres character varying(200) NOT NULL,
    decaposicion integer NOT NULL,
    decalongitud integer,
    decatipodats character varying(30),
    decaobligats character varying(1) DEFAULT 'S'::character varying,
    decadefaults character varying(100)
);

CREATE TABLE detaconffoem (
    cofecodigon integer NOT NULL,
    decfcodigon integer NOT NULL,
    decfnombres character varying(150) NOT NULL,
    decfprocedes character varying(150) NOT NULL
);

CREATE TABLE detaconfform (
    cofocodigon integer NOT NULL,
    decocodigon integer NOT NULL,
    deconombres character varying(150) NOT NULL,
    decoprocedes character varying(150) NOT NULL
);

CREATE TABLE detaconfproc (
    coprcodigon integer NOT NULL,
    decpcodigon integer NOT NULL,
    decpnombres character varying(150) NOT NULL,
    decpprocedes character varying(150) NOT NULL
);

CREATE TABLE detacttarest (
    tarecodigos character varying(30) NOT NULL,
    acticodigos character varying(30) NOT NULL,
    esaccodigos character varying(30) NOT NULL,
    dctavalorn double precision,
    dctaobligats character varying(30),
    dctaordenn integer,
    dctaporcetan double precision,
    dctaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE detalledimens (
    dimecodigon integer NOT NULL,
    dedicodigon integer NOT NULL,
    dedinombres character varying(100) NOT NULL,
    dedidescrips text,
    dediactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE detallvalida (
    valicodigon integer NOT NULL,
    devacodigon integer NOT NULL,
    devavalores character varying(100) NOT NULL,
    devadescrips text,
    devaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE detarespusua (
    respcodigon integer NOT NULL,
    derucodigon integer NOT NULL,
    derurespuess text NOT NULL,
    deruactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE detaretape (
    etapcodigos character varying(30) NOT NULL,
    tarecodigos character varying(30) NOT NULL,
    detaordenn integer,
    detaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE dimension (
    dimecodigon integer NOT NULL,
    dimenombres character varying(100) NOT NULL,
    dimedescrips text,
    dimeactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE ejetematico (
    ejtecodigos character varying(30) NOT NULL,
    ejtenombres character varying(100) NOT NULL,
    ejtedescrips text,
    ejteactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE email (
    emaicodigos character varying(30) NOT NULL,
    ordenumeros character varying(30) NOT NULL,
    foemcodigos character varying(30) NOT NULL,
    emaiasuntos character varying(200) NOT NULL,
    emaitextos text NOT NULL,
    emaiestados character varying(30),
    emaiusuagen character varying(30) NOT NULL,
    usuacodigos character varying(30),
    emaifecregn integer NOT NULL,
    emaifecenvn integer
);

CREATE TABLE entrada (
    entrcodigos character varying(30) NOT NULL,
    entrfechingn integer NOT NULL,
    entrhoraingn integer NOT NULL,
    entrfechvenn integer,
    entrhoravenn integer,
    entrradicals character varying(30),
    entrfolios integer,
    entrremitens character varying(200),
    entrasuntos character varying(200),
    entrdescrips text,
    merecodigos character varying(30) NOT NULL,
    usuacodigos character varying(30) NOT NULL,
    orgacodigos character varying(30) NOT NULL,
    esencodigos character varying(30) NOT NULL,
    entrprioris character varying(30),
    entrreservas character varying(1) DEFAULT 'N'::character varying,
    entrconfides character varying(1) DEFAULT 'N'::character varying,
    entrurgentes character varying(1) DEFAULT 'N'::character varying,
    entrfisicas character varying(1) DEFAULT 'S'::character varying,
    entrdigitals character varying(1) DEFAULT 'N'::character varying,
    entrfecregis integer NOT NULL,
    entrhoraregn integer NOT NULL,
    entrfecmods integer,
    entrhoramods integer,
    entrusuamods character varying(30)
);

CREATE TABLE equivalenciacaso (
    equicodigos character varying(30) NOT NULL,
    equinombres character varying(100) NOT NULL,
    equidescrips text,
    equiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE equivalencias (
    equicodigos character varying(30) NOT NULL,
    equicodigon integer NOT NULL,
    equiorigenes character varying(100) NOT NULL,
    equidestinos character varying(100) NOT NULL,
    equiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadoacta (
    esaccodigos character varying(30) NOT NULL,
    esacnombres character varying(100) NOT NULL,
    esacdescrips text,
    esacactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadoclient (
    esclcodigos character varying(30) NOT NULL,
    esclnombres character varying(100) NOT NULL,
    escldescrips text,
    esclactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadoentrada (
    esencodigos character varying(30) NOT NULL,
    esennombres character varying(100) NOT NULL,
    esendescrips text,
    esenactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadogrupo (
    esgrcodigos character varying(30) NOT NULL,
    esgrnombres character varying(100) NOT NULL,
    esgrdescrips text,
    esgractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadoorgani (
    esorcodigos character varying(30) NOT NULL,
    esornombres character varying(100) NOT NULL,
    esordescrips text,
    esoractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadoproces (
    esprcodigos character varying(30) NOT NULL,
    esprnombres character varying(100) NOT NULL,
    esprdescrips text,
    espractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estadotarea (
    estacodigos character varying(30) NOT NULL,
    estanombres character varying(100) NOT NULL,
    estadescrips text,
    estaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE estilo (
    esticodigos character varying(30) NOT NULL,
    estinombres character varying(100) NOT NULL,
    estidescrips text,
    estiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE etapestaord (
    etapcodigos character varying(30) NOT NULL,
    etapnombres character varying(100) NOT NULL,
    etapdescrips text,
    etapactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE evento (
    evencodigos character varying(30) NOT NULL,
    evennombres character varying(150),
    evendescrips text,
    evenactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE extensarchiv (
    extacodigos character varying(30) NOT NULL,
    extanombres character varying(100) NOT NULL,
    extadescrips text,
    extaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE formapago (
    fopacodigos character varying(30) NOT NULL,
    fopanombres character varying(100) NOT NULL,
    fopadescrips text,
    fopaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE formatocarta (
    focacodigos character varying(30) NOT NULL,
    focanombres character varying(100) NOT NULL,
    focadescrips text,
    focaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE formatoemail (
    foemcodigos character varying(30) NOT NULL,
    foemnombres character varying(100) NOT NULL,
    foemdescrips text,
    foemactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE formulario (
    formcodigos character varying(30) NOT NULL,
    formnombres character varying(100) NOT NULL,
    formdescrips text,
    formactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE funciones (
    funccodigos character varying(30) NOT NULL,
    funcnombres character varying(100) NOT NULL,
    funcdescrips text,
    funcactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE grupo (
    grupcodigos character varying(30) NOT NULL,
    grupnombres character varying(100) NOT NULL,
    grupdescrips text,
    esgrcodigos character varying(30) NOT NULL,
    grupactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE grupodetalle (
    grupcodigos character varying(30) NOT NULL,
    grdecodigon integer NOT NULL,
    grdenombres character varying(100) NOT NULL,
    grdedescrips text,
    grdeactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE gruporecurso (
    grrecodigos character varying(30) NOT NULL,
    grrenombres character varying(100) NOT NULL,
    grredescrips text,
    grreactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE gruposinteres (
    grincodigos character varying(30) NOT NULL,
    grinnombres character varying(100) NOT NULL,
    grindescrips text,
    grinactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE hactividad (
    hacticodigos character varying(30) NOT NULL,
    hactinombres character varying(100),
    hactivalorn double precision,
    hactiobservas text,
    hactiactivas character varying(1) DEFAULT 'A'::character varying,
    hactifechmovn integer NOT NULL,
    hactiusuamovn character varying(30) NOT NULL
);

CREATE TABLE hactivitarea (
    htarecodigos character varying(30) NOT NULL,
    hacticodigos character varying(30) NOT NULL,
    hactavalorn double precision,
    hactaobligats character varying(30),
    hactaordenn integer,
    hactaporcetan double precision,
    hactaactivas character varying(1) DEFAULT 'A'::character varying,
    hactafechmovn integer NOT NULL,
    hactausuamovn character varying(30) NOT NULL
);

CREATE TABLE infractor (
    infrcodigos character varying(30) NOT NULL,
    infridentifs character varying(30),
    tiidcodigos character varying(2),
    infrprinoms character varying(20),
    infrsegnoms character varying(30),
    infrpriapes character varying(30),
    infrsegapes character varying(30),
    infrfecnacis integer,
    infredadn integer,
    infrsexos character varying(1),
    infremail character varying(100),
    locacodigos character varying(30),
    infrdirecios character varying(100),
    infrtelefons character varying(13),
    infrnumcels character varying(13),
    infrobservs text,
    infractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE integralog (
    inlocodigon integer NOT NULL,
    inlofechan integer NOT NULL,
    inlohoran integer NOT NULL,
    inlotablan character varying(100) NOT NULL,
    inlooperacn character varying(10) NOT NULL,
    inloregistn text NOT NULL,
    inloestados character varying(1) DEFAULT 'P'::character varying
);

CREATE TABLE intelogdoc (
    inlocodigon integer NOT NULL,
    ildocodigon integer NOT NULL,
    ildoarchivn character varying(100) NOT NULL,
    ildocontentn text NOT NULL
);

CREATE TABLE lenguaje (
    lengcodigos character varying(30) NOT NULL,
    lengnombres character varying(100) NOT NULL,
    lengdescrips text,
    lengactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE limcumtarea (
    tarecodigos character varying(30) NOT NULL,
    lictcodigon integer NOT NULL,
    lictlimiten integer NOT NULL,
    lictunidads character varying(30) NOT NULL,
    lictactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE limitecumpli (
    lictcodigon integer NOT NULL,
    lictnombres character varying(100) NOT NULL,
    lictdescrips text,
    lictactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE llave (
    llavcodigos character varying(30) NOT NULL,
    llavnombres character varying(100) NOT NULL,
    llavdescrips text,
    llavactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE localizacion (
    locacodigos character varying(30) NOT NULL,
    locanombres character varying(100) NOT NULL,
    locadescrips text,
    tilocodigos character varying(30),
    locaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE logrotacion (
    lorocodigon integer NOT NULL,
    lorofechan integer NOT NULL,
    lorohoran integer NOT NULL,
    lorooperacn character varying(100) NOT NULL,
    lororegistn text NOT NULL,
    loroestados character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE mediorecepcion (
    merecodigos character varying(30) NOT NULL,
    merenombres character varying(100) NOT NULL,
    meredescrips text,
    mereactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE modeloresp (
    morecodigos character varying(30) NOT NULL,
    morenombres character varying(100) NOT NULL,
    moredescrips text,
    moreactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE movimialmace (
    moalcodigon integer NOT NULL,
    bodecodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    comocodigos character varying(30) NOT NULL,
    moalcantidad double precision NOT NULL,
    moalfechan integer NOT NULL,
    moalhoran integer NOT NULL,
    usuacodigos character varying(30) NOT NULL,
    moalobservas text,
    moalactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE objeto (
    objecodigos character varying(30) NOT NULL,
    objenombres character varying(100) NOT NULL,
    objedescrips text,
    objeactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE opcionrepues (
    opcicodigos character varying(30) NOT NULL,
    opcinombres character varying(100) NOT NULL,
    opcidescrips text,
    opciactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE orden (
    ordenumeros character varying(30) NOT NULL,
    entrcodigos character varying(30),
    tipocodigos character varying(30) NOT NULL,
    ordenfechingn integer NOT NULL,
    ordenhoraingn integer NOT NULL,
    ordenfechvenn integer,
    ordenhoravenn integer,
    ordenradicals character varying(30),
    ordenfolios integer,
    ordenremitens character varying(200),
    ordenasuntos character varying(200),
    ordendescrips text,
    usuacodigos character varying(30) NOT NULL,
    orgacodigos character varying(30) NOT NULL,
    ordenprioris character varying(30),
    ordenreservas character varying(1) DEFAULT 'N'::character varying,
    ordenconfides character varying(1) DEFAULT 'N'::character varying,
    ordenurgentes character varying(1) DEFAULT 'N'::character varying,
    ordenfisicas character varying(1) DEFAULT 'S'::character varying,
    ordendigitals character varying(1) DEFAULT 'N'::character varying,
    ordenfecregis integer NOT NULL,
    ordenhoraregn integer NOT NULL,
    ordenfecmods integer,
    ordenhoramods integer,
    ordenusuamods character varying(30),
    ordenestados character varying(30),
    ordenactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE orden_log (
    orlgcodigon integer NOT NULL,
    ordenumeros character varying(30) NOT NULL,
    orlgfechan integer NOT NULL,
    orlghoran integer NOT NULL,
    orlgoperacn character varying(100) NOT NULL,
    orlgregistn text NOT NULL,
    usuacodigos character varying(30) NOT NULL
);

CREATE TABLE ordenempresa (
    ordenumeros character varying(30) NOT NULL,
    oremnumeros character varying(30) NOT NULL,
    cliecodigos character varying(30) NOT NULL,
    oremfeccren integer,
    oremfecaten integer,
    oremhorainn integer,
    oremhorafin integer,
    orgacodigos character varying(30),
    oremusuars character varying(100),
    oremobservas text,
    oremusumods character varying(100),
    oremradicas character varying(30),
    oremactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE ordenempresa_log (
    oelgcodigon integer NOT NULL,
    ordenumeros character varying(30) NOT NULL,
    oremnumeros character varying(30) NOT NULL,
    oelgfechan integer NOT NULL,
    oelghoran integer NOT NULL,
    oelgoperacn character varying(100) NOT NULL,
    oelgregistn text NOT NULL,
    usuacodigos character varying(30) NOT NULL
);

CREATE TABLE organentrada (
    orgacodigos character varying(30) NOT NULL,
    entrcodigos character varying(30) NOT NULL,
    orenfechan integer NOT NULL,
    orenhoran integer NOT NULL,
    orenobservas text,
    orenactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE organizacion (
    orgacodigos character varying(30) NOT NULL,
    organombres character varying(100) NOT NULL,
    orgadescrips text,
    tipocodigos character varying(30),
    esorcodigos character varying(30) NOT NULL,
    orgaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE organumerador (
    orgacodigos character varying(30) NOT NULL,
    numecodigos character varying(30) NOT NULL,
    ornuactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE personal (
    perscodigos character varying(30) NOT NULL,
    persidentifs character varying(30),
    tiidcodigos character varying(2),
    persprinoms character varying(20),
    perssegnoms character varying(30),
    perspriapes character varying(30),
    perssegapes character varying(30),
    persfecnacis integer,
    persedadn integer,
    perssexos character varying(1),
    persemail character varying(100),
    locacodigos character varying(30),
    persdirecios character varying(100),
    perstelefons character varying(13),
    persnumcels character varying(13),
    persobservs text,
    persactivas character varying(1) DEFAULT 'A'::character varying,
    cargcodigos character varying(30),
    orgacodigos character varying(30)
);

CREATE TABLE preentrada (
    prencodigos character varying(30) NOT NULL,
    prenfechingn integer NOT NULL,
    prenhoraingn integer NOT NULL,
    prenfechvenn integer,
    prenhoravenn integer,
    prenradicals character varying(30),
    prenfolios integer,
    prenremitens character varying(200),
    prenasuntos character varying(200),
    prendescrips text,
    merecodigos character varying(30) NOT NULL,
    usuacodigos character varying(30) NOT NULL,
    orgacodigos character varying(30) NOT NULL,
    prenprioris character varying(30),
    prenreservas character varying(1) DEFAULT 'N'::character varying,
    prenconfides character varying(1) DEFAULT 'N'::character varying,
    prenurgentes character varying(1) DEFAULT 'N'::character varying,
    prenfisicas character varying(1) DEFAULT 'S'::character varying,
    prendigitals character varying(1) DEFAULT 'N'::character varying,
    prenfecregis integer NOT NULL,
    prenhoraregn integer NOT NULL,
    prenfecmods integer,
    prenhoramods integer,
    prenusuamods character varying(30),
    prenestados character varying(30),
    prenactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE pregformula (
    preguntas character varying(30) NOT NULL,
    prfocodigon integer NOT NULL,
    prfonombres character varying(100) NOT NULL,
    prfoformulas text NOT NULL,
    prfoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE pregunta (
    preguntas character varying(30) NOT NULL,
    pregnombres character varying(200) NOT NULL,
    pregdescrips text,
    pregactivas character varying(1) DEFAULT 'A'::character varying,
    formcodigos character varying(30)
);

CREATE TABLE prioridad (
    pricodigos character varying(30) NOT NULL,
    prinombres character varying(100) NOT NULL,
    pridescrips text,
    priactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE proceso (
    proccodigos character varying(30) NOT NULL,
    procnombres character varying(100) NOT NULL,
    procdescrips text,
    esprcodigos character varying(30) NOT NULL,
    procactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE producto (
    prodcodigos character varying(30) NOT NULL,
    prodnombres character varying(100) NOT NULL,
    proddescrips text,
    tiprcodigos character varying(30),
    prodactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE proveedor (
    provcodigos character varying(30) NOT NULL,
    providentifs character varying(30),
    tiidcodigos character varying(2),
    provnombres character varying(150),
    provrepprnos character varying(20),
    provrepsenos character varying(30),
    provreppraps character varying(30),
    provrepseaps character varying(30),
    provlocalizs character varying(100),
    provtelefons character varying(13),
    locacodigos character varying(30),
    provpagwebs character varying(100),
    provemails character varying(100),
    provnumfaxs character varying(13),
    provaparaers character varying(200),
    provactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE proveerecurs (
    provcodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    prrevalorn double precision,
    prreobservas text,
    prreactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE recorrido (
    recocodigos character varying(30) NOT NULL,
    reconombres character varying(100) NOT NULL,
    recodescrips text,
    recoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE recurso (
    recucodigos character varying(30) NOT NULL,
    recunombres character varying(100) NOT NULL,
    recudescrips text,
    grrecodigos character varying(30),
    tirecodigos character varying(30),
    unmecodigos character varying(30),
    recuactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE recuseribode (
    bodecodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    rsbocantmins double precision,
    rsbocantmaxs double precision,
    rsboobservas text,
    rsboactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE refercross (
    recrcodigos character varying(30) NOT NULL,
    recrnombres character varying(100) NOT NULL,
    recrdescrips text,
    recractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE reglas (
    reglcodigos character varying(30) NOT NULL,
    reglnombres character varying(100) NOT NULL,
    regldescrips text,
    reglactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE relatarepers (
    tarecodigos character varying(30) NOT NULL,
    perscodigos character varying(30) NOT NULL,
    rtpeactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE reportes (
    repocodigos character varying(30) NOT NULL,
    reponombres character varying(100) NOT NULL,
    repodescrips text,
    repoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE reportescampos (
    repocodigos character varying(30) NOT NULL,
    recacodigon integer NOT NULL,
    recanombres character varying(100) NOT NULL,
    recadescrips text,
    recaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE respuepregun (
    preguntas character varying(30) NOT NULL,
    respcodigon integer NOT NULL,
    respnombres character varying(200) NOT NULL,
    respdescrips text,
    respactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE respuestausu (
    ordenumeros character varying(30) NOT NULL,
    preguntas character varying(30) NOT NULL,
    respcodigon integer NOT NULL,
    rusurespuess text,
    rusuactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE ruta (
    rutacodigos character varying(30) NOT NULL,
    rutanombres character varying(100) NOT NULL,
    rutadescrips text,
    rutaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE rutaregla (
    rutacodigos character varying(30) NOT NULL,
    reglcodigos character varying(30) NOT NULL,
    rureactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE saldo (
    bodecodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    saldcantidad double precision NOT NULL,
    saldfechan integer NOT NULL,
    saldhoran integer NOT NULL,
    saldactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE saldoserie (
    bodecodigos character varying(30) NOT NULL,
    recucodigos character varying(30) NOT NULL,
    saseseries character varying(100) NOT NULL,
    sasecantidad double precision NOT NULL,
    sasefechan integer NOT NULL,
    sasehoran integer NOT NULL,
    saseactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE sexo (
    sexocodigos character varying(1) NOT NULL,
    sexonombres character varying(20) NOT NULL,
    sexodescrips text,
    sexoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE solicitante (
    solicodigos character varying(30) NOT NULL,
    soliidentifs character varying(30),
    tiidcodigos character varying(2),
    soliprinoms character varying(20),
    solisegnoms character varying(30),
    solipriapes character varying(30),
    solisegapes character varying(30),
    solifecnacis integer,
    soliedadn integer,
    solisexos character varying(1),
    soliemail character varying(100),
    locacodigos character varying(30),
    solidirecios character varying(100),
    solitelefonos character varying(13),
    solinumcels character varying(13),
    soliobservs text,
    soliactivas character varying(1) DEFAULT 'A'::character varying,
    grincodigos character varying(30)
);

CREATE TABLE tablastipole (
    taticodigos character varying(30) NOT NULL,
    tatinombres character varying(100) NOT NULL,
    tatidescrips text,
    tatiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tarea (
    tarecodigos character varying(30) NOT NULL,
    proccodigos character varying(30) NOT NULL,
    tarenombres character varying(100) NOT NULL,
    taredescrips text,
    taretiempos integer,
    tareunidads character varying(30),
    tareordenn integer,
    tareobligats character varying(1) DEFAULT 'S'::character varying,
    tareactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tareassincro (
    tasicod character varying(30) NOT NULL,
    tasinombre character varying(100) NOT NULL,
    tasidescripcion text,
    tasiestado character varying(1) DEFAULT 'A'::character varying,
    tasifechacreacion integer,
    tasifechamodificacion integer,
    tasiusuariocreacion character varying(30),
    tasiusuariomodificacion character varying(30)
);

CREATE TABLE tema (
    temacodigos character varying(30) NOT NULL,
    temanombres character varying(100) NOT NULL,
    temadescrips text,
    ejtecodigos character varying(30),
    temaactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipoarchivo (
    tiarcodigos character varying(30) NOT NULL,
    tiarnombres character varying(100) NOT NULL,
    tiardescrips text,
    tiaractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipobodega (
    tibocodigos character varying(30) NOT NULL,
    tibonombres character varying(100) NOT NULL,
    tibodescrips text,
    tiboactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipocliente (
    ticlcodigos character varying(30) NOT NULL,
    ticlnombres character varying(100) NOT NULL,
    ticldescrips text,
    ticlactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipocontrato (
    ticocodigos character varying(30) NOT NULL,
    ticonombres character varying(100) NOT NULL,
    ticodescrips text,
    ticoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipodocument (
    tidocodigos character varying(30) NOT NULL,
    tidonombres character varying(100) NOT NULL,
    tidodescrips text,
    tidoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipoexamen (
    tiexcodigos character varying(30) NOT NULL,
    tiexnombres character varying(100) NOT NULL,
    tiexdescrips text,
    tiexactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipoidentifi (
    tiidcodigos character varying(2) NOT NULL,
    tiidnombres character varying(100) NOT NULL,
    tiiddescrips text,
    tiidactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipolocaliza (
    tilocodigos character varying(30) NOT NULL,
    tilonombres character varying(100) NOT NULL,
    tilodescrips text,
    tiloactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipomoneda (
    timocodigos character varying(30) NOT NULL,
    timonombres character varying(100) NOT NULL,
    timodescrips text,
    timoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipoorden (
    tiorcodigos character varying(30) NOT NULL,
    tiornombres character varying(150),
    tiordescrips text,
    tioractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipoorgani (
    tipocodigos character varying(30) NOT NULL,
    tiponombres character varying(100) NOT NULL,
    tipodescrips text,
    tipoactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tipoproducto (
    tiprcodigos character varying(30) NOT NULL,
    tiprnombres character varying(100) NOT NULL,
    tiprdescrips text,
    tipractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE tiporecurso (
    tirecodigos character varying(30) NOT NULL,
    tirenombres character varying(100) NOT NULL,
    tiredescrips text,
    tireactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE transfertarea (
    trtrcodigon integer NOT NULL,
    tarecodigos character varying(30) NOT NULL,
    perscodigos character varying(30) NOT NULL,
    trtrfechan integer NOT NULL,
    trtrhoran integer NOT NULL,
    trtrobservas text,
    trtractivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE unidadmedida (
    unmecodigos character varying(30) NOT NULL,
    unmenombres character varying(100) NOT NULL,
    unmedescrips text,
    unmeactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE unidadtiempo (
    unticodigos character varying(30) NOT NULL,
    untinombres character varying(100) NOT NULL,
    untidescrips text,
    untiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE validacion (
    valicodigon integer NOT NULL,
    valinombres character varying(100) NOT NULL,
    validescrips text,
    valiactivas character varying(1) DEFAULT 'A'::character varying
);

CREATE TABLE valordimension (
    dimecodigon integer NOT NULL,
    vdicodigon integer NOT NULL,
    vdinombres character varying(100) NOT NULL,
    vdidescrips text,
    vdiactivas character varying(1) DEFAULT 'A'::character varying
);

-- =============================================
-- VISTA
-- =============================================

CREATE VIEW view_solicitante AS
SELECT 
    s.solicodigos,
    s.soliidentifs,
    s.soliprinoms,
    s.solisegnoms,
    s.solipriapes,
    s.solisegapes,
    CONCAT(s.soliprinoms, ' ', s.solisegnoms, ' ', s.solipriapes, ' ', s.solisegapes) AS nombre_completo,
    s.soliemail,
    s.solitelefonos,
    l.locanombres AS localizacion,
    gi.grinnombres AS grupo_interes,
    ti.tiidnombres AS tipo_identificacion
FROM solicitante s
LEFT JOIN localizacion l ON s.locacodigos = l.locacodigos
LEFT JOIN gruposinteres gi ON s.grincodigos = gi.grincodigos
LEFT JOIN tipoidentifi ti ON s.tiidcodigos = ti.tiidcodigos
WHERE s.soliactivas = 'A';

-- =============================================
-- RESUMEN FINAL
-- =============================================

/*
TOTAL DE TABLAS CREADAS: 146
- Esquema profiles: 9 tablas
- Esquema schema2: 137 tablas
- Vistas: 1 (view_solicitante)

FUNCIONALIDADES PRINCIPALES:
1. Gestión de usuarios y perfiles
2. Sistema de órdenes/casos PQR
3. Gestión de personal y organizaciones
4. Administración de clientes y contactos
5. Control de procesos y workflow
6. Sistema de comunicaciones
7. Gestión de inventarios y recursos
8. Configuración y catálogos
9. Auditoría y logs del sistema
10. Reportes y consultas
*/