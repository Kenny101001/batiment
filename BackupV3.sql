--
-- PostgreSQL database dump
--

-- Dumped from database version 15.4
-- Dumped by pg_dump version 15.4

-- Started on 2024-05-30 12:36:29 EAT

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
    numero character varying(60)
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
-- TOC entry 3816 (class 0 OID 0)
-- Dependencies: 233
-- Name: client_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.client_id_seq OWNED BY public.client.id;


--
-- TOC entry 238 (class 1259 OID 18303)
-- Name: devi; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.devi (
    id integer NOT NULL,
    dure integer,
    debut date,
    fin date,
    payer double precision DEFAULT 0,
    restant double precision,
    total double precision,
    type character varying(50),
    maison character varying(50),
    finition character varying(50),
    pourcentage double precision,
    totalpourcentage double precision,
    creation date,
    description character varying(100),
    lieu character varying(100),
    refdevis character varying(40),
    numclient character varying(100)
);


ALTER TABLE public.devi OWNER TO "Kenny";

--
-- TOC entry 237 (class 1259 OID 18302)
-- Name: devi_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.devi_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.devi_id_seq OWNER TO "Kenny";

--
-- TOC entry 3817 (class 0 OID 0)
-- Dependencies: 237
-- Name: devi_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.devi_id_seq OWNED BY public.devi.id;


--
-- TOC entry 250 (class 1259 OID 18449)
-- Name: devisimportationcsv; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.devisimportationcsv (
    id integer NOT NULL,
    client character varying(50),
    ref_devis character varying(50),
    finition character varying(50),
    taux_finition character varying(50),
    date_devis date,
    date_debut date,
    lieu character varying(100),
    type_maison character varying(100)
);


ALTER TABLE public.devisimportationcsv OWNER TO postgres;

--
-- TOC entry 249 (class 1259 OID 18448)
-- Name: devisimportationcsv_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.devisimportationcsv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.devisimportationcsv_id_seq OWNER TO postgres;

--
-- TOC entry 3818 (class 0 OID 0)
-- Dependencies: 249
-- Name: devisimportationcsv_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.devisimportationcsv_id_seq OWNED BY public.devisimportationcsv.id;


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
-- TOC entry 3819 (class 0 OID 0)
-- Dependencies: 225
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- TOC entry 236 (class 1259 OID 18295)
-- Name: finition; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.finition (
    id integer NOT NULL,
    nom character varying(50),
    pourcentage integer
);


ALTER TABLE public.finition OWNER TO "Kenny";

--
-- TOC entry 235 (class 1259 OID 18294)
-- Name: finition_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.finition_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.finition_id_seq OWNER TO "Kenny";

--
-- TOC entry 3820 (class 0 OID 0)
-- Dependencies: 235
-- Name: finition_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.finition_id_seq OWNED BY public.finition.id;


--
-- TOC entry 244 (class 1259 OID 18405)
-- Name: histoversement; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.histoversement (
    id integer NOT NULL,
    versement double precision,
    reste double precision,
    total double precision,
    date date,
    refdevis character varying(50),
    refpaiement character varying(50)
);


ALTER TABLE public.histoversement OWNER TO "Kenny";

--
-- TOC entry 243 (class 1259 OID 18404)
-- Name: histoversement_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.histoversement_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.histoversement_id_seq OWNER TO "Kenny";

--
-- TOC entry 3821 (class 0 OID 0)
-- Dependencies: 243
-- Name: histoversement_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.histoversement_id_seq OWNED BY public.histoversement.id;


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
-- TOC entry 3822 (class 0 OID 0)
-- Dependencies: 222
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- TOC entry 252 (class 1259 OID 18457)
-- Name: lieu; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.lieu (
    id integer NOT NULL,
    nom character varying(100)
);


ALTER TABLE public.lieu OWNER TO postgres;

--
-- TOC entry 251 (class 1259 OID 18456)
-- Name: lieu_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.lieu_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lieu_id_seq OWNER TO postgres;

--
-- TOC entry 3823 (class 0 OID 0)
-- Dependencies: 251
-- Name: lieu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.lieu_id_seq OWNED BY public.lieu.id;


