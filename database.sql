CREATE DATABASE IF NOT EXISTS si_hibah_lp2m CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE si_hibah_lp2m;
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS proposals; DROP TABLE IF EXISTS periods; DROP TABLE IF EXISTS schemes; DROP TABLE IF EXISTS users; DROP TABLE IF EXISTS roles;
SET FOREIGN_KEY_CHECKS=1;
CREATE TABLE roles(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(50) UNIQUE NOT NULL,description VARCHAR(255)) ENGINE=InnoDB;
CREATE TABLE users(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,role_id INT UNSIGNED NOT NULL,name VARCHAR(150) NOT NULL,email VARCHAR(150) UNIQUE NOT NULL,password VARCHAR(255) NOT NULL,is_active TINYINT(1) DEFAULT 1,last_login DATETIME NULL,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,FOREIGN KEY(role_id) REFERENCES roles(id)) ENGINE=InnoDB;
CREATE TABLE schemes(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,name VARCHAR(150) NOT NULL,type ENUM("Penelitian","Pengabdian") NOT NULL,max_fund DECIMAL(15,2) DEFAULT 0,description TEXT,is_active TINYINT(1) DEFAULT 1,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP) ENGINE=InnoDB;
CREATE TABLE periods(id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,year YEAR NOT NULL,wave VARCHAR(50) NOT NULL,start_date DATE NOT NULL,end_date DATE NOT NULL,status ENUM("Aktif","Selesai","Belum Aktif") DEFAULT "Belum Aktif") ENGINE=InnoDB;
CREATE TABLE proposals(id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,user_id BIGINT UNSIGNED NOT NULL,scheme_id INT UNSIGNED NOT NULL,period_id INT UNSIGNED NOT NULL,title VARCHAR(255) NOT NULL,background TEXT,budget DECIMAL(15,2) DEFAULT 0,proposal_file VARCHAR(255),status ENUM("Draft","Menunggu Verifikasi","Menunggu Penilaian","Dinilai Reviewer","Diterima","Ditolak") DEFAULT "Draft",verification_note TEXT,created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,FOREIGN KEY(user_id) REFERENCES users(id),FOREIGN KEY(scheme_id) REFERENCES schemes(id),FOREIGN KEY(period_id) REFERENCES periods(id),INDEX(status),INDEX(user_id)) ENGINE=InnoDB;

INSERT INTO roles(name,description) VALUES
("Admin LP2M","Kelola seluruh data"),("Kepala LP2M","Penetapan dan laporan"),("Sekretaris LP2M","Verifikasi administrasi"),("Reviewer","Penilaian proposal"),("Dosen","Pengajuan proposal"),("Kaprodi","Melihat proposal");

INSERT INTO users(role_id,name,email,password,is_active) VALUES
(1,"Admin LP2M","admin@lp2m.umpapua.ac.id","$2y$12$W.XmRDvSKiq2zTJ/OYtidOaZciD7qPiHwIG3OTXHoL2qEiU.zHKHq",1),
(2,"Kepala LP2M","kepala@lp2m.umpapua.ac.id","$2y$12$v.QRVK5Kfa.GwpXF7nrQWuwqPGKdBSHimhc94Q1OfUxT.agUWRQcq",1),
(3,"Sekretaris LP2M","sekretaris@lp2m.umpapua.ac.id","$2y$12$uEz7DdMOrjj9lKKDzqGOEebTBU/M7jhfOAKwuTvhXBYnLc3FD.Mcq",1),
(4,"Reviewer 1","reviewer@umpapua.ac.id","$2y$12$yNRhfUGO3wBpNNAV23pSq.zjwt2JvO4l/NdSCW8djio3Gn7QeEEF2",1),
(5,"Dr. Ahmad, M.Kom","dosen@umpapua.ac.id","$2y$12$iqqc8yy4rfOq38eAsIXqTuK7VndIgpZL.I8jwvjbkpZ1aC/Ij43me",1),
(6,"Ketua Program Studi","kaprodi@umpapua.ac.id","$2y$12$8yKXNrG/XapULA.GG3CkguB2Lw1aQNPTAHNahATIWhvtWltx.jc5i",1);

INSERT INTO schemes(name,type,max_fund,description) VALUES
("Penelitian Fundamental","Penelitian",50000000,"Skema penelitian fundamental"),
("Penelitian Dosen Pemula","Penelitian",25000000,"Skema penelitian dosen pemula"),
("Pengabdian Masyarakat","Pengabdian",30000000,"Skema pengabdian masyarakat");
INSERT INTO periods(year,wave,start_date,end_date,status) VALUES
(2026,"Gelombang 1","2026-02-01","2026-03-31","Selesai"),
(2026,"Gelombang 2","2026-07-01","2026-08-31","Aktif");
INSERT INTO proposals(user_id,scheme_id,period_id,title,background,budget,status) VALUES
(5,1,2,"Pengembangan Sistem Informasi Akademik","Pengembangan sistem informasi untuk meningkatkan pelayanan akademik.",45000000,"Menunggu Verifikasi"),
(5,3,2,"Pemberdayaan Masyarakat Pesisir","Program pemberdayaan masyarakat pesisir melalui teknologi tepat guna.",28000000,"Menunggu Penilaian");
