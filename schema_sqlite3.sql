CREATE TABLE account (
	id TEXT PRIMARY KEY,
	server_uri TEXT NOT NULL,
	username TEXT,
	password TEXT
);

CREATE TABLE calendar (
	id TEXT PRIMARY KEY,
	account_id TEXT NOT NULL,
	name TEXT NOT NULL,
	uri TEXT NOT NULL
)