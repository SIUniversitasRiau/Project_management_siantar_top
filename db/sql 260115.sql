/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     26/01/2015 19:43:20                          */
/*==============================================================*/


drop table if exists DEPARTEMEN;

drop table if exists DETAIL_ANALISA;

drop table if exists DETAIL_PEKERJAAN;

drop table if exists HAK_AKSES;

drop table if exists JABATAN;

drop table if exists KATEGORI_BARANG;

drop table if exists KATEGORI_PAKET_PEKERJAAN;

drop table if exists LOG_ACTIVITY;

drop table if exists MASTER_ANALISA;

drop table if exists MASTER_BARANG;

drop table if exists MASTER_UPAH;

drop table if exists MODULES;

drop table if exists NOTIFIKASI;

drop table if exists OVERHEAD;

drop table if exists PENGGUNA;

drop table if exists POSISI;

drop table if exists POSISI_PENGGUNA;

drop table if exists RAB_DESIGN;

drop table if exists RAB_STATUS_APPROVAL;

drop table if exists RAB_TRANSACTION;

drop table if exists SATUAN_BARANG;

drop table if exists SATUAN_UPAH;

drop table if exists SUBCON;

drop table if exists VALIDASI;

/*==============================================================*/
/* Table: DEPARTEMEN                                            */
/*==============================================================*/
create table DEPARTEMEN
(
   DEPARTEMEN_ID        int not null auto_increment,
   DEPARTEMEN_NAMA      varchar(100),
   primary key (DEPARTEMEN_ID)
);

/*==============================================================*/
/* Table: DETAIL_ANALISA                                        */
/*==============================================================*/
create table DETAIL_ANALISA
(
   DETAIL_ANALISA_ID    int not null auto_increment,
   BARANG_ID            int,
   UPAH_ID              int,
   ANALISA_ID           int,
   DETAIL_ANALISA_KOEFISIEN varchar(100),
   DETAIL_ANALISA_HARGA varchar(100),
   DETAIL_ANALISA_TOTAL varchar(100),
   primary key (DETAIL_ANALISA_ID)
);

/*==============================================================*/
/* Table: DETAIL_PEKERJAAN                                      */
/*==============================================================*/
create table DETAIL_PEKERJAAN
(
   KATEGORI_PEKERJAAN_ID int,
   ANALISA_ID           int,
   RAB_ID               int,
   SUBCON_ID            int,
   DETAIL_PEKERJAAN_VOLUME varchar(100),
   DETAIL_PEKERJAAN_TOTAL varchar(100)
);

/*==============================================================*/
/* Table: HAK_AKSES                                             */
/*==============================================================*/
create table HAK_AKSES
(
   DEPARTEMEN_ID        int not null,
   POSISI_ID            int not null,
   MODULES_ID           int not null,
   primary key (DEPARTEMEN_ID, POSISI_ID, MODULES_ID)
);

/*==============================================================*/
/* Table: JABATAN                                               */
/*==============================================================*/
create table JABATAN
(
   DEPARTEMEN_ID        int not null,
   POSISI_ID            int not null,
   primary key (DEPARTEMEN_ID, POSISI_ID)
);

/*==============================================================*/
/* Table: KATEGORI_BARANG                                       */
/*==============================================================*/
create table KATEGORI_BARANG
(
   KATEGORI_BARANG_ID   int not null auto_increment,
   KATEGORI_BARANG_NAMA varchar(100),
   primary key (KATEGORI_BARANG_ID)
);

/*==============================================================*/
/* Table: KATEGORI_PAKET_PEKERJAAN                              */
/*==============================================================*/
create table KATEGORI_PAKET_PEKERJAAN
(
   KATEGORI_PEKERJAAN_ID int not null auto_increment,
   KAT_KATEGORI_PEKERJAAN_ID int,
   KATEGORI_PEKERJAAN_NAMA varchar(100),
   primary key (KATEGORI_PEKERJAAN_ID)
);

