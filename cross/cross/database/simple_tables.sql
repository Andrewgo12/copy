-- Tablas básicas para pruebas del sistema CROSS
USE crosshuvdb;

CREATE TABLE cliente (
    cliecodigos VARCHAR(30) NOT NULL PRIMARY KEY,
    clienombres VARCHAR(150),
    cliemails VARCHAR(100),
    clietelefons VARCHAR(13),
    clieactivas VARCHAR(1) DEFAULT 'A'
);

CREATE TABLE personal (
    perscodigos VARCHAR(30) NOT NULL PRIMARY KEY,
    persprinoms VARCHAR(20),
    perspriapes VARCHAR(30),
    persemail VARCHAR(100),
    perstelefons VARCHAR(13),
    persactivas VARCHAR(1) DEFAULT 'A'
);

CREATE TABLE organizacion (
    orgacodigos VARCHAR(30) NOT NULL PRIMARY KEY,
    organombres VARCHAR(100) NOT NULL,
    orgadescrips TEXT,
    orgaactivas VARCHAR(1) DEFAULT 'A'
);

CREATE TABLE orden (
    ordenumeros VARCHAR(30) NOT NULL PRIMARY KEY,
    ordenasuntos VARCHAR(200),
    ordendescrips TEXT,
    usuacodigos VARCHAR(30),
    orgacodigos VARCHAR(30),
    ordenactivas VARCHAR(1) DEFAULT 'A'
);

-- Insertar datos de prueba
INSERT INTO cliente (cliecodigos, clienombres, cliemails, clietelefons) VALUES
('CLI001', 'Juan Pérez', 'juan@email.com', '3001234567'),
('CLI002', 'María García', 'maria@email.com', '3007654321');

INSERT INTO personal (perscodigos, persprinoms, perspriapes, persemail, perstelefons) VALUES
('PER001', 'Carlos', 'López', 'carlos@empresa.com', '3009876543'),
('PER002', 'Ana', 'Martínez', 'ana@empresa.com', '3005432109');

INSERT INTO organizacion (orgacodigos, organombres, orgadescrips) VALUES
('ORG001', 'Departamento de Sistemas', 'Área encargada de tecnología'),
('ORG002', 'Atención al Cliente', 'Servicio al usuario');

INSERT INTO orden (ordenumeros, ordenasuntos, ordendescrips, usuacodigos, orgacodigos) VALUES
('ORD001', 'Solicitud de información', 'Cliente solicita información sobre servicios', 'PER001', 'ORG002'),
('ORD002', 'Reporte técnico', 'Problema con sistema informático', 'PER002', 'ORG001');