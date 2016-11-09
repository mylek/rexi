ALTER TABLE rexi_bloki_wycen_produkt ADD rabat INT NOT NULL;
ALTER TABLE rexi_bloki_wycen_produkt DROP nazwa;
ALTER TABLE rexi_inwestycje ADD zakonczone TINYINT(1) DEFAULT '0' NOT NULL;
