CREATE EXTENSION IF NOT EXISTS postgis;
CREATE TABLE IF NOT EXISTS moradia(
        id_moradia SERIAL CONSTRAINT pk_id_moradia PRIMARY KEY,
        pt_BR VARCHAR(11) NOT NULL,
        en_US VARCHAR(11) NOT NULL
);

INSERT INTO moradia VALUES (DEFAULT, 'Casa', 'House'),(DEFAULT, 'Apartamento', 'Apartment'),(DEFAULT, 'Sítio', 'Ranch House');

CREATE TABLE IF NOT EXISTS horasSozinho(
        id_horasSozinho SERIAL CONSTRAINT pk_horasSozinho PRIMARY KEY,
        pt_BR VARCHAR(30) NOT NULL,
        en_US VARCHAR(30) NOT NULL
);

INSERT INTO horasSozinho VALUES (DEFAULT, 'Nem uma hora', 'Not even an hour'),(DEFAULT, 'De 1 a 3 horas', 'From 1 to 3 hours'),(DEFAULT, 'De 4 a 6 horas', 'From 4 to 6 hours'),(DEFAULT, 'Mais de 6 horas', 'More than 6 hours');

CREATE TABLE IF NOT EXISTS genero(
        id_genero SERIAL CONSTRAINT pk_genero PRIMARY KEY,
        pt_BR VARCHAR(10) NOT NULL,
        en_US VARCHAR(10) NOT NULL
);

INSERT INTO genero VALUES (DEFAULT, 'Masculino', 'Male'),(DEFAULT, 'Feminino', 'Female');

CREATE TABLE IF NOT EXISTS especie(
        id_especies SERIAL CONSTRAINT pk_especie  PRIMARY KEY,
        pt_BR VARCHAR(8) NOT NULL,
        en_US VARCHAR(8) NOT NULL      
);

INSERT INTO especie VALUES (DEFAULT, 'Cachorro', 'Dog'),(DEFAULT, 'Gato', 'Cat');

CREATE TABLE IF NOT EXISTS raca(
        id_raca SERIAL CONSTRAINT pk_raca PRIMARY KEY,
        pt_BR VARCHAR(30) NOT NULL, 
        en_us VARCHAR(30) NOT NULL,  
        id_especies INTEGER,
        CONSTRAINT fk_especie FOREIGN KEY (id_especies) REFERENCES especie(id_especies)
);

