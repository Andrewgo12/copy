-- RELACIONES
ALTER TABLE  "auth" ADD CONSTRAINT auth_pkey PRIMARY KEY ("authusernams");
ALTER TABLE  "authschema"  ADD CONSTRAINT authschema_pkey PRIMARY KEY ("authusernams","schecodigon");
ALTER TABLE  "profiles" ADD CONSTRAINT profiles_pkey PRIMARY KEY ("profcodigos", "applcodigos");
ALTER TABLE  "applications" ADD CONSTRAINT applications_pkey PRIMARY KEY ("applcodigos");
ALTER TABLE  "style" ADD CONSTRAINT style_pkey PRIMARY KEY ("stylcodigos", "applcodigos");
ALTER TABLE  "language" ADD CONSTRAINT language_pkey PRIMARY KEY ("langcodigos");
ALTER TABLE  "permisions"  ADD CONSTRAINT permisions_pkey PRIMARY KEY ("schecodigon","profcodigos", "applcodigos","commnombres");
ALTER TABLE   "schema" ADD CONSTRAINT schema_pkey PRIMARY KEY ("schecodigon");
--ALTER TABLE  "numerador" ADD CONSTRAINT numerador_pkey PRIMARY KEY ("numecodigos");

ALTER TABLE  "authschema" ADD CONSTRAINT authschema_fkey FOREIGN KEY ("authusernams") REFERENCES "auth"("authusernams");
ALTER TABLE  "authschema" ADD CONSTRAINT authschema_fkey1 FOREIGN KEY ("schecodigon") REFERENCES "schema"("schecodigon");
ALTER TABLE  "auth" ADD CONSTRAINT auth_fkey FOREIGN KEY ("profcodigos", "applcodigos") REFERENCES "profiles" ("profcodigos", "applcodigos");
ALTER TABLE  "auth" ADD CONSTRAINT auth_fkey1 FOREIGN KEY ("stylcodigos", "applcodigos") REFERENCES "style" ("stylcodigos", "applcodigos");
ALTER TABLE  "auth" ADD CONSTRAINT auth_fkey2 FOREIGN KEY ("langcodigos") REFERENCES "language" ("langcodigos");
ALTER TABLE  "permisions" ADD CONSTRAINT permisions_fkey FOREIGN KEY ("profcodigos", "applcodigos") REFERENCES "profiles" ("profcodigos", "applcodigos");
ALTER TABLE  "permisions" ADD CONSTRAINT permisions1_fkey FOREIGN KEY ("schecodigon") REFERENCES "schema"("schecodigon");
ALTER TABLE  "profiles" ADD CONSTRAINT profiles_fkey FOREIGN KEY ("applcodigos") REFERENCES "applications" ("applcodigos");
ALTER TABLE  "style" ADD CONSTRAINT style_fkey FOREIGN KEY ("applcodigos") REFERENCES "applications" ("applcodigos");