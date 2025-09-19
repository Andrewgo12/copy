
--Creamos la tabla para almacenar los grupos de interés
CREATE TABLE gruposinteres (
    "grincodigos"  VARCHAR(30) NOT NULL,
    "grinnombres"  VARCHAR(150),
    "grindescrips" TEXT,
    "grinactivos"  CHAR(1) NOT NULL DEFAULT 'A'
);
ALTER TABLE ONLY "gruposinteres" ADD CONSTRAINT "gruposinteres_pkey" PRIMARY KEY ("grincodigos");

ALTER TABLE "gruposinteres" OWNER TO crosshuvdb;
GRANT ALL ON TABLE "gruposinteres" TO crosshuvdb;

INSERT INTO "gruposinteres" ("grincodigos","grinnombres","grindescrips","grinactivos") VALUES ('1','Junta Directiva',NULL,'A');
INSERT INTO "gruposinteres" ("grincodigos","grinnombres","grindescrips","grinactivos") VALUES ('2','Gobierno Nacional, Departamental y Municipal',NULL,'A');
INSERT INTO "gruposinteres" ("grincodigos","grinnombres","grindescrips","grinactivos") VALUES ('3','Proveedores y aliados estratégicos',NULL,'A');
INSERT INTO "gruposinteres" ("grincodigos","grinnombres","grindescrips","grinactivos") VALUES ('4','Instituciones Educativas',NULL,'A');
INSERT INTO "gruposinteres" ("grincodigos","grinnombres","grindescrips","grinactivos") VALUES ('5','Asociación de usuarios',NULL,'A');

--ALTER TABLE contacto ADD COLUMN grincodigos varchar(30);