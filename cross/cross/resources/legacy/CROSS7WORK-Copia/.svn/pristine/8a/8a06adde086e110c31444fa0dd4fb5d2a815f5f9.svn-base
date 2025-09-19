--SET DEFAULT_TABLESPACE = 'cross';
SET search_path = profiles, pg_catalog;
-- llaves primarias
ALTER TABLE ONLY auth  ADD CONSTRAINT auth_pkey PRIMARY KEY (authusernams); 
ALTER TABLE ONLY authschema  ADD CONSTRAINT authschema_pkey PRIMARY KEY (authusernams,schecodigon);
ALTER TABLE ONLY profiles  ADD CONSTRAINT profiles_pkey PRIMARY KEY (profcodigos,applcodigos);
ALTER TABLE ONLY applications  ADD CONSTRAINT applications_pkey PRIMARY KEY (applcodigos);
ALTER TABLE ONLY style  ADD CONSTRAINT style_pkey PRIMARY KEY (stylcodigos,applcodigos);
ALTER TABLE ONLY language  ADD CONSTRAINT language_pkey PRIMARY KEY (langcodigos);
ALTER TABLE ONLY permisions  ADD CONSTRAINT permisions_pkey PRIMARY KEY (schecodigon,profcodigos, applcodigos,commnombres);
ALTER TABLE ONLY schema ADD CONSTRAINT schema_pkey PRIMARY KEY (schecodigon);
ALTER TABLE ONLY numerador ADD CONSTRAINT numerador_pkey PRIMARY KEY (numecodigos);
-- RELACIONES
ALTER TABLE ONLY authschema ADD CONSTRAINT authschema_fkey FOREIGN KEY (authusernams) REFERENCES auth(authusernams) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY authschema ADD CONSTRAINT authschema_fkey1 FOREIGN KEY (schecodigon) REFERENCES schema(schecodigon) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY auth ADD CONSTRAINT auth_fkey FOREIGN KEY (profcodigos,applcodigos) REFERENCES profiles(profcodigos,applcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY auth ADD CONSTRAINT auth_fkey1 FOREIGN KEY (stylcodigos,applcodigos) REFERENCES style(stylcodigos,applcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY auth ADD CONSTRAINT auth_fkey2 FOREIGN KEY (langcodigos) REFERENCES language(langcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY permisions ADD CONSTRAINT permisions_fkey FOREIGN KEY (profcodigos,applcodigos) REFERENCES profiles(profcodigos,applcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY permisions ADD CONSTRAINT permisions1_fkey FOREIGN KEY (schecodigon) REFERENCES schema(schecodigon) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY profiles ADD CONSTRAINT profiles_fkey FOREIGN KEY (applcodigos) REFERENCES applications(applcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY style ADD CONSTRAINT style_fkey FOREIGN KEY (applcodigos) REFERENCES applications(applcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
