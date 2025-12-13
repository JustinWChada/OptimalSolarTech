CREATE TABLE privileged_users (
    user_email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO privileged_users (user_email, password) VALUES ('chadajustin@gmail.com', '');
