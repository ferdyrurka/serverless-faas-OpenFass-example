CREATE TABLE users(
    user_id serial PRIMARY KEY,
    username VARCHAR (64) UNIQUE NOT NULL,
    created_at TIMESTAMP NOT NULL
);

CREATE TABLE log(
    log_id     serial primary key,
    message    text      not null,
    created_at TIMESTAMP not null
);