--
-- TOC entry 230 (class 1259 OID 18266)
-- Name: maison; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.maison (
    id integer NOT NULL,
    nom character varying(50),
    description character varying,
    dure integer,
    surface integer
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
-- TOC entry 3824 (class 0 OID 0)
-- Dependencies: 229
-- Name: maison_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.maison_id_seq OWNED BY public.maison.id;


--
-- TOC entry 248 (class 1259 OID 18442)
-- Name: maisonimportationcsv; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.maisonimportationcsv (
    id integer NOT NULL,
    type_maison character varying(50),
    description character varying(50),
    surface integer,
    code_travaux character varying(50),
    unite character varying(50),
    prix_unitaire double precision,
    quantite double precision,
    duree_travaux integer,
    type_travaux character varying(100)
);


ALTER TABLE public.maisonimportationcsv OWNER TO postgres;

--
-- TOC entry 247 (class 1259 OID 18441)
-- Name: maisonimportationcsv_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.maisonimportationcsv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.maisonimportationcsv_id_seq OWNER TO postgres;

--
-- TOC entry 3825 (class 0 OID 0)
-- Dependencies: 247
-- Name: maisonimportationcsv_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.maisonimportationcsv_id_seq OWNED BY public.maisonimportationcsv.id;


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
-- TOC entry 3826 (class 0 OID 0)
-- Dependencies: 214
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- TOC entry 254 (class 1259 OID 18464)
-- Name: paiementimportationcsv; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.paiementimportationcsv (
    id integer NOT NULL,
    ref_devis character varying(50),
    ref_paiement character varying(50),
    date_paiement date,
    montant double precision
);


ALTER TABLE public.paiementimportationcsv OWNER TO postgres;

--
-- TOC entry 253 (class 1259 OID 18463)
-- Name: paiementinportationcsv_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.paiementinportationcsv_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.paiementinportationcsv_id_seq OWNER TO postgres;

--
-- TOC entry 3827 (class 0 OID 0)
-- Dependencies: 253
-- Name: paiementinportationcsv_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.paiementinportationcsv_id_seq OWNED BY public.paiementimportationcsv.id;


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
-- TOC entry 240 (class 1259 OID 18311)
-- Name: travaux; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.travaux (
    id integer NOT NULL,
    nom character varying(100),
    unite character varying(10),
    prixunitaire double precision,
    codetravaux character varying
);


ALTER TABLE public.travaux OWNER TO "Kenny";

--
-- TOC entry 242 (class 1259 OID 18351)
-- Name: travauxdevis; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.travauxdevis (
    id integer NOT NULL,
    iddevis integer NOT NULL,
    idtravaux integer,
    nom character varying(50),
    unite character varying(50),
    quantite double precision,
    prixunitaire double precision,
    total double precision
);


ALTER TABLE public.travauxdevis OWNER TO "Kenny";

--
-- TOC entry 241 (class 1259 OID 18350)
-- Name: travauxdevis_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.travauxdevis_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.travauxdevis_id_seq OWNER TO "Kenny";

--
-- TOC entry 3828 (class 0 OID 0)
-- Dependencies: 241
-- Name: travauxdevis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.travauxdevis_id_seq OWNED BY public.travauxdevis.id;


--
-- TOC entry 246 (class 1259 OID 18414)
-- Name: travauxmaison; Type: TABLE; Schema: public; Owner: Kenny
--

CREATE TABLE public.travauxmaison (
    id integer NOT NULL,
    idmaison integer,
    idtravaux integer,
    quantite double precision
);


ALTER TABLE public.travauxmaison OWNER TO "Kenny";

--
-- TOC entry 245 (class 1259 OID 18413)
-- Name: travauxmaison_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.travauxmaison_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.travauxmaison_id_seq OWNER TO "Kenny";

--
-- TOC entry 3829 (class 0 OID 0)
-- Dependencies: 245
-- Name: travauxmaison_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.travauxmaison_id_seq OWNED BY public.travauxmaison.id;


--
-- TOC entry 239 (class 1259 OID 18310)
-- Name: traveaux_id_seq; Type: SEQUENCE; Schema: public; Owner: Kenny
--

CREATE SEQUENCE public.traveaux_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.traveaux_id_seq OWNER TO "Kenny";

--
-- TOC entry 3830 (class 0 OID 0)
-- Dependencies: 239
-- Name: traveaux_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.traveaux_id_seq OWNED BY public.travaux.id;


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
-- TOC entry 3831 (class 0 OID 0)
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
-- TOC entry 3832 (class 0 OID 0)
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
-- TOC entry 3833 (class 0 OID 0)
-- Dependencies: 227
-- Name: utilisateur_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: Kenny
--

ALTER SEQUENCE public.utilisateur_id_seq OWNED BY public.utilisateur.id;


--
-- TOC entry 255 (class 1259 OID 18504)
-- Name: v_travauxmaisonprix; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_travauxmaisonprix AS
 SELECT travauxmaison.idmaison,
    maison.nom AS maison,
    travauxmaison.idtravaux,
    travaux.nom AS travaux,
    travaux.unite,
    travauxmaison.quantite,
    travaux.prixunitaire,
    (travauxmaison.quantite * travaux.prixunitaire) AS total
   FROM ((public.travauxmaison
     JOIN public.maison ON ((travauxmaison.idmaison = maison.id)))
     JOIN public.travaux ON ((travauxmaison.idtravaux = travaux.id)));


ALTER TABLE public.v_travauxmaisonprix OWNER TO postgres;

--
-- TOC entry 256 (class 1259 OID 18518)
-- Name: v_maisontype; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW public.v_maisontype AS
 SELECT maison.id,
    maison.nom,
    maison.description,
    maison.dure,
    sum(v_travauxmaisonprix.total) AS total
   FROM (public.maison
     JOIN public.v_travauxmaisonprix ON ((maison.id = v_travauxmaisonprix.idmaison)))
  GROUP BY maison.id, maison.nom, maison.description, maison.dure
  ORDER BY (sum(v_travauxmaisonprix.total));


ALTER TABLE public.v_maisontype OWNER TO postgres;

--
-- TOC entry 3561 (class 2604 OID 18283)
-- Name: client id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.client ALTER COLUMN id SET DEFAULT nextval('public.client_id_seq'::regclass);


--
-- TOC entry 3563 (class 2604 OID 18306)
-- Name: devi id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.devi ALTER COLUMN id SET DEFAULT nextval('public.devi_id_seq'::regclass);


--
-- TOC entry 3570 (class 2604 OID 18452)
-- Name: devisimportationcsv id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devisimportationcsv ALTER COLUMN id SET DEFAULT nextval('public.devisimportationcsv_id_seq'::regclass);


--
-- TOC entry 3555 (class 2604 OID 18248)
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- TOC entry 3562 (class 2604 OID 18298)
-- Name: finition id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.finition ALTER COLUMN id SET DEFAULT nextval('public.finition_id_seq'::regclass);


--
-- TOC entry 3567 (class 2604 OID 18408)
-- Name: histoversement id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.histoversement ALTER COLUMN id SET DEFAULT nextval('public.histoversement_id_seq'::regclass);


--
-- TOC entry 3554 (class 2604 OID 18231)
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- TOC entry 3571 (class 2604 OID 18460)
-- Name: lieu id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lieu ALTER COLUMN id SET DEFAULT nextval('public.lieu_id_seq'::regclass);


--
-- TOC entry 3559 (class 2604 OID 18269)
-- Name: maison id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.maison ALTER COLUMN id SET DEFAULT nextval('public.maison_id_seq'::regclass);


--
-- TOC entry 3569 (class 2604 OID 18445)
-- Name: maisonimportationcsv id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.maisonimportationcsv ALTER COLUMN id SET DEFAULT nextval('public.maisonimportationcsv_id_seq'::regclass);


--
-- TOC entry 3552 (class 2604 OID 18183)
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- TOC entry 3572 (class 2604 OID 18467)
-- Name: paiementimportationcsv id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paiementimportationcsv ALTER COLUMN id SET DEFAULT nextval('public.paiementinportationcsv_id_seq'::regclass);


--
-- TOC entry 3565 (class 2604 OID 18314)
-- Name: travaux id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.travaux ALTER COLUMN id SET DEFAULT nextval('public.traveaux_id_seq'::regclass);


--
-- TOC entry 3566 (class 2604 OID 18354)
-- Name: travauxdevis id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.travauxdevis ALTER COLUMN id SET DEFAULT nextval('public.travauxdevis_id_seq'::regclass);


--
-- TOC entry 3568 (class 2604 OID 18417)
-- Name: travauxmaison id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.travauxmaison ALTER COLUMN id SET DEFAULT nextval('public.travauxmaison_id_seq'::regclass);


--
-- TOC entry 3560 (class 2604 OID 18276)
-- Name: type id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.type ALTER COLUMN id SET DEFAULT nextval('public.type_id_seq'::regclass);


--
-- TOC entry 3553 (class 2604 OID 18190)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3557 (class 2604 OID 18260)
-- Name: utilisateur id; Type: DEFAULT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.utilisateur ALTER COLUMN id SET DEFAULT nextval('public.utilisateur_id_seq'::regclass);


--
-- TOC entry 3776 (class 0 OID 18213)
-- Dependencies: 220
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- TOC entry 3777 (class 0 OID 18220)
-- Dependencies: 221
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- TOC entry 3790 (class 0 OID 18280)
-- Dependencies: 234
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.client (id, numero) FROM stdin;
1	0340609099
2	0320723470
3	0340590098
\.


--
-- TOC entry 3794 (class 0 OID 18303)
-- Dependencies: 238
-- Data for Name: devi; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.devi (id, dure, debut, fin, payer, restant, total, type, maison, finition, pourcentage, totalpourcentage, creation, description, lieu, refdevis, numclient) FROM stdin;
2	120	2024-03-01	2024-06-29	0	48209705.98	43315099.71	KINSHASA	KINSHASA	Premium	11.3	48209705.98	2024-02-25	4 chambres, 1 living, 2 salles de bain, 1 garage	Andoharanofotsy	D007	0320723470
5	90	2024-01-10	2024-04-09	20780050	17185825.6	35665453.83	TOKYO	TOKYO	Gold	6.45	37965875.6	2023-12-22	2 chambres, 1 living, 1 salle de bain	Imerintsiatosika	D001	0340590098
3	75	2024-03-12	2024-05-26	25000000	14943373.49	35888026.5	LONDRES	LONDRES	Premium	11.3	39943373.49	2023-01-05	3 chambres, 1 terrasse, 1 salle de bain	Ambohijanaka	D005	0340590098
4	120	2024-02-14	2024-06-13	30000000	13315099.71	43315099.71	KINSHASA	KINSHASA	Standard	0	43315099.71	2024-02-09	4 chambres, 1 living, 2 salles de bain, 1 garage	Ampitatafika	D008	0320723470
1	120	2024-04-14	2024-08-12	7400000	47393601.13	43315099.71	KINSHASA	KINSHASA	VIP	26.5	54793601.13	2024-03-10	4 chambres, 1 living, 2 salles de bain, 1 garage	Ambohibao	D003	0340609099
\.


--
-- TOC entry 3806 (class 0 OID 18449)
-- Dependencies: 250
-- Data for Name: devisimportationcsv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.devisimportationcsv (id, client, ref_devis, finition, taux_finition, date_devis, date_debut, lieu, type_maison) FROM stdin;
1	0340590098	D001	Gold	6,45 %	2023-12-22	2024-01-10	Imerintsiatosika	TOKYO
2	0340590098	D005	Premium	11,30 %	2023-01-05	2024-03-12	Ambohijanaka	LONDRES
3	0320723470	D008	Standard	0 %	2024-02-09	2024-02-14	Ampitatafika	KINSHASA
4	0340609099	D003	VIP	26,50 %	2024-03-10	2024-04-14	Ambohibao	KINSHASA
5	0320723470	D007	Premium	11,30 %	2024-02-25	2024-03-01	Andoharanofotsy	KINSHASA
\.


--
-- TOC entry 3782 (class 0 OID 18245)
-- Dependencies: 226
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- TOC entry 3792 (class 0 OID 18295)
-- Dependencies: 236
-- Data for Name: finition; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.finition (id, nom, pourcentage) FROM stdin;
2	Gold	20
3	Premium	40
4	VIP	60
1	Standard	0
\.


--
-- TOC entry 3800 (class 0 OID 18405)
-- Dependencies: 244
-- Data for Name: histoversement; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.histoversement (id, versement, reste, total, date, refdevis, refpaiement) FROM stdin;
16	30000000	13315099.71	43315099.71	2024-05-15	D008	paie34
32	200000	39743373.49	39943373.49	2024-03-11	D005	G01
33	100000	54693601.13	54793601.13	2024-04-14	D003	P01
34	6200000	33743373.49	39943373.49	2024-03-19	D005	G04
35	2500000	52293601.13	54793601.13	2024-04-15	D003	P02
36	6200000	33743373.49	39943373.49	2024-03-15	D005	G02
37	4780050	33185825.6	37965875.6	2024-01-02	D001	A4683
38	5200000	32765875.6	37965875.6	2024-12-26	D001	3490124
39	6200000	33743373.49	39943373.49	2024-03-20	D005	G05
40	1600000	53193601.13	54793601.13	2024-04-20	D003	P04
41	400000	37565875.6	37965875.6	2023-12-28	D001	3490125
42	200000	37765875.6	37965875.6	2024-01-12	D001	3490126
43	6200000	33743373.49	39943373.49	2024-03-20	D005	G03
44	3200000	51593601.13	54793601.13	2024-04-19	D003	P03
45	10000000	27965875.6	37965875.6	2023-12-23	D001	3490123
46	200000	37765875.6	37965875.6	2024-01-12	D001	349012
\.


--
-- TOC entry 3780 (class 0 OID 18237)
-- Dependencies: 224
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- TOC entry 3779 (class 0 OID 18228)
-- Dependencies: 223
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- TOC entry 3808 (class 0 OID 18457)
-- Dependencies: 252
-- Data for Name: lieu; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.lieu (id, nom) FROM stdin;
1	Isoraka
2	Ankadivato
3	Ambodivona
4	Analamahitsy
5	Ambohijatovo
6	Ambatonakanga
7	Ankadilalana
8	Ambatobe
9	Soavina
10	Alarobia
11	Antohomadinika
12	Anosizato
13	Ambanidia
14	Ambohibao
15	Anosy
16	Androndra
17	Ampasanimalo
18	Andavamamba
19	Mahamasina
20	Analakely
21	Ankatso
22	Ankerana
23	Imerintsiatosika
24	Ampandrana
25	Mandroseza
26	Andoharanofotsy
27	Tanjombato
28	Ambatomainty
29	Ivato
30	Antaninarenina
31	Besarety
32	Soavimasoandro
33	Ambohijanaka
34	Ampitatafika
\.


--
-- TOC entry 3786 (class 0 OID 18266)
-- Dependencies: 230
-- Data for Name: maison; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.maison (id, nom, description, dure, surface) FROM stdin;
1	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	75	101
2	TOKYO	2 chambres, 1 living, 1 salle de bain	90	128
3	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	120	150
\.


--
-- TOC entry 3804 (class 0 OID 18442)
-- Dependencies: 248
-- Data for Name: maisonimportationcsv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.maisonimportationcsv (id, type_maison, description, surface, code_travaux, unite, prix_unitaire, quantite, duree_travaux, type_travaux) FROM stdin;
1	TOKYO	2 chambres, 1 living, 1 salle de bain	128	102	m3	573215.8	18.4	90	beton armée dosée à 350kg/m3
2	TOKYO	2 chambres, 1 living, 1 salle de bain	128	103	kg	8500	781	90	Armature pour Béton
3	TOKYO	2 chambres, 1 living, 1 salle de bain	128	105	m2	45000	150	90	Mur 22cm
4	TOKYO	2 chambres, 1 living, 1 salle de bain	128	201	m3	172114.4	16	90	maçonnerie de moellons
5	TOKYO	2 chambres, 1 living, 1 salle de bain	128	203	m3	33566.54	54	90	chape de 2cm
6	TOKYO	2 chambres, 1 living, 1 salle de bain	128	302	m2	10060.51	145	90	Peinture intérieure
7	TOKYO	2 chambres, 1 living, 1 salle de bain	128	303	m2	13078.66	160	90	Peinture extérieure
8	TOKYO	2 chambres, 1 living, 1 salle de bain	128	401	m2	602000	6	90	chassis vitrées
9	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	101	fft	152656	1	120	Travaux d'implantation
10	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	102	m3	573215.8	21.16	120	beton armée dosée à 350kg/m3
11	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	103	kg	8500	820.05	120	Armature pour Béton
12	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	105	m2	45000	160.5	120	Mur 22cm
13	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	201	m3	172114.4	30.4	120	maçonnerie de moellons
14	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	203	m3	33566.54	91.8	120	chape de 2cm
15	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	302	m2	10060.51	203	120	Peinture intérieure
16	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	303	m2	13078.66	192	120	Peinture extérieure
17	KINSHASA	4 chambres, 1 living, 2 salles de bain, 1 garage	150	401	m2	602000	6.6	120	chassis vitrées
18	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	101	fft	152656	2	75	Travaux d'implantation
19	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	102	m3	573215.8	22.08	75	beton armée dosée à 350kg/m3
20	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	103	kg	8500	851.29	75	Armature pour Béton
21	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	201	m3	172114.4	20.8	75	maçonnerie de moellons
22	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	203	m3	33566.54	59.4	75	chape de 2cm
23	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	303	m2	13078.66	304	75	Peinture extérieure
24	LONDRES	3 chambres, 1 terrasse, 1 salle de bain	101	401	m2	602000	10.2	75	chassis vitrées
\.


--
-- TOC entry 3771 (class 0 OID 18180)
-- Dependencies: 215
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
\.


--
-- TOC entry 3810 (class 0 OID 18464)
-- Dependencies: 254
-- Data for Name: paiementimportationcsv; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.paiementimportationcsv (id, ref_devis, ref_paiement, date_paiement, montant) FROM stdin;
281	D001	3490123	2023-12-23	10000000
282	D001	A4683	2024-01-02	4780050
283	D003	P01	2024-04-14	100000
284	D005	G01	2024-03-11	200000
285	D005	G02	2024-03-15	6200000
286	D001	3490124	2024-12-26	5200000
287	D003	P02	2024-04-15	2500000
288	D005	G03	2024-03-20	6200000
289	D005	G04	2024-03-19	6200000
290	D001	3490125	2023-12-28	400000
291	D003	P03	2024-04-19	3200000
292	D005	G05	2024-03-20	6200000
293	D001	3490126	2024-01-12	200000
294	D003	P04	2024-04-20	1600000
295	D001	349012	2024-01-12	200000
\.


--
-- TOC entry 3774 (class 0 OID 18197)
-- Dependencies: 218
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- TOC entry 3775 (class 0 OID 18204)
-- Dependencies: 219
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
yoIqIwbFcTGOkJDlBW80rAQqPx3l9SMdcXc2C35q	\N	127.0.0.1	Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36	YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiMlQ5em9EbjVRbDJFZHp2eURVc25qdE1yblFmQ0E4c3RXRFNZdmQ0WCI7czo3OiJpZEFkbWluIjtpOjE7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbmRleEFkbWluIjt9fQ==	1715782866
\.


--
-- TOC entry 3796 (class 0 OID 18311)
-- Dependencies: 240
-- Data for Name: travaux; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.travaux (id, nom, unite, prixunitaire, codetravaux) FROM stdin;
1	chape de 2cm	m3	33566.54	203
2	chassis vitrées	m2	602000	401
3	Mur 22cm	m2	45000	105
4	Peinture extérieure	m2	13078.66	303
5	beton armée dosée à 350kg/m3	m3	573215.8	102
6	maçonnerie de moellons	m3	172114.4	201
7	Armature pour Béton	kg	8500	103
8	Travaux d'implantation	fft	152656	101
9	Peinture intérieure	m2	10060.51	302
\.


--
-- TOC entry 3798 (class 0 OID 18351)
-- Dependencies: 242
-- Data for Name: travauxdevis; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.travauxdevis (id, iddevis, idtravaux, nom, unite, quantite, prixunitaire, total) FROM stdin;
1	4	5	beton armée dosée à 350kg/m3	m3	21.16	573215.8	12129246.328000002
2	1	6	maçonnerie de moellons	m3	30.4	172114.4	5232277.76
3	4	8	Travaux d'implantation	fft	1	152656	152656
4	4	9	Peinture intérieure	m2	203	10060.51	2042283.53
5	5	1	chape de 2cm	m3	54	33566.54	1812593.1600000001
6	2	6	maçonnerie de moellons	m3	30.4	172114.4	5232277.76
7	3	4	Peinture extérieure	m2	304	13078.66	3975912.64
8	3	2	chassis vitrées	m2	10.2	602000	6140400
9	1	9	Peinture intérieure	m2	203	10060.51	2042283.53
10	5	9	Peinture intérieure	m2	145	10060.51	1458773.95
11	2	3	Mur 22cm	m2	160.5	45000	7222500
12	1	4	Peinture extérieure	m2	192	13078.66	2511102.7199999997
13	1	2	chassis vitrées	m2	6.6	602000	3973200
14	4	1	chape de 2cm	m3	91.8	33566.54	3081408.372
15	2	2	chassis vitrées	m2	6.6	602000	3973200
16	2	8	Travaux d'implantation	fft	1	152656	152656
17	3	1	chape de 2cm	m3	59.4	33566.54	1993852.476
18	2	9	Peinture intérieure	m2	203	10060.51	2042283.53
19	1	1	chape de 2cm	m3	91.8	33566.54	3081408.372
20	4	4	Peinture extérieure	m2	192	13078.66	2511102.7199999997
21	4	3	Mur 22cm	m2	160.5	45000	7222500
22	4	7	Armature pour Béton	kg	820.05	8500	6970425
23	2	4	Peinture extérieure	m2	192	13078.66	2511102.7199999997
24	1	7	Armature pour Béton	kg	820.05	8500	6970425
25	4	6	maçonnerie de moellons	m3	30.4	172114.4	5232277.76
26	1	3	Mur 22cm	m2	160.5	45000	7222500
27	3	6	maçonnerie de moellons	m3	20.8	172114.4	3579979.52
28	5	6	maçonnerie de moellons	m3	16	172114.4	2753830.4
29	4	2	chassis vitrées	m2	6.6	602000	3973200
30	2	7	Armature pour Béton	kg	820.05	8500	6970425
31	5	3	Mur 22cm	m2	150	45000	6750000
32	1	8	Travaux d'implantation	fft	1	152656	152656
33	5	2	chassis vitrées	m2	6	602000	3612000
34	2	1	chape de 2cm	m3	91.8	33566.54	3081408.372
35	3	8	Travaux d'implantation	fft	2	152656	305312
36	5	7	Armature pour Béton	kg	781	8500	6638500
37	5	4	Peinture extérieure	m2	160	13078.66	2092585.6
38	3	5	beton armée dosée à 350kg/m3	m3	22.08	573215.8	12656604.864
39	3	7	Armature pour Béton	kg	851.29	8500	7235965
40	1	5	beton armée dosée à 350kg/m3	m3	21.16	573215.8	12129246.328000002
41	5	5	beton armée dosée à 350kg/m3	m3	18.4	573215.8	10547170.72
42	2	5	beton armée dosée à 350kg/m3	m3	21.16	573215.8	12129246.328000002
\.


--
-- TOC entry 3802 (class 0 OID 18414)
-- Dependencies: 246
-- Data for Name: travauxmaison; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.travauxmaison (id, idmaison, idtravaux, quantite) FROM stdin;
1	3	4	192
2	1	2	10.2
3	3	9	203
4	1	7	851.29
5	2	7	781
6	3	7	820.05
7	3	3	160.5
8	2	2	6
9	3	8	1
10	2	6	16
11	3	2	6.6
12	3	6	30.4
13	2	3	150
14	3	1	91.8
15	1	8	2
16	1	4	304
17	2	1	54
18	1	5	22.08
19	3	5	21.16
20	2	4	160
21	2	5	18.4
22	2	9	145
23	1	6	20.8
24	1	1	59.4
\.


--
-- TOC entry 3788 (class 0 OID 18273)
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
-- TOC entry 3773 (class 0 OID 18187)
-- Dependencies: 217
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 3784 (class 0 OID 18257)
-- Dependencies: 228
-- Data for Name: utilisateur; Type: TABLE DATA; Schema: public; Owner: Kenny
--

COPY public.utilisateur (id, nom, email, mdp, type) FROM stdin;
1	ken	ken@gmail.com	ken10	1
6	kenny	ken2@gmail.com	ken10	1
\.


--
-- TOC entry 3834 (class 0 OID 0)
-- Dependencies: 233
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.client_id_seq', 3, true);


--
-- TOC entry 3835 (class 0 OID 0)
-- Dependencies: 237
-- Name: devi_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.devi_id_seq', 5, true);


--
-- TOC entry 3836 (class 0 OID 0)
-- Dependencies: 249
-- Name: devisimportationcsv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.devisimportationcsv_id_seq', 5, true);


--
-- TOC entry 3837 (class 0 OID 0)
-- Dependencies: 225
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- TOC entry 3838 (class 0 OID 0)
-- Dependencies: 235
-- Name: finition_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.finition_id_seq', 4, true);


--
-- TOC entry 3839 (class 0 OID 0)
-- Dependencies: 243
-- Name: histoversement_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.histoversement_id_seq', 46, true);


--
-- TOC entry 3840 (class 0 OID 0)
-- Dependencies: 222
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- TOC entry 3841 (class 0 OID 0)
-- Dependencies: 251
-- Name: lieu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.lieu_id_seq', 34, true);


--
-- TOC entry 3842 (class 0 OID 0)
-- Dependencies: 229
-- Name: maison_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.maison_id_seq', 3, true);


--
-- TOC entry 3843 (class 0 OID 0)
-- Dependencies: 247
-- Name: maisonimportationcsv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.maisonimportationcsv_id_seq', 24, true);


--
-- TOC entry 3844 (class 0 OID 0)
-- Dependencies: 214
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 1, false);


