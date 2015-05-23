--
-- PostgreSQL database dump
--

-- Dumped from database version 9.3.6
-- Dumped by pg_dump version 9.3.6
-- Started on 2015-05-22 16:41:46

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- TOC entry 191 (class 3079 OID 11750)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2091 (class 0 OID 0)
-- Dependencies: 191
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 171 (class 1259 OID 17666)
-- Name: empresas; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE empresas (
    id integer NOT NULL,
    personas_id integer,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    created timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    modified timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.empresas OWNER TO visitas;

--
-- TOC entry 170 (class 1259 OID 17664)
-- Name: empresas_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE empresas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.empresas_id_seq OWNER TO visitas;

--
-- TOC entry 2092 (class 0 OID 0)
-- Dependencies: 170
-- Name: empresas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE empresas_id_seq OWNED BY empresas.id;


--
-- TOC entry 173 (class 1259 OID 17676)
-- Name: empresas_visitantes; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE empresas_visitantes (
    id integer NOT NULL,
    visitantes_id integer NOT NULL,
    empresas_id integer NOT NULL,
    created timestamp without time zone,
    usuario_creador character varying(30),
    modified timestamp without time zone,
    usuario_actualiza character varying(30),
    estado character(1)
);


ALTER TABLE public.empresas_visitantes OWNER TO visitas;

--
-- TOC entry 172 (class 1259 OID 17674)
-- Name: empresas_visitantes_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE empresas_visitantes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.empresas_visitantes_id_seq OWNER TO visitas;

--
-- TOC entry 2093 (class 0 OID 0)
-- Dependencies: 172
-- Name: empresas_visitantes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE empresas_visitantes_id_seq OWNED BY empresas_visitantes.id;


--
-- TOC entry 175 (class 1259 OID 17684)
-- Name: lugares; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE lugares (
    id integer NOT NULL,
    lugares_nombre character varying(250) DEFAULT NULL::character varying NOT NULL,
    lugares_piso character varying(10) DEFAULT NULL::character varying,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    created timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    modified timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.lugares OWNER TO visitas;

--
-- TOC entry 174 (class 1259 OID 17682)
-- Name: lugares_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE lugares_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lugares_id_seq OWNER TO visitas;

--
-- TOC entry 2094 (class 0 OID 0)
-- Dependencies: 174
-- Name: lugares_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE lugares_id_seq OWNED BY lugares.id;


--
-- TOC entry 177 (class 1259 OID 17696)
-- Name: motivos; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE motivos (
    id integer NOT NULL,
    motivos_descripcion character varying(250) DEFAULT NULL::character varying,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    created timestamp without time zone,
    estado character(1),
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    modified timestamp without time zone
);


ALTER TABLE public.motivos OWNER TO visitas;

--
-- TOC entry 176 (class 1259 OID 17694)
-- Name: motivos_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE motivos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.motivos_id_seq OWNER TO visitas;

--
-- TOC entry 2095 (class 0 OID 0)
-- Dependencies: 176
-- Name: motivos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE motivos_id_seq OWNED BY motivos.id;


--
-- TOC entry 178 (class 1259 OID 17705)
-- Name: perfiles; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE perfiles (
    id integer NOT NULL,
    perfil_nombre character varying(50),
    estado character(1),
    usuario_creador character varying(35),
    created timestamp without time zone,
    usuario_modifica character varying(35),
    modified timestamp without time zone
);


ALTER TABLE public.perfiles OWNER TO visitas;

--
-- TOC entry 180 (class 1259 OID 17712)
-- Name: personas; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE personas (
    id integer NOT NULL,
    persona_nombre character varying(50) DEFAULT NULL::character varying,
    persona_apepat character varying(50) DEFAULT NULL::character varying,
    persona_apemat character varying(50) DEFAULT NULL::character varying,
    persona_nombres character varying(150) DEFAULT NULL::character varying,
    tipodocumentos_id integer,
    documento_numero character varying(20) DEFAULT NULL::character varying,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    fecha_creacion timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    fecha_actualiza timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.personas OWNER TO visitas;

--
-- TOC entry 179 (class 1259 OID 17710)
-- Name: personas_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE personas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personas_id_seq OWNER TO visitas;

--
-- TOC entry 2096 (class 0 OID 0)
-- Dependencies: 179
-- Name: personas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE personas_id_seq OWNED BY personas.id;


--
-- TOC entry 182 (class 1259 OID 17727)
-- Name: tipodocumentos; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE tipodocumentos (
    id integer NOT NULL,
    tipodocumento_nombre character varying(15) DEFAULT NULL::character varying,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    fecha_creacion timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    fecha_actualiza timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.tipodocumentos OWNER TO visitas;

--
-- TOC entry 181 (class 1259 OID 17725)
-- Name: tipodocumentos_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE tipodocumentos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipodocumentos_id_seq OWNER TO visitas;

--
-- TOC entry 2097 (class 0 OID 0)
-- Dependencies: 181
-- Name: tipodocumentos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE tipodocumentos_id_seq OWNED BY tipodocumentos.id;


--
-- TOC entry 184 (class 1259 OID 17738)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE usuarios (
    id integer NOT NULL,
    nombre_usuario character varying(150),
    usuario character varying(35),
    clave character varying(40),
    perfiles_id integer,
    tipo_usuario character(1),
    mail_usuario character varying(150),
    usuario_creador character varying(35),
    created timestamp without time zone,
    usuario_modifica character varying(35),
    modified timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.usuarios OWNER TO visitas;

--
-- TOC entry 183 (class 1259 OID 17736)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuarios_id_seq OWNER TO visitas;

--
-- TOC entry 2098 (class 0 OID 0)
-- Dependencies: 183
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- TOC entry 186 (class 1259 OID 17746)
-- Name: visitantes; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE visitantes (
    id integer NOT NULL,
    personas_id integer,
    visitante_email character varying(150) DEFAULT NULL::character varying,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    created timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    modified timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.visitantes OWNER TO visitas;

--
-- TOC entry 185 (class 1259 OID 17744)
-- Name: visitantes_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE visitantes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visitantes_id_seq OWNER TO visitas;

--
-- TOC entry 2099 (class 0 OID 0)
-- Dependencies: 185
-- Name: visitantes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE visitantes_id_seq OWNED BY visitantes.id;


--
-- TOC entry 188 (class 1259 OID 17757)
-- Name: visitas; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE visitas (
    id integer NOT NULL,
    personal_id integer,
    lugares_id integer,
    motivos_id integer,
    visita_obervacion character varying(200) DEFAULT NULL::character varying,
    visita_detalle character varying(200) DEFAULT NULL::character varying,
    visita_fecha character(10) DEFAULT NULL::bpchar,
    visista_horaprogramada character(8) DEFAULT NULL::bpchar,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    created timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    modified timestamp without time zone,
    lugares_lugar_nombre character varying(250) NOT NULL,
    estado character(1)
);


ALTER TABLE public.visitas OWNER TO visitas;

--
-- TOC entry 187 (class 1259 OID 17755)
-- Name: visitas_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE visitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visitas_id_seq OWNER TO visitas;

--
-- TOC entry 2100 (class 0 OID 0)
-- Dependencies: 187
-- Name: visitas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE visitas_id_seq OWNED BY visitas.id;


--
-- TOC entry 190 (class 1259 OID 17774)
-- Name: visitavisitantes; Type: TABLE; Schema: public; Owner: visitas; Tablespace: 
--

CREATE TABLE visitavisitantes (
    id integer NOT NULL,
    visitas_id integer NOT NULL,
    visitantes_id integer NOT NULL,
    visita_horaingeso character(8) DEFAULT NULL::bpchar,
    visita_horasalida character(8) DEFAULT NULL::bpchar,
    usuario_creador character varying(30) DEFAULT NULL::character varying,
    fecha_creacion timestamp without time zone,
    usuario_actualiza character varying(30) DEFAULT NULL::character varying,
    fecha_actualiza timestamp without time zone,
    estado character(1)
);


ALTER TABLE public.visitavisitantes OWNER TO visitas;

--
-- TOC entry 189 (class 1259 OID 17772)
-- Name: visitavisitantes_id_seq; Type: SEQUENCE; Schema: public; Owner: visitas
--

CREATE SEQUENCE visitavisitantes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visitavisitantes_id_seq OWNER TO visitas;

--
-- TOC entry 2101 (class 0 OID 0)
-- Dependencies: 189
-- Name: visitavisitantes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: visitas
--

ALTER SEQUENCE visitavisitantes_id_seq OWNED BY visitavisitantes.id;


--
-- TOC entry 1882 (class 2604 OID 17669)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY empresas ALTER COLUMN id SET DEFAULT nextval('empresas_id_seq'::regclass);


--
-- TOC entry 1885 (class 2604 OID 17679)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY empresas_visitantes ALTER COLUMN id SET DEFAULT nextval('empresas_visitantes_id_seq'::regclass);


--
-- TOC entry 1886 (class 2604 OID 17687)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY lugares ALTER COLUMN id SET DEFAULT nextval('lugares_id_seq'::regclass);


--
-- TOC entry 1891 (class 2604 OID 17699)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY motivos ALTER COLUMN id SET DEFAULT nextval('motivos_id_seq'::regclass);


--
-- TOC entry 1895 (class 2604 OID 17715)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY personas ALTER COLUMN id SET DEFAULT nextval('personas_id_seq'::regclass);


--
-- TOC entry 1903 (class 2604 OID 17730)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY tipodocumentos ALTER COLUMN id SET DEFAULT nextval('tipodocumentos_id_seq'::regclass);


--
-- TOC entry 1907 (class 2604 OID 17741)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- TOC entry 1908 (class 2604 OID 17749)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitantes ALTER COLUMN id SET DEFAULT nextval('visitantes_id_seq'::regclass);


--
-- TOC entry 1912 (class 2604 OID 17760)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitas ALTER COLUMN id SET DEFAULT nextval('visitas_id_seq'::regclass);


--
-- TOC entry 1919 (class 2604 OID 17777)
-- Name: id; Type: DEFAULT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitavisitantes ALTER COLUMN id SET DEFAULT nextval('visitavisitantes_id_seq'::regclass);


--
-- TOC entry 2064 (class 0 OID 17666)
-- Dependencies: 171
-- Data for Name: empresas; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY empresas (id, personas_id, usuario_creador, created, usuario_actualiza, modified, estado) FROM stdin;
\.


--
-- TOC entry 2102 (class 0 OID 0)
-- Dependencies: 170
-- Name: empresas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('empresas_id_seq', 1, false);


--
-- TOC entry 2066 (class 0 OID 17676)
-- Dependencies: 173
-- Data for Name: empresas_visitantes; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY empresas_visitantes (id, visitantes_id, empresas_id, created, usuario_creador, modified, usuario_actualiza, estado) FROM stdin;
\.


--
-- TOC entry 2103 (class 0 OID 0)
-- Dependencies: 172
-- Name: empresas_visitantes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('empresas_visitantes_id_seq', 1, false);


--
-- TOC entry 2068 (class 0 OID 17684)
-- Dependencies: 175
-- Data for Name: lugares; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY lugares (id, lugares_nombre, lugares_piso, usuario_creador, created, usuario_actualiza, modified, estado) FROM stdin;
\.


--
-- TOC entry 2104 (class 0 OID 0)
-- Dependencies: 174
-- Name: lugares_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('lugares_id_seq', 1, false);


--
-- TOC entry 2070 (class 0 OID 17696)
-- Dependencies: 177
-- Data for Name: motivos; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY motivos (id, motivos_descripcion, usuario_creador, created, estado, usuario_actualiza, modified) FROM stdin;
\.


--
-- TOC entry 2105 (class 0 OID 0)
-- Dependencies: 176
-- Name: motivos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('motivos_id_seq', 1, false);


--
-- TOC entry 2071 (class 0 OID 17705)
-- Dependencies: 178
-- Data for Name: perfiles; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY perfiles (id, perfil_nombre, estado, usuario_creador, created, usuario_modifica, modified) FROM stdin;
\.


--
-- TOC entry 2073 (class 0 OID 17712)
-- Dependencies: 180
-- Data for Name: personas; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY personas (id, persona_nombre, persona_apepat, persona_apemat, persona_nombres, tipodocumentos_id, documento_numero, usuario_creador, fecha_creacion, usuario_actualiza, fecha_actualiza, estado) FROM stdin;
\.


--
-- TOC entry 2106 (class 0 OID 0)
-- Dependencies: 179
-- Name: personas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('personas_id_seq', 1, false);


--
-- TOC entry 2075 (class 0 OID 17727)
-- Dependencies: 182
-- Data for Name: tipodocumentos; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY tipodocumentos (id, tipodocumento_nombre, usuario_creador, fecha_creacion, usuario_actualiza, fecha_actualiza, estado) FROM stdin;
\.


--
-- TOC entry 2107 (class 0 OID 0)
-- Dependencies: 181
-- Name: tipodocumentos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('tipodocumentos_id_seq', 1, false);


--
-- TOC entry 2077 (class 0 OID 17738)
-- Dependencies: 184
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY usuarios (id, nombre_usuario, usuario, clave, perfiles_id, tipo_usuario, mail_usuario, usuario_creador, created, usuario_modifica, modified, estado) FROM stdin;
\.


--
-- TOC entry 2108 (class 0 OID 0)
-- Dependencies: 183
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('usuarios_id_seq', 1, false);


--
-- TOC entry 2079 (class 0 OID 17746)
-- Dependencies: 186
-- Data for Name: visitantes; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY visitantes (id, personas_id, visitante_email, usuario_creador, created, usuario_actualiza, modified, estado) FROM stdin;
\.


--
-- TOC entry 2109 (class 0 OID 0)
-- Dependencies: 185
-- Name: visitantes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('visitantes_id_seq', 1, false);


--
-- TOC entry 2081 (class 0 OID 17757)
-- Dependencies: 188
-- Data for Name: visitas; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY visitas (id, personal_id, lugares_id, motivos_id, visita_obervacion, visita_detalle, visita_fecha, visista_horaprogramada, usuario_creador, created, usuario_actualiza, modified, lugares_lugar_nombre, estado) FROM stdin;
\.


--
-- TOC entry 2110 (class 0 OID 0)
-- Dependencies: 187
-- Name: visitas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('visitas_id_seq', 1, false);


--
-- TOC entry 2083 (class 0 OID 17774)
-- Dependencies: 190
-- Data for Name: visitavisitantes; Type: TABLE DATA; Schema: public; Owner: visitas
--

COPY visitavisitantes (id, visitas_id, visitantes_id, visita_horaingeso, visita_horasalida, usuario_creador, fecha_creacion, usuario_actualiza, fecha_actualiza, estado) FROM stdin;
\.


--
-- TOC entry 2111 (class 0 OID 0)
-- Dependencies: 189
-- Name: visitavisitantes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: visitas
--

SELECT pg_catalog.setval('visitavisitantes_id_seq', 1, false);


--
-- TOC entry 1925 (class 2606 OID 17673)
-- Name: empresas_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY empresas
    ADD CONSTRAINT empresas_pkey PRIMARY KEY (id);


--
-- TOC entry 1927 (class 2606 OID 17681)
-- Name: empresas_visitantes_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY empresas_visitantes
    ADD CONSTRAINT empresas_visitantes_pkey PRIMARY KEY (id);


--
-- TOC entry 1931 (class 2606 OID 17704)
-- Name: motivos_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY motivos
    ADD CONSTRAINT motivos_pkey PRIMARY KEY (id);


--
-- TOC entry 1933 (class 2606 OID 17709)
-- Name: perfiles_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY perfiles
    ADD CONSTRAINT perfiles_pkey PRIMARY KEY (id);


--
-- TOC entry 1929 (class 2606 OID 17693)
-- Name: pk; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY lugares
    ADD CONSTRAINT pk PRIMARY KEY (id);


--
-- TOC entry 1935 (class 2606 OID 17724)
-- Name: pk_persona; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY personas
    ADD CONSTRAINT pk_persona PRIMARY KEY (id);


--
-- TOC entry 1937 (class 2606 OID 17735)
-- Name: pk_tipodocumento; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY tipodocumentos
    ADD CONSTRAINT pk_tipodocumento PRIMARY KEY (id);


--
-- TOC entry 1939 (class 2606 OID 17743)
-- Name: usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- TOC entry 1941 (class 2606 OID 17754)
-- Name: visitantes_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY visitantes
    ADD CONSTRAINT visitantes_pkey PRIMARY KEY (id);


--
-- TOC entry 1943 (class 2606 OID 17771)
-- Name: visitas_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY visitas
    ADD CONSTRAINT visitas_pkey PRIMARY KEY (id);


--
-- TOC entry 1945 (class 2606 OID 17783)
-- Name: visitavisitantes_pkey; Type: CONSTRAINT; Schema: public; Owner: visitas; Tablespace: 
--

ALTER TABLE ONLY visitavisitantes
    ADD CONSTRAINT visitavisitantes_pkey PRIMARY KEY (id);


--
-- TOC entry 1949 (class 2606 OID 17799)
-- Name: Ref_persona_to_tipodocumento; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY personas
    ADD CONSTRAINT "Ref_persona_to_tipodocumento" FOREIGN KEY (id) REFERENCES tipodocumentos(id);


--
-- TOC entry 1950 (class 2606 OID 17804)
-- Name: Ref_usuarios_to_perfiles; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT "Ref_usuarios_to_perfiles" FOREIGN KEY (id) REFERENCES perfiles(id);


--
-- TOC entry 1951 (class 2606 OID 17809)
-- Name: Ref_visitante_to_persona; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitantes
    ADD CONSTRAINT "Ref_visitante_to_persona" FOREIGN KEY (id) REFERENCES personas(id);


--
-- TOC entry 1953 (class 2606 OID 17819)
-- Name: Ref_visitas_to_lugares; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitas
    ADD CONSTRAINT "Ref_visitas_to_lugares" FOREIGN KEY (id) REFERENCES lugares(id);


--
-- TOC entry 1955 (class 2606 OID 17829)
-- Name: Ref_visitavisitantes_to_visitantes; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitavisitantes
    ADD CONSTRAINT "Ref_visitavisitantes_to_visitantes" FOREIGN KEY (id) REFERENCES visitantes(id);


--
-- TOC entry 1948 (class 2606 OID 17794)
-- Name: fk_empresas_evisitantes; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY empresas_visitantes
    ADD CONSTRAINT fk_empresas_evisitantes FOREIGN KEY (id) REFERENCES empresas(id);


--
-- TOC entry 1952 (class 2606 OID 17814)
-- Name: fk_motivos_visitas; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitas
    ADD CONSTRAINT fk_motivos_visitas FOREIGN KEY (id) REFERENCES motivos(id);


--
-- TOC entry 1946 (class 2606 OID 17784)
-- Name: fk_personas_empresas; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY empresas
    ADD CONSTRAINT fk_personas_empresas FOREIGN KEY (id) REFERENCES personas(id);


--
-- TOC entry 1947 (class 2606 OID 17789)
-- Name: fk_visitantes_evisitantes; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY empresas_visitantes
    ADD CONSTRAINT fk_visitantes_evisitantes FOREIGN KEY (id) REFERENCES visitantes(id);


--
-- TOC entry 1954 (class 2606 OID 17824)
-- Name: fk_visitas_visitantes; Type: FK CONSTRAINT; Schema: public; Owner: visitas
--

ALTER TABLE ONLY visitavisitantes
    ADD CONSTRAINT fk_visitas_visitantes FOREIGN KEY (id) REFERENCES visitas(id);


--
-- TOC entry 2090 (class 0 OID 0)
-- Dependencies: 5
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2015-05-22 16:41:47

--
-- PostgreSQL database dump complete
--

