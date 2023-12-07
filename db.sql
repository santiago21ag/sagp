CREATE TABLE users (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NULL DEFAULT NULL,
  email VARCHAR(255) NULL DEFAULT NULL,
  password VARCHAR(255) NULL DEFAULT NULL, 
  telefono INT(11) NULL DEFAULT NULL
);

INSERT INTO users ( name, email, password, telefono) VALUES ('Santiago', 'santiago.23.ag@gmail.com','123456',60992078);


CREATE TABLE persona (
  id INT(11) AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(40) NULL DEFAULT NULL,
  apellidos VARCHAR(40) NULL DEFAULT NULL,
  sexo CHAR(1) NULL DEFAULT NULL,
  direccion VARCHAR(80) NULL DEFAULT NULL,
  id_user INT(11) NULL DEFAULT NULL,
  FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO persona (nombre, apellidos, sexo, direccion,id_user) VALUES ('Santiago', 'Arteaga Guzman','M','3er Anillo externo, Zona alto San Pedro',1);