/*==============================================================*/
/* Table: LOG_ACTIVITY                                          */
/*==============================================================*/
create table LOG_ACTIVITY
(
   LOG_ID               int not null auto_increment,
   LOG_NAME             varchar(1000),
   LOG_DETAIL           text,
   LOG_DATE             timestamp,
   LOG_MODEL            varchar(100),
   primary key (LOG_ID)
);

/*==============================================================*/
/* Table: MASTER_ANALISA                                        */
/*==============================================================*/
create table MASTER_ANALISA
(
   ANALISA_ID           int not null auto_increment,
   SATUAN_NAMA          varchar(100),
   ANALISA_KODE         varchar(100),
   ANALISA_NAMA         varchar(1000),
   ANALISA_TOTAL        varchar(100),
   primary key (ANALISA_ID)
);

/*==============================================================*/
/* Table: MASTER_BARANG                                         */
/*==============================================================*/
create table MASTER_BARANG
(
   BARANG_ID            int not null auto_increment,
   KATEGORI_BARANG_ID   int,
   SATUAN_NAMA          varchar(100),
   BARANG_KODE          varchar(100),
   BARANG_NAMA          varchar(1000),
   BARANG_KETERANGAN    text,
   BARANG_HARGA         varchar(100),
   primary key (BARANG_ID)
);

/*==============================================================*/
/* Table: MASTER_UPAH                                           */
/*==============================================================*/
create table MASTER_UPAH
(
   UPAH_ID              int not null auto_increment,
   SATUAN_UPAH_ID       int,
   UPAH_KODE            varchar(100),
   UPAH_NAMA            varchar(1000),
   UPAH_HARGA           varchar(100),
   primary key (UPAH_ID)
);

/*==============================================================*/
/* Table: MODULES                                               */
/*==============================================================*/
create table MODULES
(
   MODULES_ID           int not null auto_increment,
   MODULES_NAMA         varchar(100),
   primary key (MODULES_ID)
);

/*==============================================================*/
/* Table: NOTIFIKASI                                            */
/*==============================================================*/
create table NOTIFIKASI
(
   PENGGUNA_ID          int not null,
   RAB_ID               int not null,
   primary key (PENGGUNA_ID, RAB_ID)
);

/*==============================================================*/
/* Table: OVERHEAD                                              */
/*==============================================================*/
create table OVERHEAD
(
   OVERHEAD_ID          int not null auto_increment,
   SATUAN_NAMA          varchar(100),
   RAB_ID               int,
   OVERHEAD_NAMA        varchar(500),
   OVEHEAD_HARGA_SATUAN varchar(100),
   OVERHEAD_VOLUME      varchar(100),
   primary key (OVERHEAD_ID)
);

/*==============================================================*/
/* Table: PENGGUNA                                              */
/*==============================================================*/
create table PENGGUNA
(
   PENGGUNA_ID          int not null auto_increment,
   PENGGUNA_NAMA        varchar(1000),
   PENGGUNA_USERNAME    varchar(1000),
   PENGGUNA_PASSWORD    varchar(1000),
   PENGGUNA_EMAIL       varchar(1000),
   PENGGUNA_HP          varchar(100),
   PENGGUNA_ACTIVE      int,
   PENGGUNA_DAFTAR      timestamp,
   primary key (PENGGUNA_ID)
);

/*==============================================================*/
/* Table: POSISI                                                */
/*==============================================================*/
create table POSISI
(
   POSISI_ID            int not null auto_increment,
   POSISI_NAMA          varchar(100),
   primary key (POSISI_ID)
);

/*==============================================================*/
/* Table: POSISI_PENGGUNA                                       */
/*==============================================================*/
create table POSISI_PENGGUNA
(
   DEPARTEMEN_ID        int not null,
   POSISI_ID            int not null,
   PENGGUNA_ID          int not null,
   primary key (DEPARTEMEN_ID, POSISI_ID, PENGGUNA_ID)
);

