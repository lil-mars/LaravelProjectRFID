create table Cargo
(
    idCargo  int auto_increment
        primary key,
    nombre   varchar(45) null,
    flexible tinyint     null
);

create table Feriado
(
    idFeriado int auto_increment
        primary key,
    fecha     date        null,
    nombre    varchar(45) null
);

create table Profesion
(
    idProfesion int auto_increment
        primary key,
    nombre      varchar(45) not null
);

create table Rol
(
    idRol  int auto_increment
        primary key,
    nombre varchar(45) null
);

create table Empleado
(
    idEmpleado      int auto_increment
        primary key,
    idCargo         int          null,
    nombre          varchar(45)  not null,
    segundoNombre   varchar(45)  null,
    apellidoPaterno varchar(45)  not null,
    apellidoMaterno varchar(45)  null,
    estadoCivil     varchar(45)  null,
    activo          tinyint      null,
    genero          varchar(1)   null,
    celular         varchar(45)  null,
    numeroFijo      varchar(1)   null,
    fechaNacimiento date         null,
    ci              varchar(45)  not null,
    fotografia      varchar(45)  null,
    embarazada      tinyint      null,
    usuario         varchar(45)  null,
    password        varchar(255) null,
    idRol           int          not null,
    rfidCode        varchar(10)  null,
    working         tinyint      null,
    constraint fk_Empleado_Cargo
        foreign key (idCargo) references Cargo (idCargo),
    constraint fk_Empleado_Rol1
        foreign key (idRol) references Rol (idRol)
);

create table Asistencia
(
    idAsistencia   int auto_increment
        primary key,
    idEmpleado     int   null,
    fecha          date  null,
    horaEntrada    time  null,
    horaSalida     time  null,
    horasDeTrabajo float null,
    constraint fk_Asistencia_Empleado1
        foreign key (idEmpleado) references Empleado (idEmpleado)
            on delete cascade
);

create table Familiar
(
    idFamiliar      int auto_increment
        primary key,
    nombre          varchar(45) null,
    segundoNombre   varchar(45) null,
    apellidoPaterno varchar(45) null,
    apellidoMaterno varchar(45) null,
    idEmpleado      int         not null,
    ci              varchar(45) null,
    tipoRelacion    varchar(45) null,
    constraint fk_Familiar_Empleado1
        foreign key (idEmpleado) references Empleado (idEmpleado)
            on delete cascade
);

create table Profesion_has_Empleado
(
    idProfesion int not null,
    idEmpleado  int not null,
    id          int auto_increment
        primary key,
    constraint fk_Profesion_has_Empleado_Empleado1
        foreign key (idEmpleado) references Empleado (idEmpleado)
            on delete cascade,
    constraint fk_Profesion_has_Empleado_Profesion1
        foreign key (idProfesion) references Profesion (idProfesion)
            on delete cascade
);

create table Referencia
(
    idReferencia    int auto_increment
        primary key,
    nombre          varchar(45) not null,
    segundoNombre   varchar(45) null,
    apellidoPaterno varchar(45) not null,
    apellidoMaterno varchar(45) null,
    celular         varchar(45) not null,
    idEmpleado      int         null,
    constraint Referencia_Empleado_idEmpleado_fk
        foreign key (idEmpleado) references Empleado (idEmpleado)
            on delete cascade
);

create table Turno
(
    idTurno int auto_increment
        primary key,
    turno   varchar(45) null
);

create table Horario
(
    idHorario      int auto_increment
        primary key,
    idCargo        int   not null,
    idTurno        int   not null,
    horaEntrada    time  null,
    horaSalida     time  null,
    horasDeTrabajo float null,
    constraint fk_Horario_Cargo1
        foreign key (idCargo) references Cargo (idCargo),
    constraint fk_Horario_Turno1
        foreign key (idTurno) references Turno (idTurno)
);

create table Vacacion
(
    idVacacion  int auto_increment
        primary key,
    idEmpleado  int         not null,
    fechaFin    varchar(45) null,
    fechaInicio date        null,
    totalDias   int         null,
    constraint fk_Vacacion_Empleado1
        foreign key (idEmpleado) references Empleado (idEmpleado)
            on delete cascade
);


