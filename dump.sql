CREATE TABLE users(
    user_id serial PRIMARY KEY,
    username VARCHAR (64) UNIQUE NOT NULL,
    created_at TIMESTAMP NOT NULL
);