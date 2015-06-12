/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     27/01/2015 16:23:43                          */
/*==============================================================*/


drop table if exists DETAIL_PEKERJAAN;

drop table if exists KATEGORI_PAKET_PEKERJAAN;

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
   DETAIL_PEKERJAAN_TOTAL varchar(100),
   DETAIL_PEKERJAAN_URUTAN int
);

/*==============================================================*/
/* Table: KATEGORI_PAKET_PEKERJAAN                              */
/*==============================================================*/
create table KATEGORI_PAKET_PEKERJAAN
(
   KATEGORI_PEKERJAAN_ID int not null auto_increment,
   KAT_KATEGORI_PEKERJAAN_ID int,
   KATEGORI_PEKERJAAN_NAMA varchar(100),
   KATEGORI_PEKERAJAAN_URUTAN int,
   primary key (KATEGORI_PEKERJAAN_ID)
);

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_12 foreign key (RAB_ID)
      references RAB_TRANSACTION (RAB_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_13 foreign key (KATEGORI_PEKERJAAN_ID)
      references KATEGORI_PAKET_PEKERJAAN (KATEGORI_PEKERJAAN_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_31 foreign key (ANALISA_ID)
      references MASTER_ANALISA (ANALISA_ID) on delete restrict on update restrict;

alter table DETAIL_PEKERJAAN add constraint FK_RELATIONSHIP_32 foreign key (SUBCON_ID)
      references SUBCON (SUBCON_ID) on delete restrict on update restrict;

alter table KATEGORI_PAKET_PEKERJAAN add constraint FK_RELATIONSHIP_18 foreign key (KAT_KATEGORI_PEKERJAAN_ID)
      references KATEGORI_PAKET_PEKERJAAN (KATEGORI_PEKERJAAN_ID) on delete restrict on update restrict;

