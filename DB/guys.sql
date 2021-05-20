--
-- PostgreSQL database dump
--

-- Dumped from database version 11.0
-- Dumped by pg_dump version 11.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: mileage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.mileage (
    id integer NOT NULL,
    user_id integer DEFAULT 1 NOT NULL,
    date date DEFAULT '2021-05-19'::date NOT NULL,
    mileage integer DEFAULT 0 NOT NULL
);


ALTER TABLE public.mileage OWNER TO postgres;

--
-- Name: mileage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.mileage_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mileage_id_seq OWNER TO postgres;

--
-- Name: mileage_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.mileage_id_seq OWNED BY public.mileage.id;


--
-- Name: shopInfo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."shopInfo" (
    id integer NOT NULL,
    user_id integer DEFAULT 1 NOT NULL,
    theme1 integer DEFAULT 1 NOT NULL,
    theme2 integer DEFAULT 0 NOT NULL,
    theme3 integer DEFAULT 0 NOT NULL
);


ALTER TABLE public."shopInfo" OWNER TO postgres;

--
-- Name: shopInfo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."shopInfo_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."shopInfo_id_seq" OWNER TO postgres;

--
-- Name: shopInfo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."shopInfo_id_seq" OWNED BY public."shopInfo".id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    email text DEFAULT ''::text NOT NULL,
    pass text DEFAULT ''::text NOT NULL,
    name text DEFAULT ''::text NOT NULL,
    gender text DEFAULT ''::text NOT NULL,
    point integer DEFAULT 0 NOT NULL,
    "currentTheme" integer DEFAULT 1 NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: mileage id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mileage ALTER COLUMN id SET DEFAULT nextval('public.mileage_id_seq'::regclass);


--
-- Name: shopInfo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."shopInfo" ALTER COLUMN id SET DEFAULT nextval('public."shopInfo_id_seq"'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: mileage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.mileage (id, user_id, date, mileage) FROM stdin;
1	1	1999-05-18	100
2	2	2021-05-11	20
3	2	2021-05-13	70
4	3	2021-05-20	95
\.


--
-- Data for Name: shopInfo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."shopInfo" (id, user_id, theme1, theme2, theme3) FROM stdin;
1	1	1	0	0
2	2	1	1	0
3	3	1	1	1
4	4	1	1	1
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, email, pass, name, gender, point, "currentTheme") FROM stdin;
1	xxx@sr-co.co.jp	xxx	岡花香	M	0	1
2	yyy@sr-co.co.jp	yyy	田畑菊	M	0	1
3	zzz@sr-co.co.jp	zzz	以東人	M	0	1
4	admin@sr-co.co.jp	admin	管理者	O	0	1
\.


--
-- Name: mileage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.mileage_id_seq', 1, false);


--
-- Name: shopInfo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."shopInfo_id_seq"', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- Name: mileage mileage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.mileage
    ADD CONSTRAINT mileage_pkey PRIMARY KEY (id);


--
-- Name: shopInfo shopInfo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."shopInfo"
    ADD CONSTRAINT "shopInfo_pkey" PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

