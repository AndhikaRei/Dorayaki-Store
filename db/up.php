<?php

// Import requirement.
require_once __DIR__."/config.php";

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
  "harga" INTEGER NOT NULL CHECK(harga >= 0),
  "url_gambar" VARCHAR NOT NULL,
  "stok" INTEGER NOT NULL CHECK(stok >= 0) DEFAULT 0,
  "terjual" INTEGER NOT NULL CHECK(stok >= 0) DEFAULT 0
)');

// Create transaction table.
$db->query('CREATE TABLE IF NOT EXISTS "Transaksi" (
  "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
  "akun_id" INTEGER NOT NULL,
  "dorayaki_id" INTEGER NOT NULL,
  "dorayaki_nama" VARCHAR NOT NULL,
  "jumlah_item" INTEGER NOT NULL,
  "total_harga" INTEGER DEFAULT NULL,
  "category" VARCHAR NOT NULL,
  "tanggal" VARCHAR DEFAULT (date(\'now\', \'localtime\')),
  "waktu" VARCHAR DEFAULT (time(\'now\', \'localtime\')),
  FOREIGN KEY ("akun_id")
    REFERENCES "Akun"("id") 
      ON DELETE NO ACTION,
  FOREIGN KEY ("dorayaki_id")
    REFERENCES "Dorayaki"("id") 
      ON DELETE NO ACTION
)');

// Create tokens table.
$db->query('CREATE TABLE IF NOT EXISTS "Tokens" (
  "token" VARCHAR PRIMARY KEY NOT NULL,
  "user_id" INTEGER NOT NULL,
  "expire_date" TEXT NOT NULL
)');