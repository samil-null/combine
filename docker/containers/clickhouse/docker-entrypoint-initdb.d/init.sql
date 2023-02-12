CREATE DATABASE IF NOT EXISTS combine;

DROP TABLE IF EXISTS combine.hits;

CREATE TABLE IF NOT EXISTS combine.hits
(
    id UUID,
    customer_id String,
    event_id UInt32,
    int_d Nested (keys String, values UInt64),
    str_d Nested (keys String, values String),
    arr_str_d Nested (keys String, values Array(String)),
    arr_int_d Nested (keys Array(String), values Array(UInt64)),
    sys_ts DateTime,
    c_ts DateTime
    )
    ENGINE = ReplacingMergeTree()
    PARTITION BY toYYYYMM(c_ts)
    ORDER BY id;

DROP TABLE IF EXISTS combine.customers;

CREATE TABLE IF NOT EXISTS combine.customers
(
    customer_id String,
    int_d Nested (keys String, values UInt64),
    str_d Nested (keys String, values String),
    arr_str_d Nested (keys String, values Array(String)),
    arr_int_d Nested (keys Array(String), values Array(UInt64)),
    version UInt64
    )
    ENGINE = ReplacingMergeTree(version)
    ORDER BY customer_id;
