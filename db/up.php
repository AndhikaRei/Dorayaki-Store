<?php

// Import requirement.
require_once __DIR__."config.php";

// Create account table.
$db->query('CREATE TABLE IF NOT EXISTS "Akun" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "email" VARCHAR NOT NULL,
  "username" VARCHAR UNIQUE NOT NULL,
  "password" VARCHAR NOT NULL,
  "is_admin" INTEGER NOT NULL CHECK (is_admin IN (0, 1)) DEFAULT 0
)');

// Create dorayaki table.
$db->query('CREATE TABLE IF NOT EXISTS "Dorayaki" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "nama" VARCHAR NOT NULL,
  "deskripsi" VARCHAR NOT NULL,
  "harga" INTEGER NOT NULL CHECK(harga > 0),
  "url_gambar" VARCHAR NOT NULL,
  "stok" INTEGER NOT NULL CHECK(stok > 0) DEFAULT 0
)');