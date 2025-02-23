-- Creazione della tabella Dinastia
CREATE TABLE dinastia.sovrano (

                                  nome varchar(30) PRIMARY KEY,
                                  immagine varchar(30),
                                  inizio DATE NOT NULL,
                                  fine DATE NULL,
                                  predecessore_id varchar(30),
                                  successore_id varchar(30),
                                  CONSTRAINT fk_predecessore FOREIGN KEY (predecessore_id) REFERENCES sovrano(nome),
                                  CONSTRAINT fk_successore FOREIGN KEY (successore_id) REFERENCES sovrano(nome)
);


INSERT INTO dinastia.sovrano (nome, immagine, inizio, fine) VALUES
                                                                ('Carlo I', 'carlo1.jpg', '1600-01-01', '1625-03-27'),
                                                                ('Carlo II', 'carlo2.jpg', '1625-03-27', '1650-06-06'),
                                                                ('Luigi XIV', 'luigi14.jpg', '1650-06-06', '1715-09-01'),
                                                                ('Luigi XV', 'luigi15.jpg', '1715-09-01', '1774-05-10'),
                                                                ('Luigi XVI', 'luigi16.jpg', '1774-05-10', '1793-01-21');


UPDATE dinastia.sovrano SET successore_id = 'Carlo II' WHERE nome = 'Carlo I';
UPDATE dinastia.sovrano SET predecessore_id = 'Carlo I', successore_id = 'Luigi XIV' WHERE nome = 'Carlo II';
UPDATE dinastia.sovrano SET predecessore_id = 'Carlo II', successore_id = 'Luigi XV' WHERE nome = 'Luigi XIV';
UPDATE dinastia.sovrano SET predecessore_id = 'Luigi XIV', successore_id = 'Luigi XVI' WHERE nome = 'Luigi XV';
UPDATE dinastia.sovrano SET predecessore_id = 'Luigi XV' WHERE nome = 'Luigi XVI';