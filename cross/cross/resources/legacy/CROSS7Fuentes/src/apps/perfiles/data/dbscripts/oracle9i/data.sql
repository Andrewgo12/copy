--Data
INSERT INTO "applications" VALUES ('1', 'general', 'cross300 con Work Flow');
INSERT INTO "applications" VALUES ('2', 'profiles', 'Aplicación de adminstración de usuarios');


INSERT INTO "profiles" VALUES ('1', '1', 'Administrador', '');
INSERT INTO "profiles" VALUES ('1', '2', 'Administrador', '');
INSERT INTO "profiles" VALUES ('2','1','Público','Perfil para el usuario público');
INSERT INTO "profiles" VALUES ('3','1','Usuario Web','Perfil para el usuario web');

INSERT INTO "auth" VALUES ('Admin', 'secret', 'Admin', 'Admin', 'Admin', '', '2', '2', 'es', '1','A');
INSERT INTO "auth" VALUES ('webuser','webuser','Usuario web','','','','1','2','es','3','A');

INSERT INTO "authschema" VALUES ('Admin',1);

INSERT INTO "language" VALUES ('es', 'Español', '');
INSERT INTO "numerador" VALUES ('schema','Secuencia para los schema',2);
INSERT INTO "schema" VALUES (1,'profiles','postgres','full.2004',NULL,'A'); 

INSERT INTO "style" VALUES ('1', '1', 'original.css', '');
INSERT INTO "style" VALUES ('1', '2', 'original.css', '');
INSERT INTO "style" VALUES ('2', '2', 'estilos.css', '');
INSERT INTO "style" VALUES ('2', '1', 'estilos.css', '');