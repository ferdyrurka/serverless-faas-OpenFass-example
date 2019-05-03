CREATE TABLE log(
    log_id     serial primary key,
    message    text      not null,
    created_at TIMESTAMP not null
);