CREATE TABLE users (
  user_id INTEGER PRIMARY KEY,
  user_name VARCHAR,
  user_username VARCHAR,
  user_password VARCHAR,
  user_email VARCHAR,
  user_phone INTEGER,
  user_description VARCHAR,
  user_address VARCHAR,
  user_profilepic VARCHAR
);

CREATE TABLE category (
  category_id INTEGER PRIMARY KEY,
  category_name VARCHAR,
  user_id INTEGER REFERENCES users
);

CREATE TABLE todo (
  todo_id INTEGER PRIMARY KEY,
  todo_description VARCHAR,
  todo_lastUpdate VARCHAR,
  todo_deadline VARCHAR,
  todo_percentage BOOLEAN,
  category_id INTEGER REFERENCES category
);

/*
-- All passwords are 1234 in SHA-1 format
INSERT INTO users VALUES (NULL, "ricardo ferreira", "ricardo", "rpassword", "ricardo@email.com", "915342522", "hello world!");
INSERT INTO users VALUES (NULL, NULL, "Filipe", "fpasswrod", NULL, NULL, NULL);
*/
