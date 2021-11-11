<?php

// Import requirement.
require_once __DIR__."/config.php";

// Drop account table.
$db->query('DROP TABLE IF EXISTS "Akun"');

// Drop transaction table.
$db->query('DROP TABLE IF EXISTS "Transaksi"');

// Drop dorayaki table.
$db->query('DROP TABLE IF EXISTS "Dorayaki"');

// Drop tokens table.
$db->query('DROP TABLE IF EXISTS "Tokens"');
