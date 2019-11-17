create table agencia
(
    idAgencia int auto_increment
        primary key,
    nombre    varchar(20) null,
    constraint nombre
        unique (nombre)
);

create table agenteTuristico
(
    idAgenteTuristico int auto_increment
        primary key,
    idAgencia         int         not null,
    ciUsuario         varchar(15) null,
    primerNombre      varchar(15) not null,
    segundoNombre     varchar(15) null,
    apellidoPaterno   varchar(15) not null,
    apellidoMaterno   varchar(15) null,
    activo            tinyint(1)  not null,
    constraint ciUsuario
        unique (ciUsuario),
    constraint agenteTuristico_ibfk_1
        foreign key (idAgencia) references agencia (idAgencia)
            on update cascade on delete cascade
);

create index idAgencia
    on agenteTuristico (idAgencia);

create table cache
(
    `key`      varchar(255) not null,
    value      mediumtext   not null,
    expiration int          not null,
    constraint cache_key_unique
        unique (`key`)
)
    collate = utf8mb4_unicode_ci;

create table categoria
(
    idCategoria int auto_increment
        primary key,
    nombre      varchar(20) null,
    constraint nombre
        unique (nombre)
);

create table departamento
(
    idDepartamento int auto_increment
        primary key,
    nombre         varchar(20) null,
    constraint nombre
        unique (nombre)
);

create table hotel
(
    idHotel        int auto_increment
        primary key,
    idDepartamento int          not null,
    nombre         varchar(20)  null,
    telefono       int          not null,
    direccion      varchar(120) null,
    constraint nombre
        unique (nombre),
    constraint hotel_ibfk_1
        foreign key (idDepartamento) references departamento (idDepartamento)
            on update cascade on delete cascade
);

create table cliente
(
    idCliente       int auto_increment
        primary key,
    idHotel         int             not null,
    usuario         varchar(15)     not null,
    pass            varchar(255)    not null,
    ci              varchar(15)     null,
    primerNombre    varchar(15)     not null,
    segundoNombre   varchar(15)     null,
    apellidoPaterno varchar(15)     not null,
    apellidoMaterno varchar(15)     null,
    telefono        int             not null,
    genero          enum ('F', 'M') not null,
    fechaNacimiento date            not null,
    activo          tinyint(1)      not null,
    constraint ci
        unique (ci),
    constraint cliente_ibfk_1
        foreign key (idHotel) references hotel (idHotel)
            on update cascade on delete cascade
);

create index idHotel
    on cliente (idHotel);

create table historialHotel
(
    idHistorialHotel int auto_increment
        primary key,
    idHotel          int        not null,
    idCategoria      int        not null,
    fechaInicio      date       not null,
    fechaFin         date       null,
    observaciones    text       not null,
    activo           tinyint(1) not null,
    constraint historialHotel_ibfk_1
        foreign key (idHotel) references hotel (idHotel)
            on update cascade on delete cascade,
    constraint historialHotel_ibfk_2
        foreign key (idCategoria) references categoria (idCategoria)
            on update cascade on delete cascade
);

create index idCategoria
    on historialHotel (idCategoria);

create index idHotel
    on historialHotel (idHotel);

create index idDepartamento
    on hotel (idDepartamento);

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on password_resets (email);

create table rol
(
    idRol  int auto_increment
        primary key,
    nombre varchar(20) null,
    constraint nombre
        unique (nombre)
);

create table table1
(
    name varchar(45) null
);

create table tipoHabitacion
(
    idTipoHabitacion int auto_increment
        primary key,
    nombre           varchar(20) null,
    constraint nombre
        unique (nombre)
);

create table habitacion
(
    idHabitacion     int auto_increment
        primary key,
    idHotel          int         not null,
    idTipoHabitacion int         not null,
    nombre           varchar(15) null,
    precio           float       not null,
    descripcion      blob        null,
    constraint nombre
        unique (nombre),
    constraint habitacion_ibfk_1
        foreign key (idTipoHabitacion) references tipoHabitacion (idTipoHabitacion)
            on update cascade on delete cascade,
    constraint habitacion_ibfk_2
        foreign key (idHotel) references hotel (idHotel)
            on update cascade on delete cascade
);

create index idHotel
    on habitacion (idHotel);

create index idTipoHabitacion
    on habitacion (idTipoHabitacion);

create table users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255) not null,
    email             varchar(255) not null,
    email_verified_at timestamp    null,
    password          varchar(255) not null,
    remember_token    varchar(100) null,
    created_at        timestamp    null,
    updated_at        timestamp    null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;

create table usuario
(
    idUsuario       int auto_increment
        primary key,
    idRol           int         not null,
    idHotel         int         not null,
    ciUsuario       varchar(15) null,
    primerNombre    varchar(15) not null,
    segundoNombre   varchar(15) null,
    apellidoPaterno varchar(15) not null,
    apellidoMaterno varchar(15) null,
    usuario         varchar(20) not null,
    contrasenia     varchar(20) not null,
    activo          tinyint(1)  not null,
    constraint ciUsuario
        unique (ciUsuario),
    constraint usuario_ibfk_1
        foreign key (idRol) references rol (idRol)
            on update cascade on delete cascade,
    constraint usuario_ibfk_2
        foreign key (idHotel) references hotel (idHotel)
            on update cascade on delete cascade
);

create table reserva
(
    idReserva         int auto_increment
        primary key,
    idHabitacion      int        not null,
    idUsuario         int        not null,
    idAgenteTuristico int        null,
    fechaInicio       date       not null,
    fechaFin          date       not null,
    montoTotal        float      not null,
    reservaPersonal   tinyint(1) not null,
    reservaOnline     tinyint(1) not null,
    activo            tinyint(1) not null,
    constraint reserva_ibfk_1
        foreign key (idHabitacion) references habitacion (idHabitacion)
            on update cascade on delete cascade,
    constraint reserva_ibfk_2
        foreign key (idUsuario) references usuario (idUsuario)
            on update cascade on delete cascade,
    constraint reserva_ibfk_3
        foreign key (idAgenteTuristico) references agenteTuristico (idAgenteTuristico)
            on update cascade on delete cascade
);

create table clienteReserva
(
    idReserva int        not null,
    idCliente int        not null,
    esTitular tinyint(1) not null,
    constraint clienteReserva_ibfk_1
        foreign key (idReserva) references reserva (idReserva)
            on update cascade on delete cascade,
    constraint clienteReserva_ibfk_2
        foreign key (idCliente) references cliente (idCliente)
            on update cascade on delete cascade
);

create index idCliente
    on clienteReserva (idCliente);

create index idReserva
    on clienteReserva (idReserva);

create index idAgenteTuristico
    on reserva (idAgenteTuristico);

create index idHabitacion
    on reserva (idHabitacion);

create index idUsuario
    on reserva (idUsuario);

create index idHotel
    on usuario (idHotel);

create index idRol
    on usuario (idRol);


