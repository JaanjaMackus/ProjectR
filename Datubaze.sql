CREATE TABLE KONTS(
  ID_Konts INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Vards varchar(60) NOT NULL,
  Uzvards varchar(60) NOT NULL,
  e_pasts varchar(255) NOT NULL,
  Tiesibas bit,
  Piezimes varchar(255),
);

CREATE TABLE ATSKAITE(
  ID_Atskaite INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Nosaukums varchar(50),
  No_Datums DATETIME NOT NULL,
  Lidz_Datums DATETIME NOT NULL,
  ID_Projekts int,
  ID_Konts int
  Piezimes varchar(255),
);
CREATE TABLE PROJEKTS(
  ID_Projekts INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Nosaukums varchar(50),
  Sakuma_Datums DATETIME NOT NULL,
  Beigu_Datums DATETIME NOT NULL,
  Apraksts varchar(255),
  ID_Konts int,
  VaiPublisks bit,
  Piezimes varchar(255)
);
CREATE TABLE ZINOJUMS(
  ID_Zinojums INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  ID_Konts int,
  ID_Projekts int,
  Piezimes varchar(255)
);
CREATE TABLE ATSKAITES_DALA(
  ID_ATSK_DALA INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  ID_Mervieniba int,
  ID_Atskaite int,
  Piezimes varchar(255)
);
CREATE TABLE MERVIENIBA(
  ID_Mervieniba INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Mervieniba varchar(255),
  Piezimes varchar(255)
);
CREATE TABLE DALIBNIEKS(
  ID_Dalibnieks INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  ID_Projekts int,
  Vards varchar(60) NOT NULL,
  Uzvards varchar(60) NOT NULL,
  Apraksts varchar(255)
);

CREATE TABLE MERIJUMS(
  ID_Merijums INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Vertiba FLOAT NOT NULL,
  Datums DATETIME NOT NULL,
  ID_Sensors int,
  ID_Mervieniba int,
  ID_Projekts int,
  Piezimes varchar(255)
);

CREATE TABLE SENSORS(
  ID_Sensors INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  ID_Aktivitate int NOT NULL,
  Nosaukums varchar(255) NOT NULL,
  ID_Tips int NOT NULL,
  ID_Modelis int NOT NULL,
  ID_Razotajs int NOT NULL
);

CREATE TABLE TIPS(
  ID_Tips INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Tips varchar(255),
  Piezimes varchar(255)
);
CREATE TABLE MODELIS(
  ID_Modelis INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Modelis varchar(255),
  Piezimes varchar(255)
);
CREATE TABLE RAZOTAJS(
  ID_Razotajs INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Razotajs varchar(255),
  Piezimes varchar(255)
);
CREATE TABLE AKTIVITATE(
  ID_Aktivitate INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
  Nosaukums varchar(255),
  Piezimes varchar(255)
);


ALTER TABLE PROJEKTS
ADD CONSTRAINT FK_PROJ_ID_Konts
FOREIGN KEY (ID_Konts) REFERENCES KONTS(ID_Konts); 


ALTER TABLE ATSKAITE
ADD CONSTRAINT FK_ATSK_ID_Konts
FOREIGN KEY (ID_Konts) REFERENCES KONTS(ID_Konts); 

ALTER TABLE ATSKAITE
ADD CONSTRAINT FK_ATSK_ID_Projekts
FOREIGN KEY (ID_Projekts) REFERENCES PROJEKTS(ID_Projekts); 

ALTER TABLE ZINOJUMS
ADD CONSTRAINT FK_PROJ_ID_Konts
FOREIGN KEY (ID_Konts) REFERENCES KONTS(ID_Konts);

ALTER TABLE ZINOJUMS
ADD CONSTRAINT FK_ZIN_ID_Projekts
FOREIGN KEY (ID_Projekts) REFERENCES PROJEKTS(ID_Projekts);


ALTER TABLE ATSKAITES_DALA
ADD CONSTRAINT FK_ID_Atskaite
FOREIGN KEY (ID_Atskaite) REFERENCES ATSKAITE(ID_Atskaite);

ALTER TABLE ATSKAITES_DALA
ADD CONSTRAINT FK_ATSK_ID_Mervieniba
FOREIGN KEY (ID_Mervieniba) REFERENCES MERVIENIBA(ID_Mervieniba);
    

ALTER TABLE MERIJUMS
ADD CONSTRAINT FK_MER_ID_Mervieniba
FOREIGN KEY (ID_Mervieniba) REFERENCES MERVIENIBA(ID_Mervieniba); 

ALTER TABLE MERIJUMS
ADD CONSTRAINT FK_ID_Sensors
FOREIGN KEY (ID_Sensors) REFERENCES SENSORS(ID_Sensors); 

ALTER TABLE MERIJUMS
ADD CONSTRAINT FK_MER_ID_Projekts
FOREIGN KEY (ID_Projekts) REFERENCES PROJEKTS(ID_Projekts); 


ALTER TABLE DALIBNIEKS
ADD CONSTRAINT FK_ID_DAL_Projekts
FOREIGN KEY (ID_Projekts) REFERENCES PROJEKTS(ID_Projekts); 



ALTER TABLE SENSORS
ADD CONSTRAINT FK_ID_Tips
FOREIGN KEY (ID_Tips) REFERENCES TIPS(ID_Tips);

ALTER TABLE SENSORS
ADD CONSTRAINT FK_ID_Modelis
FOREIGN KEY (ID_Modelis) REFERENCES MODELIS(ID_Modelis);

ALTER TABLE SENSORS
ADD CONSTRAINT FK_ID_Aktivitate
FOREIGN KEY (ID_Aktivitate) REFERENCES AKTIVITATE(ID_Aktivitate);


ALTER TABLE SENSORS
ADD CONSTRAINT FK_ID_Razotajs
FOREIGN KEY (ID_Razotajs) REFERENCES RAZOTAJS(ID_Razotajs);