--
-- TOC entry 3845 (class 0 OID 0)
-- Dependencies: 253
-- Name: paiementinportationcsv_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.paiementinportationcsv_id_seq', 295, true);


--
-- TOC entry 3846 (class 0 OID 0)
-- Dependencies: 241
-- Name: travauxdevis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.travauxdevis_id_seq', 42, true);


--
-- TOC entry 3847 (class 0 OID 0)
-- Dependencies: 245
-- Name: travauxmaison_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.travauxmaison_id_seq', 24, true);


--
-- TOC entry 3848 (class 0 OID 0)
-- Dependencies: 239
-- Name: traveaux_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.traveaux_id_seq', 9, true);


--
-- TOC entry 3849 (class 0 OID 0)
-- Dependencies: 231
-- Name: type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.type_id_seq', 4, true);


--
-- TOC entry 3850 (class 0 OID 0)
-- Dependencies: 216
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- TOC entry 3851 (class 0 OID 0)
-- Dependencies: 227
-- Name: utilisateur_id_seq; Type: SEQUENCE SET; Schema: public; Owner: Kenny
--

SELECT pg_catalog.setval('public.utilisateur_id_seq', 6, true);


--
-- TOC entry 3588 (class 2606 OID 18226)
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- TOC entry 3586 (class 2606 OID 18219)
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- TOC entry 3605 (class 2606 OID 18285)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- TOC entry 3609 (class 2606 OID 18308)
-- Name: devi devi_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.devi
    ADD CONSTRAINT devi_pkey PRIMARY KEY (id);


