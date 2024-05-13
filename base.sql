--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 15.4

-- Started on 2024-05-13 10:37:23 EAT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 220 (class 1259 OID 18213)
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 18220)
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 18280)
-- Name: client; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.client (
    id integer NOT NULL,
    numero integer
);


ALTER TABLE public.client OWNER TO "Kenny";

--
-- TOC entry 233 (class 1259 OID 18279)
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.client_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.client_id_seq OWNER TO "Kenny";

--
-- TOC entry 3705 (class 0 OID 0)
-- Dependencies: 233
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- TOC entry 226 (class 1259 OID 18245)
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 18244)
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- TOC entry 3706 (class 0 OID 0)
-- Dependencies: 225
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 224 (class 1259 OID 18237)
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 18228)
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 18227)
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO postgres;

--
-- TOC entry 3707 (class 0 OID 0)
-- Dependencies: 222
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- TOC entry 230 (class 1259 OID 18266)
-- Name: maison; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.maison (
    id integer NOT NULL,
    nom character varying(50),
    type integer,
    nbchambre integer,
    nbtoilette integer
);


ALTER TABLE public.maison OWNER TO "Kenny";

--
-- TOC entry 229 (class 1259 OID 18265)
-- Name: maison_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.maison_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.maison_id_seq OWNER TO "Kenny";

--
-- TOC entry 3708 (class 0 OID 0)
-- Dependencies: 229
-- Name: maison_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.maison_id_seq OWNED BY public.maison.id;


--
-- TOC entry 215 (class 1259 OID 18180)
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 18179)
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- TOC entry 3709 (class 0 OID 0)
-- Dependencies: 214
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 218 (class 1259 OID 18197)
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 18204)
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 18273)
-- Name: type; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.type (
    id integer NOT NULL,
    nom character varying(50),
    dure integer
);


ALTER TABLE public.type OWNER TO "Kenny";

--
-- TOC entry 231 (class 1259 OID 18272)
-- Name: type_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.type_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.type_id_seq OWNER TO "Kenny";

--
-- TOC entry 3710 (class 0 OID 0)
-- Dependencies: 231
-- Name: type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.type_id_seq OWNED BY public.type.id;


--
-- TOC entry 217 (class 1259 OID 18187)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 18186)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 3711 (class 0 OID 0)
-- Dependencies: 216
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 228 (class 1259 OID 18257)
-- Name: utilisateur; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.utilisateur (
    id integer NOT NULL,
    nom character varying(50),
    email character varying(100),
    mdp character varying(50),
    type integer DEFAULT 1
);


ALTER TABLE public.utilisateur OWNER TO "Kenny";

--
-- TOC entry 227 (class 1259 OID 18256)
-- Name: utilisateur_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.utilisateur_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.utilisateur_id_seq OWNER TO "Kenny";

--
-- TOC entry 3712 (class 0 OID 0)
-- Dependencies: 227
-- Name: utilisateur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.utilisateur_id_seq OWNED BY public.utilisateur.id;


--
-- TOC entry 3503 (class 2604 OID 18283)
-- Name: client id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- TOC entry 3497 (class 2604 OID 18248)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 3496 (class 2604 OID 18231)
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- TOC entry 3501 (class 2604 OID 18269)
-- Name: maison id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.maison ALTER COLUMN id SET DEFAULT nextval('public.maison_id_seq'::regclass);


--
-- TOC entry 3494 (class 2604 OID 18183)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 3502 (class 2604 OID 18276)
-- Name: type id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.type ALTER COLUMN id SET DEFAULT nextval('public.type_id_seq'::regclass);


--
-- TOC entry 3495 (class 2604 OID 18190)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3499 (class 2604 OID 18260)
-- Name: utilisateur id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id SET DEFAULT nextval('public.utilisateur_id_seq'::regclass);


--
-- TOC entry 3685 (class 0 OID 18213)
-- Dependencies: 220
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- TOC entry 3686 (class 0 OID 18220)
-- Dependencies: 221
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 3699 (class 0 OID 18280)
-- Dependencies: 234
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.client (id, numero) FROM stdin;
1	329435910
\.


--
-- TOC entry 3691 (class 0 OID 18245)
-- Dependencies: 226
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- TOC entry 3689 (class 0 OID 18237)
-- Dependencies: 224
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- TOC entry 3688 (class 0 OID 18228)
-- Dependencies: 223
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- TOC entry 3695 (class 0 OID 18266)
-- Dependencies: 230
-- Data for Name: maison; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.maison (id, nom, type, nbchambre, nbtoilette) FROM stdin;
1	Maison en centre ville	1	1	1
2	Appartement de Luxe	2	4	3
3	Chalet Montagnard	3	2	1
4	Maison de Ville Historique	4	2	1
\.


