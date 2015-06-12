/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     27/01/2015 16:22:55                          */
/*==============================================================*/


drop table if exists MENU_LEFTBAR;

drop table if exists MENU_TOP;

/*==============================================================*/
/* Table: MENU_LEFTBAR                                          */
/*==============================================================*/
create table MENU_LEFTBAR
(
   MENU_LEFTBAR_ID      int not null auto_increment,
   MENU_TOP_ID          int,
   MENU_LEFTBAR_NAMA    varchar(100),
   MENU_LEFTBAR_URUTAN  int,
   primary key (MENU_LEFTBAR_ID)
);

/*==============================================================*/
/* Table: MENU_TOP                                              */
/*==============================================================*/
create table MENU_TOP
(
   MENU_TOP_ID          int not null auto_increment,
   MENU_TOP_NAMA        varchar(100),
   MENU_TOP_URUTAN      int,
   primary key (MENU_TOP_ID)
);

alter table MENU_LEFTBAR add constraint FK_RELATIONSHIP_1 foreign key (MENU_TOP_ID)
      references MENU_TOP (MENU_TOP_ID) on delete restrict on update restrict;

