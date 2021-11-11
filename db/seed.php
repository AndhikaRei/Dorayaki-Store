<?php

// Import requirement.
require_once __DIR__."/config.php";

// Seed account table.
$pw_1 = password_hash("reyemyr", PASSWORD_DEFAULT);
$db->query('INSERT INTO `Akun` (
        `email`, 
        `username`, 
        `password`,
        `is_admin`
    ) VALUES (
        "reyemyr@dorayummy.com",
        "reyemyr",
        "'.$pw_1.'",
        1
)');

$pw_2 = password_hash("gdeanantha", PASSWORD_DEFAULT);
$db->query('INSERT INTO `Akun` (
        `email`, 
        `username`, 
        `password`
    ) VALUES (
        "gdeanantha@dorayummy.com",
        "gdeanantha",
        "'.$pw_2.'"
)');

$pw_3 = password_hash("andhikarei", PASSWORD_DEFAULT);
$db->query('INSERT INTO `Akun` (
        `email`, 
        `username`, 
        `password`
    ) VALUES (
        "andhikarei@dorayummy.com",
        "andhikarei",
        "'.$pw_3.'"
)');

// Seed Dorayaki table.
$db->query('INSERT INTO `Dorayaki` (
    `nama`, 
    `deskripsi`, 
    `harga`, 
    `url_gambar`, 
    `stok`
) VALUES (
    "Dorayaki Original", 
    "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang direkatkan dengan selai kacang merah. Ori Ngab!", 
    10000, 
    "dorayakiOriginal.jpg",
    50
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Coklat", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang direkatkan dengan selai coklat.", 
        12000, 
        "dorayakiCoklat.jpg",
        50
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Keju", 
        "Kue tradisional Jepang yang dibuat dengan pancake yang direkatkan dengan selai keju dan parutan keju cheddar.", 
        12000, 
        "dorayakiKeju.jpg",
        50
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Greentea Coklat", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake rasa Greentea yang direkatkan dengan selai coklat.", 
        15000, 
        "dorayakiGreenteaCoklat.jpg",
        50
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Milo", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang direkatkan dengan selai milo", 
        13000, 
        "dorayakiMilo.jpg",
        50
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Oreo", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang diisi dengan oreo yang dipotong dadu.", 
        13000, 
        "dorayakiOreo.jpg",
        50
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Oreo isi Coklat", 
        "Kue tradisional Jepang yang dibuat dengan  yang direkatkan dengan selai coklat dan diisi dengan oreo yang dipotong dadu. ", 
        18000, 
        "dorayakiOreoCoklat.jpg",
        30
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Coklat Keju", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang direkatkan dengan dua selai yaitu coklat dan keju.", 
        15000, 
        "dorayakiCoklatKeju.jpg",
        20
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Greentea", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang direkatkan dengan selai greentea", 
        15000, 
        "dorayakiGreentea.jpg",
        20
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Toblerone", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake yang direkatkan dengan selai toblerone classic", 
        100000, 
        "dorayakiToblerone.jpg",
        10
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Red Velvet", 
        "Kue tradisional Jepang yang dibuat dengan dua lembar pancake berwarna merah yang direkatkan dengan selai red velvet", 
        20000, 
        "dorayakiRedVelvet.jpg",
        10
)');

$db->query('INSERT INTO `Dorayaki` (
        `nama`, 
        `deskripsi`, 
        `harga`, 
        `url_gambar`, 
        `stok`
    ) VALUES (
        "Dorayaki Doraemon", 
        "Kue tradisional Jepang yang diimpor langsung dari rumah nobita dan dibuat dengan cinta kasih shizuka", 
        100000000, 
        "dorayakiDoraemon.jpg",
        100000
)');