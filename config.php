<?php

function database_string() {
  extract(parse_url(getenv("DATABASE_URL")));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1);
}

$c->pg_connect[] = database_string();
