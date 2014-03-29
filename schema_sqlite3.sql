CREATE TABLE account (
	id TEXT PRIMARY KEY,
	server_uri TEXT,
	username TEXT,
	password TEXT
);

CREATE TABLE calendar (
	id TEXT PRIMARY KEY,
	account_id TEXT,
	name TEXT,
	uri TEXT
)