INSERT INTO raca VALUES 
(DEFAULT, 'Sem Raça Definida', 'Mixed-breed', 1),
(DEFAULT, 'Akita', 'Akita', 1),
(DEFAULT, 'American Staffordshire Terrier', 'American Staffordshire Terrier', 1),
(DEFAULT, 'Basset Hound', 'Basset Hound', 1),
(DEFAULT, 'Beagle', 'Beagle', 1),
(DEFAULT, 'Bichon Frisé', 'Bichon Frisé', 1),
(DEFAULT, 'Boiadeiro australiano', 'Australian Cattle Dog', 1),
(DEFAULT, 'Border Collie', 'Border Collie', 1),
(DEFAULT, 'Boston Terrier', 'Boston Terrier', 1),
(DEFAULT, 'Boxer', 'Boxer', 1),
(DEFAULT, 'Buldogue Francês', 'French Bulldog', 1),
(DEFAULT, 'Buldogue Inglês', 'Bulldog', 1),
(DEFAULT, 'Bull Terrier', 'Bull Terrier', 1),
(DEFAULT, 'Cane Corso', 'Cane Corso', 1),
(DEFAULT, 'Cavalier Charles Spaniel', 'Cavalier King Charles Spaniel', 1),
(DEFAULT, 'Chihuahua', 'Chihuahua', 1),
(DEFAULT, 'Chow Chow', 'Chow Chow', 1),
(DEFAULT, 'Cocker Spaniel Inglês', 'English Cocker Spaniel', 1),
(DEFAULT, 'Dachshund', 'Dachshund', 1),
(DEFAULT, 'Dálmata', 'Dalmatian', 1),
(DEFAULT, 'Doberman', 'Dobermann', 1),
(DEFAULT, 'Dogo Argentino', 'Argentine Dogo', 1),
(DEFAULT, 'Dogue Alemão', 'Great Dane', 1),
(DEFAULT, 'Fila Brasileiro', 'Brazilian Mastiff', 1),
(DEFAULT, 'Golden Retriever', 'Golden Retriever', 1),
(DEFAULT, 'Husky Siberiano', 'Siberian Husky', 1),
(DEFAULT, 'Jack Russel Terrier', 'Jack Russel Terrier', 1),
(DEFAULT, 'Labrador Retriever', 'Labrador Retriever', 1),
(DEFAULT, 'Lhasa Apso', 'Lhasa Apso', 1),
(DEFAULT, 'Lulu da Pomerânia', 'Pomeranian', 1),
(DEFAULT, 'Maltês', 'Maltese', 1),
(DEFAULT, 'Mastiff Inglês', 'English Mastiff', 1),
(DEFAULT, 'Mastim Tiberiano', 'Tibetan Mastiff', 1),
(DEFAULT, 'Pastor Alemão', 'German Shepherd', 1),
(DEFAULT, 'Pastor Australiano', 'Australian Shepherd', 1),
(DEFAULT, 'Pastor de Shetland', 'Sheltie', 1),
(DEFAULT, 'Pequinês', 'Pekingese', 1),
(DEFAULT, 'Pinscher', 'Pinscher', 1),
(DEFAULT, 'Pitbull', 'Pit bull', 1),
(DEFAULT, 'Poodle', 'Poodle', 1),
(DEFAULT, 'Pug', 'Pug', 1),
(DEFAULT, 'Rottweiler', 'Rottweiler', 1),
(DEFAULT, 'Schnauzer', 'Schnauzer', 1),
(DEFAULT, 'Shar-pei', 'Shar-pei', 1),
(DEFAULT, 'Shiba', 'Shiba', 1),
(DEFAULT, 'Shih Tzu', 'Shih Tzu', 1),
(DEFAULT, 'Staffordshire Bull Terrier', 'Staffordshire Bull Terrier', 1),
(DEFAULT, 'Weimaraner', 'Weimaraner', 1),
(DEFAULT, 'Whippet', 'Whippet', 1),
(DEFAULT, 'Yorkshire Terrier', 'Yorkshire Terrier', 1),
(DEFAULT, 'Sem Raça Definida', 'Mixed-breed', 2),
(DEFAULT, 'Savannah', 'Savannah', 2),
(DEFAULT, 'Oriental Shorthair', 'Oriental Shorthair', 2),
(DEFAULT, 'Oriental Longhair', 'Oriental Longhair', 2),
(DEFAULT, 'Somali', 'Somali', 2),
(DEFAULT, 'Turkish Van', 'Turkish Van', 2),
(DEFAULT, 'Chausie', 'Chausie', 2),
(DEFAULT, 'Birmanês', 'Birman', 2),
(DEFAULT, 'Chartreux', 'Chartreux', 2),
(DEFAULT, 'Sagrado da Birmânia', 'Burmese', 2),
(DEFAULT, 'Sokoke', 'Sokoke', 2),
(DEFAULT, 'Nebelung', 'Nebelung', 2),
(DEFAULT, 'Selkirk Rex', 'Selkirk Rex', 2),
(DEFAULT, 'Cornish Rex', 'Cornish Rex', 2),
(DEFAULT, 'Ocicat', 'Ocicat', 2),
(DEFAULT, 'Peterbald', 'Peterbald', 2),
(DEFAULT, 'Devon Rex', 'Devon Rex', 2),
(DEFAULT, 'Korat', 'Korat', 2),
(DEFAULT, 'Selvagem', 'Wildcat', 2),
(DEFAULT, 'Exótico de Pelo Curto', 'Exotic Shorthair', 2),
(DEFAULT, 'Azul Russo', 'Russian Blue', 2),
(DEFAULT, 'Scottish Fold', 'Scottish Fold', 2),
(DEFAULT, 'Snowshoe', 'Snowshoe', 2),
(DEFAULT, 'Manx', 'Manx', 2),
(DEFAULT, 'Angorá Turco', 'Turkish Angora', 2),
(DEFAULT, 'Bombaim', 'Bombay', 2),
(DEFAULT, 'Norueguês da Floresta', 'Norwegian Forest Cat', 2),
(DEFAULT, 'Siberiano', 'Siberian', 2),
(DEFAULT, 'Bengala', 'Bengal', 2),
(DEFAULT, 'Siamês', 'Siamese', 2),
(DEFAULT, 'Ashera', 'Ashera', 2),
(DEFAULT, 'Maine Coon', 'Maine Coon', 2),
(DEFAULT, 'Pixie-bob', 'Pixie-bob', 2),
(DEFAULT, 'Khao Manee', 'Khao Manee', 2),
(DEFAULT, 'Bobtail Americano', 'American Bobtail', 2),
(DEFAULT, 'American Wirehair', 'American Wirehair', 2),
(DEFAULT, 'American Curl', 'American Curl', 2),
(DEFAULT, 'LaPerm', 'LaPerm', 2),
(DEFAULT, 'Tonquinês', 'Tonkinese', 2),
(DEFAULT, 'Javanês', 'Javanese', 2),
(DEFAULT, 'Singapura', 'Singapura', 2),
(DEFAULT, 'Burmilla', 'Burmilla', 2),
(DEFAULT, 'Cymric', 'Cymric', 2),
(DEFAULT, 'Skookum', 'Skookum', 2),
(DEFAULT, 'Toyger', 'Toyger', 2),
(DEFAULT, 'Bobtail Japonês', 'Japanese Bobtail', 2),
(DEFAULT, 'Lykoi ou Gato Lobo', 'Lykoi', 2),
(DEFAULT, 'Munchkin', 'Munchkin', 2),
(DEFAULT, 'Mau Egípicio', 'Egyptian Mau', 2),
(DEFAULT, 'Himalaio', 'Himalayan', 2),
(DEFAULT, 'Havana', 'Havana', 2),
(DEFAULT, 'Europeu', 'European', 2),
(DEFAULT, 'Balinês', 'Balinese', 2),
(DEFAULT, 'Sphynx', 'Sphynx', 2),
(DEFAULT, 'Mist Australiano', 'Australian Mist', 2),
(DEFAULT, 'Abissíno', 'Abyssinian', 2),
(DEFAULT, 'Persa', 'Persian', 2),
(DEFAULT, 'Ragdoll', 'Ragdoll', 2),
(DEFAULT, 'Ragamuffins', 'Ragamuffins', 2),
(DEFAULT, 'British Longhair', 'British Longhair', 2),
(DEFAULT, 'British Shorthair', 'British Shorthair', 2);

