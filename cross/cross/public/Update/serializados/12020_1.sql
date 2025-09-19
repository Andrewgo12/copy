set search_path=schema2;
--DROP TABLE "archivoaux";
CREATE TABLE "archivoaux" (
    "araucodigon"  integer NOT NULL,-- Id que tiene el hilo del proceso al cual se relacionan los archivos
    "araulinean" integer NOT NULL, -- Linea del proceso
    "archcodigon"  integer,-- Id del archivo
    "araufecregn"  integer,
    "usuacodigos"  varchar(30),
    "araucruds"    varchar(10),-- operacion 1 ingreso 2 borrado
    "arauestados"  varchar(1) DEFAULT 'P' -- P o F si araucruds 1 entonces P Pendiente de bajar al disco F creado en disco si araucruds 2 entonces P pendiente de eliminar del disco F eliminado
);
ALTER TABLE ONLY  "archivoaux" ADD CONSTRAINT archivoaux_pkey PRIMARY KEY ("araucodigon");
INSERT INTO numerador VALUES ('archivoaux','Secuencia para la tabla auxiliar de archivos',1);
INSERT INTO numerador VALUES ('thread','Linea del proceso para la tabla auxiliar de archivos',1);