/*==============================================================*/
/* Table: RAB_DESIGN                                            */
/*==============================================================*/
create table RAB_DESIGN
(
   RAB_DESIGN_ID        int not null auto_increment,
   RAB_ID               int,
   RAB_DESIGN_NAME      varchar(1000),
   RAB_DESIGN_URL       varchar(2000),
   RAB_DESIGN_DESC      text,
   primary key (RAB_DESIGN_ID)
);

/*==============================================================*/
/* Table: RAB_STATUS_APPROVAL                                   */
/*==============================================================*/
create table RAB_STATUS_APPROVAL
(
   RAB_STATUS_APPROVAL_ID int not null auto_increment,
   RAB_STATUS_APPROVAL_NAMA varchar(1000),
   primary key (RAB_STATUS_APPROVAL_ID)
);

/*==============================================================*/
/* Table: RAB_TRANSACTION                                       */
/*==============================================================*/
create table RAB_TRANSACTION
(
   RAB_ID               int not null auto_increment,
   RAB_STATUS_APPROVAL_ID int,
   PENGGUNA_ID          int,
   RAB_NAMA             varchar(500),
   RAB_URL              varchar(2000),
   RAB_TOTAL            varchar(100),
   RAB_AFTER_OVERHEAD   varchar(100),
   RAB_ACTIVE           int,
   RAB_CREATE           timestamp,
   primary key (RAB_ID)
);

/*==============================================================*/
/* Table: SATUAN_BARANG                                         */
/*==============================================================*/
create table SATUAN_BARANG
(
   SATUAN_NAMA          varchar(100) not null,
   primary key (SATUAN_NAMA)
);

/*==============================================================*/
/* Table: SATUAN_UPAH                                           */
/*==============================================================*/
create table SATUAN_UPAH
(
   SATUAN_UPAH_ID       int not null auto_increment,
   SATUAN_UPAH_NAMA     varchar(100),
   primary key (SATUAN_UPAH_ID)
);

/*==============================================================*/
/* Table: SUBCON                                                */
/*==============================================================*/
create table SUBCON
(
   SUBCON_ID            int not null auto_increment,
   SATUAN_NAMA          varchar(100),
   SUBCON_NAMA          varchar(1000),
   SUBCON_HARGA         varchar(100),
   SUBCON_KETERANGAN    text,
   primary key (SUBCON_ID)
);

/*==============================================================*/
/* Table: VALIDASI                                              */
/*==============================================================*/
create table VALIDASI
(
   RAB_ID               int not null,
   PENGGUNA_ID          int not null,
   VALIDASI_TANGGAL     timestamp,
   primary key (RAB_ID, PENGGUNA_ID)
);

alter table DETAIL_ANALISA add constraint FK_RELATIONSHIP_14 foreign key (ANALISA_ID)
      references MASTER_ANALISA (ANALISA_ID) on delete restrict on update restrict;

alter table DETAIL_ANALISA add constraint FK_RELATIONSHIP_27 foreign key (UPAH_ID)
      references MASTER_UPAH (UPAH_ID) on delete restrict on update restrict;