CREATE TABLE IF NOT EXISTS porte(
        id_porte SERIAL CONSTRAINT pk_porte PRIMARY KEY,
        pt_BR VARCHAR(9) NOT NULL,   
        en_US VARCHAR(9) NOT NULL
);

INSERT INTO porte VALUES (DEFAULT, 'Miniatura', 'Miniature'),(DEFAULT, 'Pequeno', 'Small'),(DEFAULT, 'Médio', 'Medium'),(DEFAULT, 'Grande', 'Large');

CREATE TABLE IF NOT EXISTS statusAnimal(
        id_status SERIAL PRIMARY KEY,
        pt_BR VARCHAR(30),
        en_US VARCHAR(30)
);

INSERT INTO statusAnimal VALUES (DEFAULT, 'Disponível', 'Available'),(DEFAULT, 'Em processo de adoção', 'Applying for an adoption'),(DEFAULT, 'Adotado', 'Adopted');

CREATE TABLE IF NOT EXISTS pelagem (
        id_pelagem SERIAL PRIMARY KEY,
        pt_BR VARCHAR(40),
        en_US VARCHAR(40)
);

INSERT INTO pelagem VALUES 
(DEFAULT, 'Curta', 'Short'),
(DEFAULT, 'Média', 'Medium'),
(DEFAULT, 'Longa', 'Long'),   
(DEFAULT, 'Sem pelos', 'Hairless');

