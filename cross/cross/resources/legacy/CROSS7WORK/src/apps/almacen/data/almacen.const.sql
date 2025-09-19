ALTER TABLE ONLY tipobodega ADD CONSTRAINT tipobodega_pkey PRIMARY KEY (tibocodigos);
ALTER TABLE ONLY concepmovimi ADD CONSTRAINT concepmovimi_pkey PRIMARY KEY (comocodigos);
ALTER TABLE ONLY bodega ADD CONSTRAINT bodega_pkey PRIMARY KEY (bodecodigos);
ALTER TABLE ONLY movimialmace ADD CONSTRAINT movimialmace_pkey PRIMARY KEY (moalcodigos);
ALTER TABLE ONLY tipodocument ADD CONSTRAINT tipodocument_pkey PRIMARY KEY (tidocodigos);
ALTER TABLE ONLY tiporecurso ADD CONSTRAINT tiporecurso_pkey PRIMARY KEY (tirecodigos);
ALTER TABLE ONLY gruporecurso ADD CONSTRAINT gruporecurso_pkey PRIMARY KEY (grrecodigos);
ALTER TABLE ONLY unidadmedida ADD CONSTRAINT unidadmedida_pkey PRIMARY KEY (unmecodigos);
ALTER TABLE ONLY proveedor ADD CONSTRAINT proveedor_pkey PRIMARY KEY (provcodigos);
ALTER TABLE ONLY proveerecurs ADD CONSTRAINT proveerecurs_pkey PRIMARY KEY (prrecodigos);
ALTER TABLE ONLY recurso ADD CONSTRAINT recurso_pkey PRIMARY KEY (recucodigos);

ALTER TABLE ONLY bodega ADD CONSTRAINT bodega_fkey FOREIGN KEY (tibocodigos) REFERENCES tipobodega(tibocodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE ONLY movimialmace ADD CONSTRAINT movimialmace_fkey FOREIGN KEY (bodecodigos) REFERENCES bodega(bodecodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY movimialmace ADD CONSTRAINT movimialmace_fkey1 FOREIGN KEY (recucodigos) REFERENCES recurso(recucodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY movimialmace ADD CONSTRAINT movimialmace_fkey2 FOREIGN KEY (comocodigos) REFERENCES concepmovimi(comocodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY movimialmace ADD CONSTRAINT movimialmace_fkey3 FOREIGN KEY (perscodigos) REFERENCES personal(perscodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY movimialmace ADD CONSTRAINT movimialmace_fkey4 FOREIGN KEY (tidocodigos) REFERENCES tipodocument(tidocodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX movimialmace_ind ON movimialmace USING btree (bodecodigos);
CREATE INDEX movimialmace_ind1 ON movimialmace USING btree (recucodigos);

ALTER TABLE ONLY recuseribode ADD CONSTRAINT recuseribode_fkey FOREIGN KEY (recucodigos) REFERENCES recurso(recucodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX recuseribode_ind ON recuseribode USING btree (recucodigos);
CREATE INDEX recuseribode_ind1 ON recuseribode USING btree (resbbodeactu);

ALTER TABLE ONLY recurso ADD CONSTRAINT recurso_fkey FOREIGN KEY (tirecodigos) REFERENCES tiporecurso(tirecodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY recurso ADD CONSTRAINT recurso_fkey1 FOREIGN KEY (grrecodigos) REFERENCES gruporecurso(grrecodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY recurso ADD CONSTRAINT recurso_fkey2 FOREIGN KEY (unmecodigos) REFERENCES unidadmedida(unmecodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;

ALTER TABLE ONLY proveerecurs ADD CONSTRAINT proveerecurs_fkey FOREIGN KEY (provcodigos) REFERENCES proveedor(provcodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
ALTER TABLE ONLY proveerecurs ADD CONSTRAINT proveerecurs_fkey1 FOREIGN KEY (recucodigos) REFERENCES recurso(recucodigos) ON UPDATE NO ACTION ON DELETE NO ACTION;
CREATE INDEX proveerecurs_ind ON proveerecurs USING btree (recucodigos);
CREATE INDEX proveerecurs_ind1 ON proveerecurs USING btree (provcodigos);







 