alter table DETAIL_ANALISA add constraint FK_RELATIONSHIP_30 foreign key (BARANG_ID)
      references MASTER_BARANG (BARANG_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_12 foreign key (RAB_ID)
      references RAB_TRANSACTION (RAB_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_13 foreign key (KATEGORI_PEKERJAAN_ID)
      references KATEGORI_PAKET_PEKERJAAN (KATEGORI_PEKERJAAN_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_31 foreign key (ANALISA_ID)
      references MASTER_ANALISA (ANALISA_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_32 foreign key (SUBCON_ID)
      references SUBCON (SUBCON_ID) on delete restrict on update restrict;

alter table HAK_AKSES add constraint FK_RELATIONSHIP_8 foreign key (DEPARTEMEN_ID, POSISI_ID)
      references JABATAN (DEPARTEMEN_ID, POSISI_ID) on delete restrict on update restrict;

alter table HAK_AKSES add constraint FK_RELATIONSHIP_9 foreign key (MODULES_ID)
      references MODULES (MODULES_ID) on delete restrict on update restrict;

alter table JABATAN add constraint FK_RELATIONSHIP_2 foreign key (DEPARTEMEN_ID)
      references DEPARTEMEN (DEPARTEMEN_ID) on delete restrict on update restrict;

alter table JABATAN add constraint FK_RELATIONSHIP_3 foreign key (POSISI_ID)
      references POSISI (POSISI_ID) on delete restrict on update restrict;

alter table KATEGORI_PAKET_PEKERJAAN add constraint FK_RELATIONSHIP_18 foreign key (KAT_KATEGORI_PEKERJAAN_ID)
      references KATEGORI_PAKET_PEKERJAAN (KATEGORI_PEKERJAAN_ID) on delete restrict on update restrict;

alter table MASTER_ANALISA add constraint FK_RELATIONSHIP_21 foreign key (SATUAN_NAMA)
      references SATUAN_BARANG (SATUAN_NAMA) on delete restrict on update restrict;

alter table MASTER_BARANG add constraint FK_RELATIONSHIP_19 foreign key (KATEGORI_BARANG_ID)
      references KATEGORI_BARANG (KATEGORI_BARANG_ID) on delete restrict on update restrict;

alter table MASTER_BARANG add constraint FK_RELATIONSHIP_20 foreign key (SATUAN_NAMA)
      references SATUAN_BARANG (SATUAN_NAMA) on delete restrict on update restrict;

alter table MASTER_UPAH add constraint FK_RELATIONSHIP_15 foreign key (SATUAN_UPAH_ID)
      references SATUAN_UPAH (SATUAN_UPAH_ID) on delete restrict on update restrict;

alter table NOTIFIKASI add constraint FK_RELATIONSHIP_16 foreign key (PENGGUNA_ID)
      references PENGGUNA (PENGGUNA_ID) on delete restrict on update restrict;

alter table NOTIFIKASI add constraint FK_RELATIONSHIP_17 foreign key (RAB_ID)
      references RAB_TRANSACTION (RAB_ID) on delete restrict on update restrict;

alter table OVERHEAD add constraint FK_RELATIONSHIP_25 foreign key (RAB_ID)
      references RAB_TRANSACTION (RAB_ID) on delete restrict on update restrict;

alter table OVERHEAD add constraint FK_RELATIONSHIP_26 foreign key (SATUAN_NAMA)
      references SATUAN_BARANG (SATUAN_NAMA) on delete restrict on update restrict;

alter table POSISI_PENGGUNA add constraint FK_RELATIONSHIP_5 foreign key (PENGGUNA_ID)
      references PENGGUNA (PENGGUNA_ID) on delete restrict on update restrict;

alter table POSISI_PENGGUNA add constraint FK_RELATIONSHIP_6 foreign key (DEPARTEMEN_ID, POSISI_ID)
      references JABATAN (DEPARTEMEN_ID, POSISI_ID) on delete restrict on update restrict;

alter table RAB_DESIGN add constraint FK_RELATIONSHIP_23 foreign key (RAB_ID)
      references RAB_TRANSACTION (RAB_ID) on delete restrict on update restrict;

alter table RAB_TRANSACTION add constraint FK_ESTIMATOR foreign key (PENGGUNA_ID)
      references PENGGUNA (PENGGUNA_ID) on delete restrict on update restrict;

alter table RAB_TRANSACTION add constraint FK_RELATIONSHIP_24 foreign key (RAB_STATUS_APPROVAL_ID)
      references RAB_STATUS_APPROVAL (RAB_STATUS_APPROVAL_ID) on delete restrict on update restrict;

alter table SUBCON add constraint FK_RELATIONSHIP_22 foreign key (SATUAN_NAMA)
      references SATUAN_BARANG (SATUAN_NAMA) on delete restrict on update restrict;

alter table VALIDASI add constraint FK_RELATIONSHIP_28 foreign key (RAB_ID)
      references RAB_TRANSACTION (RAB_ID) on delete restrict on update restrict;

alter table VALIDASI add constraint FK_RELATIONSHIP_29 foreign key (PENGGUNA_ID)
      references PENGGUNA (PENGGUNA_ID) on delete restrict on update restrict;