--
-- TOC entry 3621 (class 2606 OID 18454)
-- Name: devisimportationcsv devisimportationcsv_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.devisimportationcsv
    ADD CONSTRAINT devisimportationcsv_pkey PRIMARY KEY (id);


--
-- TOC entry 3595 (class 2606 OID 18253)
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3597 (class 2606 OID 18255)
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- TOC entry 3607 (class 2606 OID 18300)
-- Name: finition finition_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.finition
    ADD CONSTRAINT finition_pkey PRIMARY KEY (id);


--
-- TOC entry 3615 (class 2606 OID 18410)
-- Name: histoversement histoversement_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.histoversement
    ADD CONSTRAINT histoversement_pkey PRIMARY KEY (id);


--
-- TOC entry 3593 (class 2606 OID 18243)
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- TOC entry 3590 (class 2606 OID 18235)
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- TOC entry 3623 (class 2606 OID 18462)
-- Name: lieu lieu_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.lieu
    ADD CONSTRAINT lieu_pkey PRIMARY KEY (id);


--
-- TOC entry 3601 (class 2606 OID 18271)
-- Name: maison maison_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.maison
    ADD CONSTRAINT maison_pkey PRIMARY KEY (id);


--
-- TOC entry 3619 (class 2606 OID 18447)
-- Name: maisonimportationcsv maisonimportationcsv_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.maisonimportationcsv
    ADD CONSTRAINT maisonimportationcsv_pkey PRIMARY KEY (id);


