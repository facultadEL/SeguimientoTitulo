ALTER TABLE seguimiento DROP CONSTRAINT num_res_cd_fk_fkey
ALTER TABLE seguimiento ADD FOREIGN KEY(num_res_cd_fk) REFERENCES archivo(id)
ALTER TABLE seguimiento DROP CONSTRAINT num_nota_fk_fkey
ALTER TABLE seguimiento ADD FOREIGN KEY(num_nota_fk) REFERENCES archivo(id)
ALTER TABLE seguimiento DROP CONSTRAINT num_res_cs_fk_fkey
ALTER TABLE seguimiento ADD FOREIGN KEY(num_res_cs_fk) REFERENCES archivo(id)
ALTER TABLE seguimiento DROP CONSTRAINT num_acta_fk_fkey
ALTER TABLE seguimiento ADD FOREIGN KEY(num_acta_fk) REFERENCES archivo(id)