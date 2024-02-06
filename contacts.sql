CREATE TABLE contacts(name VARCHAR(50)NOT NULL UNIQUE,mobile_no VARCHAR(10)NOT NULL UNIQUE,email VARCHAR(25));
INSERT INTO contacts VALUES ("DHANUSH",7680059900,"dhanushnamala30@gmail.com");
INSERT INTO contacts VALUES ("SANTHAN",1234567890,"kothasanthan@gmail.com");
INSERT INTO contacts VALUES ("ANJUM",0987654321,"ANJUM_KAUSAR@gmail.com");
INSERT INTO contacts VALUES ("SURYA TEJA",1234509876,"surya_teja@gmail.com");
SELECT *FROM contacts WHERE name LIKE 'a%';
