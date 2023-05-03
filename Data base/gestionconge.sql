/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     7/23/2019 1:12:35 AM                         */
/*==============================================================*/


drop table if exists AGENT;

drop table if exists CONGE;

drop table if exists DIVITION;

drop table if exists SERVICE;

/*==============================================================*/
/* Table: AGENT                                                 */
/*==============================================================*/
create table AGENT
(
   MATRICULE            int not null,
   ID_SERVICE           int not null,
   NOM                  varchar(255),
   PRENOM               varchar(255),
   POST                 varchar(255),
   CATGORIE             varchar(255),
   primary key (MATRICULE)
);

/*==============================================================*/
/* Table: CONGE                                                 */
/*==============================================================*/
create table CONGE
(
   ID_CONGE             int not null,
   MATRICULE            int not null,
   DATE_DEBUT           date,
   DATE_FIN             date,
   SOLDE                int,
   primary key (ID_CONGE)
);

/*==============================================================*/
/* Table: DIVITION                                              */
/*==============================================================*/
create table DIVITION
(
   ID_DIVITION          int not null,
   NOM_DIVITION         varchar(255),
   primary key (ID_DIVITION)
);

/*==============================================================*/
/* Table: SERVICE                                               */
/*==============================================================*/
create table SERVICE
(
   ID_SERVICE           int not null,
   ID_DIVITION          int,
   NOM_SERVICE          varchar(255),
   primary key (ID_SERVICE)
);

alter table AGENT add constraint FK_TRAVAILLER foreign key (ID_SERVICE)
      references SERVICE (ID_SERVICE) on delete restrict on update restrict;

alter table CONGE add constraint FK_DEMANDER foreign key (MATRICULE)
      references AGENT (MATRICULE) on delete restrict on update restrict;

alter table SERVICE add constraint FK_AVOIR foreign key (ID_DIVITION)
      references DIVITION (ID_DIVITION) on delete restrict on update restrict;