--
-- TOC entry 3680 (class 0 OID 18180)
-- Dependencies: 215
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
\.


--
-- TOC entry 3683 (class 0 OID 18197)
-- Dependencies: 218
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- TOC entry 3684 (class 0 OID 18204)
-- Dependencies: 219
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
OHoMbzWHXVC4ynntjRUA0MTAOM5S9rvzWzFZVwsi	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36	YTo0OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL29mZnJlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6InM1RHV6YTJFMUx4czdZSGJ1cUppenNiZWtxenVjRWtSdHVWdlB2a2oiO3M6NjoibnVtZXJvIjtzOjEwOiIwMzI5NDM1OTEwIjt9	1715585799
\.


--
-- TOC entry 3697 (class 0 OID 18273)
-- Dependencies: 232
-- Data for Name: type; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.type (id, nom, dure) FROM stdin;
1	Individuelle	1440
2	Appartement	720
3	Campagne	1200
4	Ville	960
\.


--
-- TOC entry 3682 (class 0 OID 18187)
-- Dependencies: 217
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3693 (class 0 OID 18257)
-- Dependencies: 228
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.utilisateur (id, nom, email, mdp, type) FROM stdin;
1	ken	ken@gmail.com	ken	1
\.


--
-- TOC entry 3713 (class 0 OID 0)
-- Dependencies: 233
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.client_id_seq', 2, true);


--
-- TOC entry 3714 (class 0 OID 0)
-- Dependencies: 225
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 3715 (class 0 OID 0)
-- Dependencies: 222
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- TOC entry 3716 (class 0 OID 0)
-- Dependencies: 229
-- Name: maison_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.maison_id_seq', 4, true);


--
-- TOC entry 3717 (class 0 OID 0)
-- Dependencies: 214
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 3, true);


--
-- TOC entry 3718 (class 0 OID 0)
-- Dependencies: 231
-- Name: type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.type_id_seq', 4, true);


--
-- TOC entry 3719 (class 0 OID 0)
-- Dependencies: 216
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- TOC entry 3720 (class 0 OID 0)
-- Dependencies: 227
-- Name: utilisateur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.utilisateur_id_seq', 5, true);


--
-- TOC entry 3519 (class 2606 OID 18226)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 3517 (class 2606 OID 18219)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 3536 (class 2606 OID 18285)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- TOC entry 3526 (class 2606 OID 18253)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3528 (class 2606 OID 18255)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 3524 (class 2606 OID 18243)
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- TOC entry 3521 (class 2606 OID 18235)
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3532 (class 2606 OID 18271)
-- Name: maison maison_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.maison
    ADD CONSTRAINT maison_pkey PRIMARY KEY (id);


--
-- TOC entry 3505 (class 2606 OID 18185)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 3511 (class 2606 OID 18203)
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- TOC entry 3514 (class 2606 OID 18210)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 3534 (class 2606 OID 18278)
-- Name: type type_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.type
    ADD CONSTRAINT type_pkey PRIMARY KEY (id);


--
-- TOC entry 3507 (class 2606 OID 18196)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 3509 (class 2606 OID 18194)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3530 (class 2606 OID 18262)
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id);


--
-- TOC entry 3522 (class 1259 OID 18236)
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- TOC entry 3512 (class 1259 OID 18212)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 3515 (class 1259 OID 18211)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


-- Completed on 2024-05-13 10:37:24 EAT

--
-- PostgreSQL database dump complete
--

create or replace view v_travauxprix as(
    select travaux.id,idtype,type.nom as type,travaux.nom,unite,quantite,prixunitaire ,(prixunitaire*quantite) as total
    from travaux
    join type on travaux.idtype = type.id
)
create or replace view v_maisonType as(
    select maison.id, maison.nom, maison.type as idtype,type.nom as type,maison.nbchambre,maison.nbtoilette, type.dure, sum(v_travauxprix.total) as total
    from maison
    join type on maison.type = type.id
    join v_travauxprix on type.id = v_travauxprix.idtype
    group by maison.id, maison.nom, maison.type, idtype,maison.nbchambre,maison.nbtoilette ,type.nom , type.dure
	order by total
)
