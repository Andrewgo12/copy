
CREATE TABLE ordengruposinteres (
    "ordenumeros"	VARCHAR(30) NOT NULL,
    "grincodigos"	VARCHAR(30) NOT NULL
);
ALTER TABLE ONLY "ordengruposinteres" ADD CONSTRAINT "ordengruposinteres_pkey" PRIMARY KEY ("ordenumeros");

COMMENT ON TABLE "ordengruposinteres" IS 'Tabla que almacena la información del grupo de interés de un caso.';
COMMENT ON COLUMN "ordengruposinteres"."ordenumeros" IS 'Número del caso.';
COMMENT ON COLUMN "ordengruposinteres"."grincodigos" IS 'Código del grupo de interés.';

ALTER TABLE "ordengruposinteres" OWNER TO crosshuvdb;
GRANT ALL ON TABLE "ordengruposinteres" TO crosshuvdb WITH GRANT OPTION;