CREATE TABLE IF NOT EXISTS temperamento (
        id_temperamento SERIAL PRIMARY KEY,
        pt_BR VARCHAR(40),
        en_US VARCHAR(40)
);

INSERT INTO temperamento VALUES 
(DEFAULT, 'Medroso', 'Fearful'),
(DEFAULT, 'Agressivo', 'Agressive'),
(DEFAULT, 'Assustado', 'Scared'),   
(DEFAULT, 'Tranquilo', 'Calm'),
(DEFAULT, 'Agitado', 'Agitated'),
(DEFAULT, 'Preguiçoso', 'Lazy'),
(DEFAULT, 'Curioso', 'Curious'),   
(DEFAULT, 'Afetuoso', 'Loving');

CREATE TABLE IF NOT EXISTS outrosAnimais (
        id_outrosAnimais SERIAL PRIMARY KEY,
        pt_BR VARCHAR(80),
        en_US VARCHAR(80)
);

INSERT INTO outrosAnimais VALUES 
(DEFAULT, 'Sim. Em minha casa não vive nenhum outro animal.', 'Yes. No other animal lives in my house.'),
(DEFAULT, 'Não. Em minha casa já vive outro gato ou cachorro.', 'No. A dog or a cat already lives in my house.'),
(DEFAULT, 'Não. Em minha casa já vive outro animal, mas não um cachorro ou um gato.', 'No. Another animal already lives in my house, but not a cat or a dog.');   

CREATE TABLE IF NOT EXISTS usuario(
        id_usuario SERIAL CONSTRAINT pk_usuario PRIMARY KEY,
        nome VARCHAR(80) NOT NULL,
        email VARCHAR(60) NOT NULL,  
        senha CHAR(60) NOT NULL,
        id_genero INTEGER NOT NULL,
        datanasci DATE NOT NULL,
        localizacao POINT,
        criancas BOOLEAN,
        acessoprotegido BOOLEAN,
        gastos BOOLEAN,
        alergia BOOLEAN,
        qtdMoradores SMALLINT,
        id_moradia INTEGER,
        id_horasSozinho INTEGER, 
        id_outrosAnimais INTEGER,
        disponivel BOOLEAN,
        CONSTRAINT fk_genero FOREIGN KEY (id_genero) REFERENCES genero(id_genero),
        CONSTRAINT fk_moradia FOREIGN KEY (id_moradia) REFERENCES moradia(id_moradia),
        CONSTRAINT fk_horasSozinho FOREIGN KEY (id_horasSozinho) REFERENCES horasSozinho(id_horasSozinho),
        CONSTRAINT fk_outrosAnimais FOREIGN KEY (id_outrosAnimais) REFERENCES outrosAnimais(id_outrosAnimais)
);

CREATE TABLE IF NOT EXISTS animal(
        id_animal SERIAL CONSTRAINT pk_animal PRIMARY KEY,
        imagem VARCHAR(70) NOT NULL,
        nome VARCHAR(80) NOT NULL,
        id_genero INTEGER,
        datanasci DATE NOT NULL,
        id_raca INTEGER,
        id_porte INTEGER,
        castrado BOOLEAN NOT NULL,
        especial BOOLEAN NOT NULL,
        infoAdicional VARCHAR(255),
        id_status INTEGER, 
        id_pelagem INTEGER,
        id_temperamento INTEGER, 
        id_doador INTEGER,
        id_adotante INTEGER,
        CONSTRAINT fk_adotante FOREIGN KEY (id_adotante) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
        CONSTRAINT fk_usuario FOREIGN KEY (id_doador) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
        CONSTRAINT fk_raca FOREIGN KEY (id_raca) REFERENCES raca(id_raca),
        CONSTRAINT fk_genero FOREIGN KEY (id_genero) REFERENCES genero(id_genero),
        CONSTRAINT fk_porte FOREIGN KEY (id_porte) REFERENCES porte(id_porte),
        CONSTRAINT fk_status FOREIGN KEY (id_status) REFERENCES statusAnimal(id_status),
        CONSTRAINT fk_pelagem FOREIGN KEY (id_pelagem) REFERENCES pelagem(id_pelagem),
        CONSTRAINT fk_temperamento FOREIGN KEY (id_temperamento) REFERENCES temperamento(id_temperamento)  
);

