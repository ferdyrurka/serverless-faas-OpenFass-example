CREATE TABLE users(
    user_id serial PRIMARY KEY,
    username VARCHAR (64) UNIQUE NOT NULL,
    created_at INTEGER (128) NOT NULL
);