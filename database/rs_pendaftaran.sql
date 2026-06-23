CREATE DATABASE IF NOT EXISTS rs_pendaftaran DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE rs_pendaftaran;

CREATE TABLE IF NOT EXISTS ci_sessions (
    id varchar(128) NOT NULL,
    ip_address varchar(45) NOT NULL,
    timestamp int(10) unsigned DEFAULT 0 NOT NULL,
    data blob NOT NULL,
    KEY ci_sessions_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS admin (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    nama varchar(100) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_admin_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS dokter (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    nama varchar(100) NOT NULL,
    spesialis varchar(100) NOT NULL,
    jadwal_hari varchar(100) DEFAULT NULL,
    jadwal_jam varchar(50) DEFAULT NULL,
    no_telepon varchar(20) DEFAULT NULL,
    status enum('aktif','nonaktif') DEFAULT 'aktif',
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pasien (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    nama varchar(100) NOT NULL,
    tanggal_lahir date NOT NULL,
    alamat text NOT NULL,
    nomor_telepon varchar(20) NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(255) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uq_pasien_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS pendaftaran (
    id int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    pasien_id int(11) UNSIGNED NOT NULL,
    dokter_id int(11) UNSIGNED NOT NULL,
    keluhan text NOT NULL,
    tanggal_kunjungan date NOT NULL,
    jam_kunjungan time NOT NULL,
    status enum('menunggu','disetujui','ditolak') DEFAULT 'menunggu',
    catatan_admin text DEFAULT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (pasien_id) REFERENCES pasien(id) ON DELETE CASCADE,
    FOREIGN KEY (dokter_id) REFERENCES dokter(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO admin (username, password, nama) VALUES
('admin', '$2y$10$o6x1n40uxwTwNwtF0c5Vp.pNpsoZfiZBIO25PZKNAWdHf44RKGfgq', 'Administrator');

INSERT INTO dokter (nama, spesialis, jadwal_hari, jadwal_jam, no_telepon) VALUES
('dr. Ahmad Rizky, Sp.PD', 'Penyakit Dalam', 'Senin, Rabu, Jumat', '08:00 - 14:00', '081234567890'),
('dr. Siti Aminah, Sp.A', 'Anak', 'Selasa, Kamis', '09:00 - 15:00', '081234567891'),
('dr. Budi Santoso, Sp.JP', 'Jantung & Pembuluh Darah', 'Senin, Kamis', '10:00 - 16:00', '081234567892'),
('dr. Dewi Lestari, Sp.OG', 'Kandungan', 'Rabu, Jumat', '08:00 - 13:00', '081234567893'),
('dr. Eko Prasetyo, Sp.M', 'Mata', 'Selasa, Sabtu', '09:00 - 14:00', '081234567894'),
('dr. Fitri Handayani, Sp.KK', 'Kulit & Kelamin', 'Senin, Rabu', '10:00 - 15:00', '081234567895'),
('dr. Gunawan, Sp.S', 'Saraf', 'Kamis, Sabtu', '08:00 - 13:00', '081234567896'),
('dr. Hana Pertiwi, Sp.THT', 'THT', 'Selasa, Jumat', '09:00 - 14:00', '081234567897');
