CREATE TABLE users (
  user_id INTEGER PRIMARY KEY,
  user_name VARCHAR,
  user_username VARCHAR,
  user_password VARCHAR,
  user_email VARCHAR,
  user_phone INTEGER,
  user_description VARCHAR
);

-- All passwords are 1234 in SHA-1 format
INSERT INTO users VALUES (NULL, "ricardo ferreira", "ricardo", "rpassword", "ricardo@email.com", "915342522", "hello world!");
INSERT INTO users VALUES (NULL, NULL, "Filipe", "fpasswrod", NULL, NULL, NULL);