CREATE TABLE IF NOT EXISTS statussolicitacao (
        id_status SERIAL PRIMARY KEY,
        statussolicitacao VARCHAR(8)
);

INSERT INTO statussolicitacao VALUES
(DEFAULT, 'Pendente'),
(DEFAULT, 'Aceita'),
(DEFAULT, 'Recusada');


CREATE TABLE IF NOT EXISTS avaliacao_animal (
        id_avaliacao SERIAL PRIMARY KEY,
        avaliacao BOOLEAN NOT NULL,
        id_usuario INTEGER NOT NULL,
        id_animal INTEGER NOT NULL,
        status_solicitacao INTEGER,
        status_adopted INTEGER,
        datahora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_status FOREIGN KEY (status_solicitacao) REFERENCES statussolicitacao(id_status),
        CONSTRAINT fk_adopted FOREIGN KEY (status_adopted) REFERENCES statussolicitacao(id_status),
        CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
        CONSTRAINT fk_animal FOREIGN KEY (id_animal) REFERENCES animal(id_animal) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS mensagem (
        id_mensagem SERIAL CONSTRAINT pk_id_mensagem PRIMARY KEY,
        conteudo VARCHAR (255), 
        dataHora TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
        id_remetente INTEGER NOT NULL,
        id_destinatario INTEGER NOT NULL,
        id_animal INTEGER,
        status_msg BOOLEAN,
        CONSTRAINT fk_remetente FOREIGN KEY (id_remetente) REFERENCES usuario(id_usuario) ON DELETE SET NULL ,
        CONSTRAINT fk_destinatario FOREIGN KEY (id_destinatario) REFERENCES usuario(id_usuario) ON DELETE SET NULL ,
        CONSTRAINT fk_animal FOREIGN KEY (id_animal) REFERENCES animal(id_animal) ON DELETE SET NULL          
);

CREATE TABLE IF NOT EXISTS motivos_denuncia (
        id_motivo SERIAL PRIMARY KEY,
        pt_br VARCHAR(80),
        en_us VARCHAR(80)
);

INSERT INTO motivos_denuncia VALUES
(DEFAULT, 'Roubo de dados e informações', 'Data and information theft'),
(DEFAULT, 'Calúnia, injúria ou difamação', 'Slander, injury or defamation'),
(DEFAULT, 'Falsidade ideológica', 'Ideological falsehood'),
(DEFAULT, 'Bullying virtual e assédio sexual ou moral', 'Virtual bullying and sexual or moral harassment'),
(DEFAULT, 'Crimes de ódio (racismo, homofobia, etc)', 'Hate crimes (racism, homophobia, etc)'),
(DEFAULT, 'Apologia ao crime ou ameaças', 'Apology for crime or threats');

CREATE TABLE IF NOT EXISTS denuncia (
        id_denuncia SERIAL PRIMARY KEY,
        denuncia INTEGER,
        id_denunciante INTEGER, 
        id_denunciado INTEGER,
        CONSTRAINT fk_denuncia FOREIGN KEY (denuncia) REFERENCES motivos_denuncia(id_motivo) ON DELETE CASCADE,
        CONSTRAINT fk_denunciante FOREIGN KEY (id_denunciante) REFERENCES usuario(id_usuario) ON DELETE CASCADE,
        CONSTRAINT fk_denunciado FOREIGN KEY (id_denunciado) REFERENCES usuario(id_usuario) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS resetsenha (
    id_reset SERIAL PRIMARY KEY,
    token varchar(255) not null,
    email VARCHAR(70),
    datahora TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP 
);