--
-- TOC entry 3574 (class 2606 OID 18185)
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- TOC entry 3625 (class 2606 OID 18469)
-- Name: paiementimportationcsv paiementinportationcsv_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.paiementimportationcsv
    ADD CONSTRAINT paiementinportationcsv_pkey PRIMARY KEY (id);


--
-- TOC entry 3580 (class 2606 OID 18203)
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- TOC entry 3613 (class 2606 OID 18403)
-- Name: travauxdevis pk_travauxdevis; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.travauxdevis
    ADD CONSTRAINT pk_travauxdevis PRIMARY KEY (id);


--
-- TOC entry 3583 (class 2606 OID 18210)
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- TOC entry 3611 (class 2606 OID 18329)
-- Name: travaux travaux_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.travaux
    ADD CONSTRAINT travaux_pkey PRIMARY KEY (id);


--
-- TOC entry 3617 (class 2606 OID 18419)
-- Name: travauxmaison travauxmaison_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.travauxmaison
    ADD CONSTRAINT travauxmaison_pkey PRIMARY KEY (id);


--
-- TOC entry 3603 (class 2606 OID 18278)
-- Name: type type_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.type
    ADD CONSTRAINT type_pkey PRIMARY KEY (id);


--
-- TOC entry 3576 (class 2606 OID 18196)
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- TOC entry 3578 (class 2606 OID 18194)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 3599 (class 2606 OID 18262)
-- Name: utilisateur utilisateur_pkey; Type: CONSTRAINT; Schema: public; Owner: Kenny
--

ALTER TABLE ONLY public.utilisateur
    ADD CONSTRAINT utilisateur_pkey PRIMARY KEY (id);


--
-- TOC entry 3591 (class 1259 OID 18236)
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- TOC entry 3581 (class 1259 OID 18212)
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- TOC entry 3584 (class 1259 OID 18211)
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


-- Completed on 2024-05-30 12:36:29 EAT

--
-- PostgreSQL database dump complete
--

