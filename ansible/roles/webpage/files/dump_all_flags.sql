--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.6
-- Dumped by pg_dump version 9.6.0

-- Started on 2018-02-17 12:35:19

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2457 (class 1262 OID 18506)
-- Name: corchestra_db; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE corchestra_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';


ALTER DATABASE corchestra_db OWNER TO postgres;

\connect corchestra_db

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12387)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2459 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 185 (class 1259 OID 18507)
-- Name: advantage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE advantage (
    id integer NOT NULL,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE advantage OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 18510)
-- Name: advantage_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE advantage_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE advantage_id_seq OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 18512)
-- Name: advantage_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE advantage_translation (
    id integer NOT NULL,
    locale_id integer,
    source_id integer,
    description pg_catalog.text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    image_name character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE advantage_translation OWNER TO postgres;

--
-- TOC entry 188 (class 1259 OID 18519)
-- Name: advantage_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE advantage_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE advantage_translation_id_seq OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 18521)
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE client (
    id integer NOT NULL,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE client OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 18524)
-- Name: client_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE client_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE client_id_seq OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 18526)
-- Name: client_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE client_translation (
    id integer NOT NULL,
    locale_id integer,
    source_id integer,
    title pg_catalog.text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    color_image_name character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE client_translation OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 18533)
-- Name: client_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE client_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE client_translation_id_seq OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 18535)
-- Name: common_information; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE common_information (
    id integer NOT NULL,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE common_information OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 18538)
-- Name: common_information_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE common_information_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE common_information_id_seq OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 18540)
-- Name: common_information_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE common_information_translation (
    id integer NOT NULL,
    locale_id integer,
    source_id integer,
    title character varying(1024) DEFAULT NULL::character varying,
    description pg_catalog.text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE common_information_translation OWNER TO postgres;

--
-- TOC entry 196 (class 1259 OID 18547)
-- Name: common_information_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE common_information_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE common_information_translation_id_seq OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 18549)
-- Name: company_information; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE company_information (
    id integer NOT NULL,
    email character varying(128) DEFAULT NULL::character varying,
    phone_number character varying(32) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE company_information OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 18554)
-- Name: company_information_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE company_information_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE company_information_id_seq OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 18556)
-- Name: company_information_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE company_information_translation (
    id integer NOT NULL,
    locale_id integer,
    source_id integer,
    description pg_catalog.text,
    address character varying(512) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE company_information_translation OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 18563)
-- Name: company_information_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE company_information_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE company_information_translation_id_seq OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 18565)
-- Name: component; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE component (
    id integer NOT NULL,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE component OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 18572)
-- Name: component_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE component_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE component_id_seq OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 18574)
-- Name: component_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE component_translation (
    id integer NOT NULL,
    locale_id integer,
    source_id integer,
    name character varying(128) DEFAULT NULL::character varying,
    description pg_catalog.text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    wiki_url character varying(1024) DEFAULT NULL::character varying
);


ALTER TABLE component_translation OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 18581)
-- Name: component_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE component_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE component_translation_id_seq OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 18583)
-- Name: feed; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed (
    id integer NOT NULL,
    link character varying(256) DEFAULT NULL::character varying,
    public_id character varying(256) DEFAULT NULL::character varying,
    title character varying(1024) DEFAULT NULL::character varying,
    text pg_catalog.text,
    author character varying(128) DEFAULT NULL::character varying,
    last_modified timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    status character varying(255) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    feed_source_id integer
);


ALTER TABLE feed OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 18595)
-- Name: feed_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE feed_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE feed_id_seq OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 18597)
-- Name: feed_source; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed_source (
    id integer NOT NULL,
    url character varying(256) DEFAULT NULL::character varying,
    public_id character varying(256) DEFAULT NULL::character varying,
    title character varying(1024) DEFAULT NULL::character varying,
    description pg_catalog.text,
    last_modified timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    link character varying(256) DEFAULT NULL::character varying,
    locale_id integer
);


ALTER TABLE feed_source OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 18608)
-- Name: feed_source_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE feed_source_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE feed_source_id_seq OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 18610)
-- Name: feed_status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed_status (
    id integer NOT NULL,
    name character varying(32) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    locale_id integer
);


ALTER TABLE feed_status OWNER TO postgres;

--
-- TOC entry 210 (class 1259 OID 18614)
-- Name: feed_status_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE feed_status_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE feed_status_id_seq OWNER TO postgres;

--
-- TOC entry 211 (class 1259 OID 18616)
-- Name: locale; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE locale (
    id integer NOT NULL,
    language character varying(128) DEFAULT NULL::character varying,
    shortname character varying(4) DEFAULT NULL::character varying,
    selected boolean,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE locale OWNER TO postgres;

--
-- TOC entry 212 (class 1259 OID 18621)
-- Name: locale_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE locale_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE locale_id_seq OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 18920)
-- Name: phinxlog; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE phinxlog (
    version bigint NOT NULL,
    migration_name character varying(100),
    start_time timestamp without time zone,
    end_time timestamp without time zone,
    breakpoint boolean DEFAULT false NOT NULL
);


ALTER TABLE phinxlog OWNER TO postgres;

--
-- TOC entry 213 (class 1259 OID 18623)
-- Name: source; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE source (
    id integer NOT NULL,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE source OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 18626)
-- Name: source_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE source_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE source_id_seq OWNER TO postgres;

--
-- TOC entry 215 (class 1259 OID 18628)
-- Name: source_link; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE source_link (
    id integer NOT NULL,
    source_id integer,
    url character varying(1024) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE source_link OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 18635)
-- Name: source_link_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE source_link_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE source_link_id_seq OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 18637)
-- Name: source_link_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE source_link_translation (
    id integer NOT NULL,
    source_translation_id integer,
    source_id integer,
    locale_id integer,
    name character varying(64) DEFAULT NULL::character varying,
    url character varying(1024) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE source_link_translation OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 18645)
-- Name: source_link_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE source_link_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE source_link_translation_id_seq OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 18647)
-- Name: source_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE source_translation (
    id integer NOT NULL,
    source_id integer,
    locale_id integer,
    title character varying(64) DEFAULT NULL::character varying,
    subtitle character varying(128) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE source_translation OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 18652)
-- Name: source_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE source_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE source_translation_id_seq OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 18654)
-- Name: subscriber; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE subscriber (
    id integer NOT NULL,
    email character varying(128) DEFAULT NULL::character varying,
    subscribed_to_feed boolean,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE subscriber OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 18658)
-- Name: subscriber_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE subscriber_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subscriber_id_seq OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 18660)
-- Name: system_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE system_user (
    id integer NOT NULL,
    username character varying(128) DEFAULT NULL::character varying,
    username_canonical character varying(128) DEFAULT NULL::character varying,
    email character varying(128) DEFAULT NULL::character varying,
    email_canonical character varying(128) DEFAULT NULL::character varying,
    enabled boolean,
    salt character varying(255) DEFAULT NULL::character varying,
    password character varying(255) DEFAULT NULL::character varying,
    last_login timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    roles pg_catalog.text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    subscribed_to_feed boolean
);


ALTER TABLE system_user OWNER TO postgres;

--
-- TOC entry 2460 (class 0 OID 0)
-- Dependencies: 223
-- Name: COLUMN system_user.roles; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN system_user.roles IS '(DC2Type:array)';


--
-- TOC entry 224 (class 1259 OID 18673)
-- Name: system_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE system_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE system_user_id_seq OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 18675)
-- Name: text; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE text (
    id integer NOT NULL,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE text OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 18678)
-- Name: text_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE text_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE text_id_seq OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 18680)
-- Name: text_translation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE text_translation (
    id integer NOT NULL,
    source_id integer,
    locale_id integer,
    text character varying(1024) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE text_translation OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 18687)
-- Name: text_translation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE text_translation_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE text_translation_id_seq OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 18689)
-- Name: version; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE version (
    id integer NOT NULL,
    type character varying(32) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    version character varying(64) DEFAULT NULL::character varying
);


ALTER TABLE version OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 18694)
-- Name: version_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE version_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE version_id_seq OWNER TO postgres;



--
-- TOC entry 2404 (class 0 OID 18507)
-- Dependencies: 185
-- Data for Name: advantage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY advantage (id, date_of_creation, date_of_change) FROM stdin;
2	2017-08-09 14:41:19	2017-09-07 07:05:17
3	2017-08-09 14:42:01	2017-09-07 07:06:19
4	2017-08-09 14:42:54	2017-09-07 07:07:00
6	2017-08-09 14:45:46	2017-09-07 07:10:54
7	2017-08-09 14:46:38	2017-09-07 07:12:58
1	2017-08-09 14:40:10	2017-09-07 07:03:59
\.


--
-- TOC entry 2462 (class 0 OID 0)
-- Dependencies: 186
-- Name: advantage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('advantage_id_seq', 9, true);


--
-- TOC entry 2406 (class 0 OID 18512)
-- Dependencies: 187
-- Data for Name: advantage_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY advantage_translation (id, locale_id, source_id, description, date_of_creation, date_of_change, image_name) FROM stdin;
6	1	1	CelestaSQL: код бизнес-логики не зависит от типа базы данных	2017-09-07 07:03:32	2017-09-08 12:59:58	59b26a1ee7431386811167.png
10	1	2	Мы поддерживаем SQL Server, Oracle, PostgreSQL и H2	2017-09-07 07:04:37	2017-09-08 13:00:50	59b26a52d2077458563497.png
16	1	3	Автоматическое обновление структуры базы данных через идемпотентный DDL	2017-09-07 07:05:49	2017-09-08 13:01:24	59b26a7478923231763725.png
21	1	4	CelestaUnit: быстрое и лёгкое модульное тестирование процедур обработки данных	2017-09-07 07:06:41	2017-09-08 13:02:18	59b26aaaed262953949186.png
29	1	6	Эффективный механизм аутентификации и распределения прав доступа	2017-09-07 07:10:19	2017-09-08 13:03:01	59b26ad5b2042206936856.png
35	1	7	Поддержка сервис-ориентированной архитектуры	2017-09-07 07:12:58	2017-09-08 13:03:47	59b26b03d439d151315404.png
8	2	1	CelestaSQL: application code is RDBMS-agnostic	2017-09-07 07:03:59	2017-09-15 09:50:41	59b26a34018f2930041636.png
13	2	2	We support SQL Server, Oracle, PostgreSQL and H2	2017-09-07 07:05:17	2017-09-15 09:50:56	59b26a44af29e166658989.png
18	2	3	Automatic DB structure update via idempotent DDL	2017-09-07 07:06:19	2017-09-15 09:51:07	59b26a88bac7f249410599.png
23	2	4	CelestaUnit: fast and easy unit testing of data processing procedures	2017-09-07 07:07:00	2017-09-15 09:51:23	59b26a9e83de1350551582.png
31	2	6	Out-of-the-box security	2017-09-07 07:10:54	2017-09-15 09:51:45	59b26ae400b94140117039.png
33	2	7	Service-oriented architecture	2017-09-07 07:12:40	2017-09-15 09:51:56	59b26af3ab247887142059.png
\.


--
-- TOC entry 2463 (class 0 OID 0)
-- Dependencies: 188
-- Name: advantage_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('advantage_translation_id_seq', 35, true);


--
-- TOC entry 2408 (class 0 OID 18521)
-- Dependencies: 189
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY client (id, date_of_creation, date_of_change) FROM stdin;
30	2017-08-28 14:12:13	2017-09-07 07:35:47
31	2017-08-28 14:12:33	2017-09-07 07:38:20
34	2017-08-28 14:13:39	2017-09-07 07:38:41
35	2017-08-28 14:13:52	2017-09-07 07:39:00
36	2017-08-28 17:26:47	2017-09-07 07:39:10
33	2017-08-28 14:13:14	2017-09-07 14:02:39
\.


--
-- TOC entry 2464 (class 0 OID 0)
-- Dependencies: 190
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('client_id_seq', 36, true);


--
-- TOC entry 2410 (class 0 OID 18526)
-- Dependencies: 191
-- Data for Name: client_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY client_translation (id, locale_id, source_id, title, date_of_creation, date_of_change, color_image_name) FROM stdin;
2	1	30	Kelvion	2017-09-07 07:35:33	2017-09-08 13:04:23	59b26b277e089349318007.png
14	2	36	MINZDRAV	2017-09-07 07:38:00	2017-09-08 13:06:07	59b26b8f2d26c999502388.png
16	1	31	ОТКРЫТИЕ	2017-09-07 07:38:20	2017-09-08 13:06:23	59b26b9fc847e291791854.png
18	1	33	ВТБ	2017-09-07 07:38:29	2017-09-08 13:06:35	59b26bab844e1158504156.png
20	1	34	РНИМУ	2017-09-07 07:38:41	2017-09-08 13:06:47	59b26bb77f5df964655753.png
24	1	36	МИНЗДРАВ	2017-09-07 07:39:10	2017-09-08 13:07:28	59b26be0d9790219749157.png
12	2	35	ROSTRANSNADZOR	2017-09-07 07:37:34	2017-09-12 09:30:49	59b77f194b04c267547601.png
22	1	35	РОСТРАНСНАДЗОР	2017-09-07 07:39:00	2017-09-15 09:38:26	59bb756218df4976020668.png
4	2	30	Kelvion	2017-09-07 07:35:47	2017-09-15 09:39:27	59bb759f3342c638533817.png
6	2	31	OTKRYTIE	2017-09-07 07:36:33	2017-09-15 09:39:35	59bb75a7925d8990244942.png
8	2	33	VTB	2017-09-07 07:36:53	2017-09-15 09:39:45	59bb75b1360cb614231556.png
10	2	34	RNIMU	2017-09-07 07:37:13	2017-09-15 09:40:01	59bb75c156c29116434247.png
\.


--
-- TOC entry 2465 (class 0 OID 0)
-- Dependencies: 192
-- Name: client_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('client_translation_id_seq', 24, true);


--
-- TOC entry 2412 (class 0 OID 18535)
-- Dependencies: 193
-- Data for Name: common_information; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY common_information (id, date_of_creation, date_of_change) FROM stdin;
1	2017-08-10 06:03:10	2017-08-10 06:03:10
\.


--
-- TOC entry 2466 (class 0 OID 0)
-- Dependencies: 194
-- Name: common_information_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('common_information_id_seq', 1, true);


--
-- TOC entry 2414 (class 0 OID 18540)
-- Dependencies: 195
-- Data for Name: common_information_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY common_information_translation (id, locale_id, source_id, title, description, date_of_creation, date_of_change) FROM stdin;
2	1	1	Открытая платформа для разработки бизнес-приложений с веб-интерфейсом	Разработав бизнес-приложение, запускайте его на той РСУБД, <a href="https://corchestra.ru/wiki/index.php?title=Особенности_работы_Celesta_с_поддерживаемыми_типами_СУБД" target="_blank">которую предпочитает ваш заказчик</a>.<br>\r\n<a href="https://corchestra.ru/wiki/index.php?title=Проектирование_базы_данных_Celesta_в_DBSchema" target="_blank">Визуально проектируйте</a> таблицы базы данных на <a href="https://corchestra.ru/wiki/index.php?title=Язык_Celesta-SQL" target="_blank">языке CelestaSQL</a>.<br>\r\nБыстро создавайте <a href="https://corchestra.ru/wiki/index.php?title=Lyra" target="_blank">экранные формы</a>, связанные с данными таблицы.<br>\r\n<a href="https://corchestra.ru/wiki/index.php?title=Xylophone" target="_blank">Выводите отчёты</a> в форматах Excel, PDF и напрямую на принтер.	2017-09-07 05:18:34	2017-09-07 05:18:34
4	2	1	Opensource platform for developing business applications with a web interface	Write your business application once, run it using any RDBMS <a href="https://corchestra.ru/wiki/index.php?title=Особенности_работы_Celesta_с_поддерживаемыми_типами_СУБД" target="_blank">your customer likes</a>.<br>\r\n<a href="https://corchestra.ru/wiki/index.php?title=Проектирование_базы_данных_Celesta_в_DBSchema" target="_blank">Construct</a> your database tables visually using <a href="https://corchestra.ru/wiki/index.php?title=Язык_Celesta-SQL" target="_blank">CelestaSQL language</a>.<br>\r\nDevelop <a href="https://corchestra.ru/wiki/index.php?title=Lyra" target="_blank">form views</a> quickly and easily.<br>\r\n<a href="https://corchestra.ru/wiki/index.php?title=Xylophone" target="_blank">Produce reports</a> in Excel and PDF formats or send them to printer.	2017-09-07 05:19:47	2017-09-07 05:19:47
\.


--
-- TOC entry 2467 (class 0 OID 0)
-- Dependencies: 196
-- Name: common_information_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('common_information_translation_id_seq', 4, true);


--
-- TOC entry 2416 (class 0 OID 18549)
-- Dependencies: 197
-- Data for Name: company_information; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY company_information (id, email, phone_number, date_of_creation, date_of_change) FROM stdin;
1	info@curs.ru	+7 (495) 640-27-72	2017-08-10 08:41:32	2017-08-10 08:41:32
\.


--
-- TOC entry 2468 (class 0 OID 0)
-- Dependencies: 198
-- Name: company_information_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_information_id_seq', 2, true);


--
-- TOC entry 2418 (class 0 OID 18556)
-- Dependencies: 199
-- Data for Name: company_information_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY company_information_translation (id, locale_id, source_id, description, address, date_of_creation, date_of_change) FROM stdin;
2	1	1	Группа компаний «КУРС» с 1998 года активно работает на российском рынке информационных и консультационных услуг, как в корпоративном, так и в государственном секторе.	111020, Москва, Боровая ул., дом 7, корп. 2	2017-09-07 05:22:42	2017-09-07 05:22:42
4	2	1	"CURS" group of companies actively works on Russian market of information and consulting services, both in corporate and in public sector since 1998.	111020, Moscow, Borovaya Str., Building 7, building. 2	2017-09-07 05:23:21	2017-09-07 05:23:21
\.


--
-- TOC entry 2469 (class 0 OID 0)
-- Dependencies: 200
-- Name: company_information_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_information_translation_id_seq', 4, true);


--
-- TOC entry 2420 (class 0 OID 18565)
-- Dependencies: 201
-- Data for Name: component; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY component (id, date_of_creation, date_of_change) FROM stdin;
1	2017-08-09 14:49:24	2017-08-09 14:49:24
2	2017-08-09 14:49:56	2017-08-09 14:49:56
3	2017-08-09 14:50:26	2017-08-09 14:50:26
5	2017-08-09 14:51:04	2017-08-09 14:51:04
7	2017-08-09 14:51:46	2017-08-09 14:51:46
\.


--
-- TOC entry 2470 (class 0 OID 0)
-- Dependencies: 202
-- Name: component_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('component_id_seq', 8, true);


--
-- TOC entry 2422 (class 0 OID 18574)
-- Dependencies: 203
-- Data for Name: component_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY component_translation (id, locale_id, source_id, name, description, date_of_creation, date_of_change, wiki_url) FROM stdin;
2	1	1	Showcase	Конструирование веб-интерфейса бизнес-систем, работающего в Java Servlet Container	2017-09-07 05:58:01	2017-09-07 05:58:01	\N
11	1	2	Celesta	Разработка приложений в условиях меняющихся требований бизнеса на языке Jython с использованием реляционной базы данных	2017-09-07 07:16:46	2017-09-07 07:16:46	\N
15	1	3	Flute	REST-сервисы, обработчики очередей и периодические задания на базе Celesta-процедур	2017-09-07 07:18:56	2017-09-07 07:18:56	\N
21	1	5	Mellophone	Модуль аутентификации пользователей	2017-09-07 07:21:09	2017-09-07 07:21:09	\N
7	2	1	Showcase	Create web interfaces for your business application, running in Java Servlet Container	2017-09-07 05:59:34	2017-09-07 05:59:34	\N
13	2	2	Celesta	Develop your application for constantly changing business requirements using Jython language and relational DBMS	2017-09-07 07:18:22	2017-09-07 07:18:22	\N
17	2	3	Flute	Convert your Celesta routines to RESTful services, queue processors, scheduled tasks or looped tasks	2017-09-07 07:19:28	2017-09-07 07:19:28	\N
19	2	5	Mellophone	User authentication	2017-09-07 07:20:38	2017-09-07 07:20:38	\N
25	2	7	Xylophone	Generate PDF/Excel print reports	2017-09-07 07:23:21	2017-09-07 07:23:21	\N
23	1	7	Xylophone	Формирование печатных и форм и документов	2017-09-07 07:22:36	2017-09-07 07:22:36	\N
\.


--
-- TOC entry 2471 (class 0 OID 0)
-- Dependencies: 204
-- Name: component_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('component_translation_id_seq', 25, true);


--
-- TOC entry 2424 (class 0 OID 18583)
-- Dependencies: 205
-- Data for Name: feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed (id, link, public_id, title, text, author, last_modified, status, date_of_creation, date_of_change, feed_source_id) FROM stdin;
3	https://groups.google.com/d/msg/curs-group/C0s-hodtp74/bh3kAPo4AgAJ	https://groups.google.com/d/topic/curs-group/C0s-hodtp74	Celesta: setIn (вложенные фильтры)	Уважаемые коллеги, в класс BasicCursor Celesta добавился новый метод фильтрации: setIn, который позволяет установить фильтр с вложенным запросом по указанному набору полей. Для чего он нужен? Хорошо знакомый метод setFilter позволяет фильтровать записи, некоторое поле которых принимает любое	\nIvan Ponomarev	2017-06-12 00:19:24	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
4	https://groups.google.com/d/msg/curs-group/w_sBvgw3CEI/Ps1Au_AxAQAJ	https://groups.google.com/d/topic/curs-group/w_sBvgw3CEI	В Celesta добавлена возможность асинхронного вызова python функций	Класс ru.curs.celesta.Celesta пополнился двумя методами с наименованием runPythonAsync. Они принимают те же параметры, что и runPython и возвращают Future<PyObject> (Future из пакета java.util.concurrent) -- С уважением, Иван Головко	\nioanngolovko	2017-06-08 15:59:13	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
15	https://groups.google.com/d/msg/curs-group/E9uXjlDlaw8/D6BeaR75AwAJ	https://groups.google.com/d/topic/curs-group/E9uXjlDlaw8	В Celesta-SQL добавлены агрегатные функции	В Celesta-SQL были добавлены следующие конструкции: 1. COUNT(*) 2. SUM 3. MIN 4. MAX 5. GROUP BY Эти конструкции можно использовать при создании View, например: - CREATE VIEW testView1 AS select sum (f1 * 2 + f2) as sumv, f3 from testTable group by f3; - CREATE VIEW	\nioanngolovko	2017-05-30 11:51:59	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
14	https://groups.google.com/d/msg/curs-group/-r0ut7yjlgw/6CdCQ2GCBgAJ	https://groups.google.com/d/topic/curs-group/-r0ut7yjlgw	Celesta теперь поддерживает триггеры для системных курсоров	Всем доброго времени суток. В Celesta добавлена возможность регистрировать триггеры для системных курсоров. Регистрация триггеров на системные курсоры отличается от курсоров, сгенерированных в Jython модули. В каждый системный курсор добавлены статические методы для регистрации триггеров	\nioanngolovko	2017-05-31 20:23:15	Отклонена	2017-08-11 20:06:43	2017-08-11 20:06:43	1
13	https://groups.google.com/d/msg/curs-group/B9lUYCxEAoU/ogz9dajQBgAJ	https://groups.google.com/d/topic/curs-group/B9lUYCxEAoU	Опрос: что из этих двух фич вы хотели бы видеть во Flute/Celesta?	Уважаемые коллеги! Некоторое время назад вашим решением была оставлена поддержка SQL Server2008, и вот снова нам важно ваше мнение. Какую из двух перечисленных доработок платформы вы считаете более нужной/перспективной? Поясню ситуацию. Для решения некоторой задачи на проекте М. без доработок	\nIvan Ponomarev	2017-06-01 20:17:42	На модерации	2017-08-11 20:06:43	2017-08-11 20:06:43	1
2	https://groups.google.com/d/msg/curs-group/nkU5aZlHTO0/NXDGNfDoAAAJ	https://groups.google.com/d/topic/curs-group/nkU5aZlHTO0	Новости платформы Курс: реализована поддержка материализованных представлений (Materialized View) в celesta	Уважаемые пользователи платформы Курс. С 25 июля синтаксис CelestaSQL поддерживает материализованные представления - Materialized View. Материализованное представление - физический объект базы данных, содержащий результат выполнения запроса. Материализованные представления позволяют существенно	\nioanngolovko	2017-07-26 12:22:11	Отклонена	2017-08-11 20:06:43	2017-08-11 20:06:43	1
1	https://groups.google.com/d/msg/curs-group/w9-WlUP5fLE/KLt_UfUhBQAJ	https://groups.google.com/d/topic/curs-group/w9-WlUP5fLE	Новости платформы Курс. Добавлена возможность задания списка столбцов для курсоров celesta	Уважаемые пользователи платформы Курс. Теперь в trunk релизе платформы Курс Celesta поддерживает возможность задания списка столбцов при выборке записей через курсоры celesta. Данный функционал позволит снизить нагрузку на базу данных решения (БД) и сеть, так как из базы будут выбираться данные	\nioanngolovko	2017-08-03 08:46:41	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
16	https://groups.google.com/d/msg/curs-group/E9uXjlDlaw8/D6BeaR75AwAJ	https://groups.google.com/d/topic/curs-group/E9uXjlDlaw8	В Celesta-SQL добавлены агрегатные функции	В Celesta-SQL были добавлены следующие конструкции: 1. COUNT(*) 2. SUM 3. MIN 4. MAX 5. GROUP BY Эти конструкции можно использовать при создании View, например: - CREATE VIEW testView1 AS select sum (f1 * 2 + f2) as sumv, f3 from testTable group by f3; - CREATE VIEW	\nioanngolovko	2017-05-30 11:51:59	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	2
\.


--
-- TOC entry 2472 (class 0 OID 0)
-- Dependencies: 206
-- Name: feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_id_seq', 15, true);


--
-- TOC entry 2426 (class 0 OID 18597)
-- Dependencies: 207
-- Data for Name: feed_source; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed_source (id, url, public_id, title, description, last_modified, date_of_creation, date_of_change, link, locale_id) FROM stdin;
1	https://groups.google.com/forum/feed/curs-group/msgs/rss.xml	https://groups.google.com/d/forum/curs-group	curs-group	Новости и техническая поддержка платформы КУРС<br><a href="https://share.curs.ru/wiki/">https://share.curs.ru/wiki/</a>	1970-01-01 00:00:00	2017-08-11 13:55:13	2017-08-11 13:55:13	https://groups.google.com/d/forum/curs-group	1
2	https://groups.google.com/forum/feed/curs-group/msgs/atom.xml	https://groups.google.com/d/forum/curs-group	curs-group	\N	2017-08-27 16:39:38	2017-08-24 21:50:06	2017-08-24 21:50:06	https://groups.google.com/forum/feed/curs-group/msgs/atom_v1_0.xml	2
\.


--
-- TOC entry 2473 (class 0 OID 0)
-- Dependencies: 208
-- Name: feed_source_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_source_id_seq', 3, true);


--
-- TOC entry 2428 (class 0 OID 18610)
-- Dependencies: 209
-- Data for Name: feed_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed_status (id, name, date_of_creation, date_of_change, locale_id) FROM stdin;
1	На модерации	2017-08-11 17:08:04	2017-08-11 17:08:04	\N
2	Опубликована	2017-08-11 17:08:11	2017-08-11 17:08:11	\N
3	Отклонена	2017-08-11 17:08:17	2017-08-11 17:08:17	\N
\.


--
-- TOC entry 2474 (class 0 OID 0)
-- Dependencies: 210
-- Name: feed_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_status_id_seq', 3, true);


--
-- TOC entry 2430 (class 0 OID 18616)
-- Dependencies: 211
-- Data for Name: locale; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY locale (id, language, shortname, selected, date_of_creation, date_of_change) FROM stdin;
1	Русский	ru	t	2017-09-07 05:14:42	2017-09-07 05:14:42
2	English	en	f	2017-09-07 05:14:58	2017-09-07 05:14:58
\.


--
-- TOC entry 2475 (class 0 OID 0)
-- Dependencies: 212
-- Name: locale_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('locale_id_seq', 2, true);


--
-- TOC entry 2450 (class 0 OID 18920)
-- Dependencies: 231
-- Data for Name: phinxlog; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY phinxlog (version, migration_name, start_time, end_time, breakpoint) FROM stdin;
20180211020316	CreateTableVersionLinks	2018-02-11 05:43:38	2018-02-11 05:43:39	f
\.


--
-- TOC entry 2432 (class 0 OID 18623)
-- Dependencies: 213
-- Data for Name: source; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY source (id, date_of_creation, date_of_change) FROM stdin;
1	2017-09-15 19:06:05	2017-09-15 19:06:05
2	2017-09-15 19:09:21	2017-09-15 19:09:21
3	2017-09-15 19:10:55	2017-09-15 19:10:55
\.


--
-- TOC entry 2476 (class 0 OID 0)
-- Dependencies: 214
-- Name: source_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('source_id_seq', 4, false);


--
-- TOC entry 2434 (class 0 OID 18628)
-- Dependencies: 215
-- Data for Name: source_link; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY source_link (id, source_id, url, date_of_creation, date_of_change) FROM stdin;
11	3	https://svn.code.sf.net/p/kurs-celesta/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
12	3	https://svn.code.sf.net/p/kurs-flute/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
1	1	https://share.curs.ru/svn/celesta/	2017-09-15 19:06:05	2017-09-15 19:06:05
2	1	https://share.curs.ru/svn/flute/	2017-09-15 19:06:05	2017-09-15 19:06:05
3	1	https://share.curs.ru/svn/grains/	2017-09-15 19:06:05	2017-09-15 19:06:05
4	1	https://share.curs.ru/svn/mellophone/	2017-09-15 19:06:05	2017-09-15 19:06:05
5	1	https://share.curs.ru/svn/showcase/	2017-09-15 19:06:05	2017-09-15 19:06:05
6	2	https://svn.lancelot-it.ru:8420/svn/celesta/	2017-09-15 19:09:21	2017-09-15 19:09:21
7	2	https://svn.lancelot-it.ru:8420/svn/flute/	2017-09-15 19:09:21	2017-09-15 19:09:21
8	2	https://svn.lancelot-it.ru:8420/svn/grains/	2017-09-15 19:09:21	2017-09-15 19:09:21
9	2	https://svn.lancelot-it.ru:8420/svn/mellophone/	2017-09-15 19:09:21	2017-09-15 19:09:21
10	2	https://svn.lancelot-it.ru:8420/svn/showcase/	2017-09-15 19:09:21	2017-09-15 19:09:21
13	3	https://svn.code.sf.net/p/kurs-grains/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
14	3	https://svn.code.sf.net/p/kurs-mellophone/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
\.


--
-- TOC entry 2477 (class 0 OID 0)
-- Dependencies: 216
-- Name: source_link_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('source_link_id_seq', 15, false);


--
-- TOC entry 2436 (class 0 OID 18637)
-- Dependencies: 217
-- Data for Name: source_link_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY source_link_translation (id, source_translation_id, source_id, locale_id, name, url, date_of_creation, date_of_change) FROM stdin;
1	1	1	1	Celesta	https://share.curs.ru/svn/celesta/	2017-09-15 19:06:05	2017-09-15 19:06:05
2	1	2	1	Flute (включая XML2Spreadsheet)	https://share.curs.ru/svn/flute/	2017-09-15 19:06:05	2017-09-15 19:06:05
3	1	3	1	grains (системная библиотека Celesta)	https://share.curs.ru/svn/grains/	2017-09-15 19:06:05	2017-09-15 19:06:05
4	1	4	1	Mellophone	https://share.curs.ru/svn/mellophone/	2017-09-15 19:06:05	2017-09-15 19:06:05
5	1	5	1	Showcase	https://share.curs.ru/svn/showcase/	2017-09-15 19:06:05	2017-09-15 19:06:05
16	4	6	1	Celesta	https://svn.lancelot-it.ru:8420/svn/celesta/	2017-09-15 19:09:21	2017-09-15 19:09:21
17	4	7	1	Flute (включая XML2Spreadsheet)	https://svn.lancelot-it.ru:8420/svn/flute/	2017-09-15 19:09:21	2017-09-15 19:09:21
18	4	8	1	grains (системная библиотека Celesta)	https://svn.lancelot-it.ru:8420/svn/grains/	2017-09-15 19:09:21	2017-09-15 19:09:21
19	4	9	1	Mellophone	https://svn.lancelot-it.ru:8420/svn/mellophone/	2017-09-15 19:09:21	2017-09-15 19:09:21
20	4	10	1	Showcase	https://svn.lancelot-it.ru:8420/svn/showcase/	2017-09-15 19:09:21	2017-09-15 19:09:21
31	7	11	1	Celesta	https://svn.code.sf.net/p/kurs-celesta/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
32	7	12	1	Flute (включая XML2Spreadsheet)	https://svn.code.sf.net/p/kurs-flute/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
33	7	13	1	grains (системная библиотека Celesta)	https://svn.code.sf.net/p/kurs-grains/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
34	7	14	1	Mellophone	https://svn.code.sf.net/p/kurs-mellophone/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
6	2	1	2	Celesta	https://share.curs.ru/svn/celesta/	2017-09-15 19:06:05	2017-09-15 19:06:05
25	5	10	2	Showcase	https://svn.lancelot-it.ru:8420/svn/showcase/	2017-09-15 19:09:21	2017-09-15 19:09:21
24	5	9	2	Mellophone	https://svn.lancelot-it.ru:8420/svn/mellophone/	2017-09-15 19:09:21	2017-09-15 19:09:21
21	5	6	2	Celesta	https://svn.lancelot-it.ru:8420/svn/celesta/	2017-09-15 19:09:21	2017-09-15 19:09:21
38	8	14	2	Mellophone	https://svn.code.sf.net/p/kurs-mellophone/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
35	8	11	2	Celesta	https://svn.code.sf.net/p/kurs-celesta/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
22	5	7	2	Flute (including XML2Spreadsheet)	https://svn.lancelot-it.ru:8420/svn/flute/	2017-09-15 19:09:21	2017-09-15 19:09:21
23	5	8	2	grains (system library Celesta)	https://svn.lancelot-it.ru:8420/svn/grains/	2017-09-15 19:09:21	2017-09-15 19:09:21
36	8	12	2	Flute (including XML2Spreadsheet)	https://svn.code.sf.net/p/kurs-flute/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
37	8	13	2	grains (system library Celesta)	https://svn.code.sf.net/p/kurs-grains/code/	2017-09-15 19:10:55	2017-09-15 19:10:55
7	2	2	2	Flute (including XML2Spreadsheet)	https://share.curs.ru/svn/flute/	2017-09-15 19:06:05	2017-09-15 19:06:05
8	2	3	2	grains (system library Celesta)	https://share.curs.ru/svn/grains/	2017-09-15 19:06:05	2017-09-15 19:06:05
9	2	4	2	Mellophone	https://share.curs.ru/svn/mellophone/	2017-09-15 19:06:05	2017-09-15 19:06:05
10	2	5	2	Showcase	https://share.curs.ru/svn/showcase/	2017-09-15 19:06:05	2017-09-15 19:06:05
\.


--
-- TOC entry 2478 (class 0 OID 0)
-- Dependencies: 218
-- Name: source_link_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('source_link_translation_id_seq', 39, false);


--
-- TOC entry 2438 (class 0 OID 18647)
-- Dependencies: 219
-- Data for Name: source_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY source_translation (id, source_id, locale_id, title, subtitle, date_of_creation, date_of_change) FROM stdin;
1	1	1	С сайта компании КУРС	Master SVN | user: reader | pwd: reader	2017-09-15 19:06:05	2017-09-15 19:06:05
4	2	1	Lancelot-it.ru	Primary read-only copy | user: reader | pwd: platform	2017-09-15 19:09:21	2017-09-15 19:09:21
7	3	1	code.sf.net	Secondary read-only copy (sourceforge.net, anonymous access)	2017-09-15 19:10:55	2017-09-15 19:10:55
2	1	2	CURS web-site	Master SVN | user: reader | pwd: reader	2017-09-15 19:06:05	2017-09-15 19:06:05
5	2	2	Lancelot-it.ru	Primary read-only copy | user: reader | pwd: platform	2017-09-15 19:09:21	2017-09-15 19:09:21
8	3	2	code.sf.net	Secondary read-only copy (sourceforge.net, anonymous access)	2017-09-15 19:10:55	2017-09-15 19:10:55
\.


--
-- TOC entry 2479 (class 0 OID 0)
-- Dependencies: 220
-- Name: source_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('source_translation_id_seq', 9, false);


--
-- TOC entry 2440 (class 0 OID 18654)
-- Dependencies: 221
-- Data for Name: subscriber; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY subscriber (id, email, subscribed_to_feed, date_of_creation, date_of_change) FROM stdin;
1	goldenarius@gmail.com	t	2017-08-17 16:50:54	2017-08-17 16:50:54
3	test127@ya.ya	t	2017-08-17 21:21:04	2017-08-17 21:21:04
4	test22@mail.ru	t	2017-08-18 09:48:42	2017-08-18 09:48:42
5	test@test.ru	t	2017-08-18 10:08:45	2017-08-18 10:08:45
6	gsadhasdh@afs.rs	t	2017-08-18 10:08:54	2017-08-18 10:08:54
2	asdf@sf.ru	t	2017-08-17 19:51:51	2017-08-17 19:51:51
7	123@mail.ru	t	2017-08-23 09:19:49	2017-08-23 09:19:49
8	twadst@axeta.ru	t	2017-08-23 13:33:44	2017-08-23 13:33:44
9	456@test.ru	t	2017-08-24 03:50:04	2017-08-24 03:50:04
\.


--
-- TOC entry 2480 (class 0 OID 0)
-- Dependencies: 222
-- Name: subscriber_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subscriber_id_seq', 9, true);


--
-- TOC entry 2442 (class 0 OID 18660)
-- Dependencies: 223
-- Data for Name: system_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY system_user (id, username, username_canonical, email, email_canonical, enabled, salt, password, last_login, roles, date_of_creation, date_of_change, subscribed_to_feed) FROM stdin;
10	tyyevd	\N	zphjmfa@e0b.tech	\N	t	\N	$2y$13$szgUcizbBw5sAjd3kHTN.u2JOfO0Q57LGPt4c03F0wDkAza6RoyT2	\N	N;	2017-08-16 00:44:56	2017-08-16 00:44:56	f
11	nlbi3uw	\N	4q8venhjglhfn3v@0ef5.io	\N	t	\N	$2y$13$0ZLBOZHvjO1ZCsmhUOZYxO99iJt3CfURyFlO11vmbAzmuzPuDQHHO	\N	N;	2017-08-16 00:44:57	2017-08-16 00:44:57	f
12	7ah	\N	iaozbmd@9d2cz.su	\N	t	\N	$2y$13$3UiJVbIizXUhggysK74cUOY/HWkCbga1R4saCpjkhp7JwvDIbmNSe	\N	N;	2017-08-16 00:44:58	2017-08-16 00:44:58	f
13	wmn1kd5t	\N	zeiyk0i1c5hsbgg@ozfn.io	\N	t	\N	$2y$13$a1o9Nw8fC5k9qITgryRdO.BzBml6GfOxPaUeKQYA1IM1VX4n6.BMW	\N	N;	2017-08-16 00:44:59	2017-08-16 00:44:59	f
14	2oxrvsbm	\N	7op3cf695m7fe@qm0xxw.com	\N	t	\N	$2y$13$oekn84tq6P7Z1DhQU//Y6.l9cVKi4uFHheqWBtBlp/tzYmfVC/ece	\N	N;	2017-08-16 00:45:00	2017-08-16 00:45:00	f
15	nsa	\N	c4hvmc@8unfa.com	\N	t	\N	$2y$13$IylSMX4mAU0u6fZTDJv5Vef5LD7Zep/7ovnYTGOmJ53AAc5ib71OW	\N	N;	2017-08-16 00:45:00	2017-08-16 00:45:00	f
16	gh1	\N	r5g73v28gu8@25p.im	\N	t	\N	$2y$13$rT/1hpuGzNCLTQuFJ.538ObXG7P7tluUDf0DbhxZoCNi22U0g28V6	\N	N;	2017-08-16 00:45:01	2017-08-16 00:45:01	f
17	s3l1	\N	61g2jox7@dfhl.org	\N	t	\N	$2y$13$0FTGWvUlIoxJgXwQio5wvO1ehJMGL8lq0rzdwCTx6L.JTML91moaO	\N	N;	2017-08-16 00:45:02	2017-08-16 00:45:02	f
6	neo	\N	4m1oc98e@5cek1g.im	\N	t	\N	$2y$13$olHFANXSW3RpDW.zBBn4XuRSi4eMQ4I5RHo/5yEtsDOjNNMlwHShS	\N	N;	2017-08-14 00:37:38	2017-08-14 00:37:38	f
9	zw8mct	\N	l0vcrn57x@yje94.pro	\N	t	\N	$2y$13$WEfaWW.uYFR6mgBrmCXH.O3XLT0XeYMYrd.vh7Bi7.O82YTuBdr/q	\N	N;	2017-08-14 00:37:40	2017-08-14 00:37:40	t
4	76v69	\N	t0ov7641z10tz@c0i.pro	\N	t	\N	$2y$13$E/wyP8r7VvzzOmD24sqCy.1fWFJ.4rfmNsBzz3Gp9RfQy..LUIqw2	\N	N;	2017-08-14 00:37:36	2017-08-14 00:37:36	t
2	hxrgvs	\N	fuvop2uwse45pd@vxxpn.ru	\N	t	\N	$2y$13$amnV8FPIeFaWGcI5mxUazeiyPP0o7VwI3mYMl9NhS0PZH/lhND5i.	\N	N;	2017-08-14 00:37:35	2017-08-14 00:37:35	f
5	t36v1	\N	jecsh0ft@jsq3oh.pro	\N	t	\N	$2y$13$107GDK6yWb6GFaIRziltx.jqY3vIjTpi4fTAoqHUihC9ucku7tf1W	\N	N;	2017-08-14 00:37:37	2017-08-14 00:37:37	f
7	nqp9e	\N	5v3tsr5zntx@i6yhvj.io	\N	t	\N	$2y$13$EJnfsVajjqg1W7v3Go/VNeorUfFQno1nIn3sDxMW4eiwgQm3MQbN2	\N	N;	2017-08-14 00:37:38	2017-08-14 00:37:38	t
3	zcmb6od	\N	gn5@hr7xw.com	\N	t	\N	$2y$13$6YC.dmlRboJmiMGroKmSL.Acpmbr0VA.GvjR5nBUvo1Y.uyaZG4V.	\N	N;	2017-08-14 00:37:36	2017-08-14 00:37:36	t
8	ycgp	\N	3mz@kw2l.tech	\N	t	\N	$2y$13$0KFzwO7l6luZ6h1qhTz5ZuTEGBxqkbAHd5ccSyw51jB9ljSDjQFl6	\N	N;	2017-08-14 00:37:39	2017-08-14 00:37:39	t
1	admin	\N	admin@admin.admin	\N	t	\N	$2y$13$OohmGCNPyEe.ww/ACA9tx.wMaHXFCConOzEsXKHeIQyYcqcMONqcm	\N	a:1:{i:0;s:10:"ROLE_ADMIN";}	2017-08-09 03:11:01	2017-08-09 03:11:01	\N
\.


--
-- TOC entry 2481 (class 0 OID 0)
-- Dependencies: 224
-- Name: system_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('system_user_id_seq', 17, true);


--
-- TOC entry 2444 (class 0 OID 18675)
-- Dependencies: 225
-- Data for Name: text; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY text (id, date_of_creation, date_of_change) FROM stdin;
1	2017-09-12 07:38:07	2017-09-12 07:38:07
2	2017-09-12 07:40:00	2017-09-12 07:40:00
3	2017-09-12 08:19:56	2017-09-12 08:19:56
4	2017-09-12 08:23:42	2017-09-12 08:23:42
5	2017-09-12 08:23:58	2017-09-12 08:23:58
6	2017-09-12 08:24:20	2017-09-12 08:24:20
7	2017-09-12 08:24:54	2017-09-12 08:24:54
8	2017-09-12 08:25:16	2017-09-12 08:25:16
9	2017-09-12 08:25:33	2017-09-12 08:25:33
10	2017-09-12 08:25:45	2017-09-12 08:25:45
11	2017-09-12 08:25:57	2017-09-12 08:25:57
12	2017-09-12 08:49:13	2017-09-12 08:49:13
13	2017-09-12 08:49:29	2017-09-12 08:49:29
14	2017-09-12 08:49:43	2017-09-12 08:49:43
15	2017-09-12 08:51:04	2017-09-12 08:51:04
16	2017-09-12 08:51:16	2017-09-12 08:51:16
17	2017-09-12 08:53:37	2017-09-12 08:53:37
18	2017-09-12 09:10:17	2017-09-12 09:10:17
19	2017-09-12 10:41:23	2017-09-12 10:41:23
20	2017-09-12 10:42:09	2017-09-12 10:42:09
21	2017-09-12 10:42:31	2017-09-12 10:42:31
22	2017-09-12 10:42:42	2017-09-12 10:42:42
23	2017-09-12 10:42:58	2017-09-12 10:42:58
24	2017-09-12 10:43:09	2017-09-12 10:43:09
25	2017-09-12 10:43:49	2017-09-12 10:43:49
26	2017-09-12 10:44:13	2017-09-12 10:44:13
27	2017-09-12 10:44:25	2017-09-12 10:44:25
28	2017-09-12 10:44:55	2017-09-12 10:44:55
29	2017-09-12 10:45:21	2017-09-12 10:45:21
30	2017-09-12 10:45:35	2017-09-12 10:45:35
\.


--
-- TOC entry 2482 (class 0 OID 0)
-- Dependencies: 226
-- Name: text_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('text_id_seq', 30, false);


--
-- TOC entry 2446 (class 0 OID 18680)
-- Dependencies: 227
-- Data for Name: text_translation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY text_translation (id, source_id, locale_id, text, date_of_creation, date_of_change) FROM stdin;
1	1	1	Информация	2017-09-12 07:38:07	2017-09-12 07:38:07
2	2	1	Преимущества	2017-09-12 07:40:00	2017-09-12 07:40:00
3	3	1	Кто использует	2017-09-12 08:19:56	2017-09-12 08:19:56
4	4	1	Загрузить	2017-09-12 08:23:42	2017-09-12 08:23:42
5	5	1	Новости	2017-09-12 08:23:58	2017-09-12 08:23:58
6	6	1	Документация	2017-09-12 08:24:20	2017-09-12 08:24:20
7	7	1	Компоненты платформы	2017-09-12 08:24:54	2017-09-12 08:24:54
8	8	1	Основные преимущества	2017-09-12 08:25:16	2017-09-12 08:25:16
9	9	1	Кто использует	2017-09-12 08:25:33	2017-09-12 08:25:33
10	10	1	Загрузить	2017-09-12 08:25:45	2017-09-12 08:25:45
11	11	1	Выберите подходящий вам способ загрузки и версию	2017-09-12 08:25:57	2017-09-12 08:25:57
12	12	1	Стабильная версия	2017-09-12 08:49:13	2017-09-12 08:49:13
13	13	1	Новейшая версия	2017-09-12 08:49:29	2017-09-12 08:49:29
14	14	1	Исходный код	2017-09-12 08:49:43	2017-09-12 08:49:43
15	15	1	Рекомендовано для установки на рабочих проектах	2017-09-12 08:51:04	2017-09-12 08:51:04
18	18	1	Дистрибутив последней стабильной версии платформы	2017-09-12 09:10:17	2017-09-12 09:10:17
19	19	1	Дистрибутив последней новейшей версии платформы	2017-09-12 10:41:23	2017-09-12 10:41:23
20	20	1	Показать компоненты сборки	2017-09-12 10:42:09	2017-09-12 10:42:09
21	21	1	История версий	2017-09-12 10:42:31	2017-09-12 10:42:31
22	22	1	Полная история версий	2017-09-12 10:42:42	2017-09-12 10:42:42
23	23	1	Последние новости	2017-09-12 10:42:58	2017-09-12 10:42:58
24	24	1	Хотите быть в курсе последних событий?	2017-09-12 10:43:09	2017-09-12 10:43:09
25	25	1	Подпишитесь на нашу рассылку и получайте уведомления на свой почтовый адрес	2017-09-12 10:43:49	2017-09-12 10:43:49
26	26	1	Ваш email	2017-09-12 10:44:13	2017-09-12 10:44:13
27	27	1	Мы не будем присылать спам и не передадим ваш email третьим лицам	2017-09-12 10:44:25	2017-09-12 10:44:25
28	28	1	Перейти в группу новостей	2017-09-12 10:44:55	2017-09-12 10:44:55
30	30	1	КУРС © 1998-2017	2017-09-12 10:45:35	2017-09-12 10:45:35
32	1	2	Information	2017-09-13 01:55:35	2017-09-13 01:55:35
34	2	2	Advantages	2017-09-13 01:55:54	2017-09-13 01:55:54
36	3	2	Customers	2017-09-15 09:25:56	2017-09-15 09:25:56
38	4	2	Download	2017-09-15 09:26:08	2017-09-15 09:26:08
40	5	2	News	2017-09-15 09:26:13	2017-09-15 09:26:13
42	6	2	Documentation	2017-09-15 09:26:20	2017-09-15 09:26:20
44	7	2	Platform components	2017-09-15 09:26:33	2017-09-15 09:26:33
46	8	2	Main advantages	2017-09-15 09:26:48	2017-09-15 09:26:48
48	9	2	Customers	2017-09-15 09:26:53	2017-09-15 09:26:53
50	10	2	Download	2017-09-15 09:27:03	2017-09-15 09:27:03
52	11	2	Select the download method and version	2017-09-15 09:27:18	2017-09-15 09:27:18
54	12	2	Stable version	2017-09-15 09:27:32	2017-09-15 09:27:32
56	13	2	Newest version	2017-09-15 09:27:43	2017-09-15 09:27:43
58	14	2	Source code	2017-09-15 09:27:48	2017-09-15 09:27:48
60	15	2	Recommended to use on live project	2017-09-15 09:28:41	2017-09-15 09:28:41
62	16	2	Recommended to use on projects in development	2017-09-15 09:28:54	2017-09-15 09:28:54
16	16	1	Рекомендовано для установки на проектах в разработке	2017-09-12 08:51:16	2017-09-12 08:51:16
64	17	2	There are many sources where you can download our source code. Please contact us if you want to participate in development. We will provide you the "write" access.	2017-09-15 09:30:46	2017-09-15 09:30:46
66	18	2	Download latest stable version	2017-09-15 09:31:25	2017-09-15 09:31:25
68	19	2	Download newest version	2017-09-15 09:31:38	2017-09-15 09:31:38
70	20	2	Show components	2017-09-15 09:31:49	2017-09-15 09:31:49
72	21	2	Versions history	2017-09-15 09:32:03	2017-09-15 09:32:03
74	22	2	Full versions history	2017-09-15 09:32:15	2017-09-15 09:32:15
76	23	2	Latest news	2017-09-15 09:32:27	2017-09-15 09:32:27
78	24	2	Want to know about latest events?	2017-09-15 09:32:49	2017-09-15 09:32:49
80	25	2	Subscribe our mailing and receive all news to your email	2017-09-15 09:34:01	2017-09-15 09:34:01
82	26	2	Your email	2017-09-15 09:34:09	2017-09-15 09:34:09
84	27	2	We will not spam you and will not distribute your email	2017-09-15 09:34:31	2017-09-15 09:34:31
86	28	2	To news group	2017-09-15 09:34:43	2017-09-15 09:34:43
88	29	2	CURS platform components are the free software with open source code distributed by GPL v. 3 licence.	2017-09-15 09:35:40	2017-09-15 09:35:40
90	30	2	CURS © 1998-2017	2017-09-15 09:35:52	2017-09-15 09:35:52
29	29	1	Компоненты платформы КУРС являются свободным программным обеспечением<br>с открытым исходным кодом, распространяемым по лицензии GPL v. 3.	2017-09-12 10:45:21	2017-09-12 10:45:21
17	17	1	Есть много источников, откуда вы можете скачать наши исходные коды.<br>Свяжитесь с нами, если хотите участвовать в разработке: мы дадим вам доступ на запись.	2017-09-12 08:53:37	2017-09-12 08:53:37
\.


--
-- TOC entry 2483 (class 0 OID 0)
-- Dependencies: 228
-- Name: text_translation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('text_translation_id_seq', 90, true);


--
-- TOC entry 2448 (class 0 OID 18689)
-- Dependencies: 229
-- Data for Name: version; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY version (id, type, date_of_creation, date_of_change, version) FROM stdin;
1	Стабильная	2017-08-15 11:50:19	2017-08-15 11:50:19	2.0
2	Новейшая	2017-08-15 11:53:32	2017-08-15 11:53:32	8.1
\.


--
-- TOC entry 2484 (class 0 OID 0)
-- Dependencies: 230
-- Name: version_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('version_id_seq', 3, true);



--
-- TOC entry 2196 (class 2606 OID 18697)
-- Name: advantage advantage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advantage
    ADD CONSTRAINT advantage_pkey PRIMARY KEY (id);


--
-- TOC entry 2198 (class 2606 OID 18699)
-- Name: advantage_translation advantage_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advantage_translation
    ADD CONSTRAINT advantage_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2202 (class 2606 OID 18701)
-- Name: client client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- TOC entry 2204 (class 2606 OID 18703)
-- Name: client_translation client_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY client_translation
    ADD CONSTRAINT client_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2208 (class 2606 OID 18705)
-- Name: common_information common_information_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY common_information
    ADD CONSTRAINT common_information_pkey PRIMARY KEY (id);


--
-- TOC entry 2210 (class 2606 OID 18707)
-- Name: common_information_translation common_information_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY common_information_translation
    ADD CONSTRAINT common_information_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2214 (class 2606 OID 18709)
-- Name: company_information company_information_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_information
    ADD CONSTRAINT company_information_pkey PRIMARY KEY (id);


--
-- TOC entry 2216 (class 2606 OID 18711)
-- Name: company_information_translation company_information_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_information_translation
    ADD CONSTRAINT company_information_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2220 (class 2606 OID 18713)
-- Name: component component_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY component
    ADD CONSTRAINT component_pkey PRIMARY KEY (id);


--
-- TOC entry 2222 (class 2606 OID 18715)
-- Name: component_translation component_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY component_translation
    ADD CONSTRAINT component_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2226 (class 2606 OID 18717)
-- Name: feed feed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed
    ADD CONSTRAINT feed_pkey PRIMARY KEY (id);


--
-- TOC entry 2229 (class 2606 OID 18719)
-- Name: feed_source feed_source_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed_source
    ADD CONSTRAINT feed_source_pkey PRIMARY KEY (id);


--
-- TOC entry 2232 (class 2606 OID 18721)
-- Name: feed_status feed_status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed_status
    ADD CONSTRAINT feed_status_pkey PRIMARY KEY (id);


--
-- TOC entry 2235 (class 2606 OID 18723)
-- Name: locale locale_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY locale
    ADD CONSTRAINT locale_pkey PRIMARY KEY (id);


--
-- TOC entry 2263 (class 2606 OID 18925)
-- Name: phinxlog phinxlog_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY phinxlog
    ADD CONSTRAINT phinxlog_pkey PRIMARY KEY (version);


--
-- TOC entry 2240 (class 2606 OID 18725)
-- Name: source_link source_link_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link
    ADD CONSTRAINT source_link_pkey PRIMARY KEY (id);


--
-- TOC entry 2245 (class 2606 OID 18727)
-- Name: source_link_translation source_link_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link_translation
    ADD CONSTRAINT source_link_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2237 (class 2606 OID 18729)
-- Name: source source_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source
    ADD CONSTRAINT source_pkey PRIMARY KEY (id);


--
-- TOC entry 2249 (class 2606 OID 18731)
-- Name: source_translation source_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_translation
    ADD CONSTRAINT source_translation_pkey PRIMARY KEY (id);


--
-- TOC entry 2251 (class 2606 OID 18733)
-- Name: subscriber subscriber_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subscriber
    ADD CONSTRAINT subscriber_pkey PRIMARY KEY (id);


--
-- TOC entry 2253 (class 2606 OID 18735)
-- Name: system_user system_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY system_user
    ADD CONSTRAINT system_user_pkey PRIMARY KEY (id);


--
-- TOC entry 2255 (class 2606 OID 18737)
-- Name: text text_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY text
    ADD CONSTRAINT text_pkey PRIMARY KEY (id);


--
-- TOC entry 2259 (class 2606 OID 18739)
-- Name: text_translation text_translation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY text_translation
    ADD CONSTRAINT text_translation_pkey PRIMARY KEY (id);




--
-- TOC entry 2261 (class 2606 OID 18741)
-- Name: version version_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY version
    ADD CONSTRAINT version_pkey PRIMARY KEY (id);


--
-- TOC entry 2227 (class 1259 OID 18742)
-- Name: idx_234044abddaeffbd; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_234044abddaeffbd ON feed USING btree (feed_source_id);


--
-- TOC entry 2238 (class 1259 OID 18743)
-- Name: idx_37261cf2953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_37261cf2953c1c61 ON source_link USING btree (source_id);


--
-- TOC entry 2211 (class 1259 OID 18744)
-- Name: idx_4cddd1af953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4cddd1af953c1c61 ON common_information_translation USING btree (source_id);


--
-- TOC entry 2212 (class 1259 OID 18745)
-- Name: idx_4cddd1afe559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_4cddd1afe559dfd1 ON common_information_translation USING btree (locale_id);


--
-- TOC entry 2246 (class 1259 OID 18746)
-- Name: idx_881615cf953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_881615cf953c1c61 ON source_translation USING btree (source_id);


--
-- TOC entry 2247 (class 1259 OID 18747)
-- Name: idx_881615cfe559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_881615cfe559dfd1 ON source_translation USING btree (locale_id);


--
-- TOC entry 2199 (class 1259 OID 18748)
-- Name: idx_980b52bb953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_980b52bb953c1c61 ON advantage_translation USING btree (source_id);


--
-- TOC entry 2200 (class 1259 OID 18749)
-- Name: idx_980b52bbe559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_980b52bbe559dfd1 ON advantage_translation USING btree (locale_id);


--
-- TOC entry 2230 (class 1259 OID 18750)
-- Name: idx_9da80f87e559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_9da80f87e559dfd1 ON feed_source USING btree (locale_id);


--
-- TOC entry 2256 (class 1259 OID 18751)
-- Name: idx_a42fc53c953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a42fc53c953c1c61 ON text_translation USING btree (source_id);


--
-- TOC entry 2257 (class 1259 OID 18752)
-- Name: idx_a42fc53ce559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_a42fc53ce559dfd1 ON text_translation USING btree (locale_id);


--
-- TOC entry 2205 (class 1259 OID 18753)
-- Name: idx_b5226054953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b5226054953c1c61 ON client_translation USING btree (source_id);


--
-- TOC entry 2206 (class 1259 OID 18754)
-- Name: idx_b5226054e559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b5226054e559dfd1 ON client_translation USING btree (locale_id);


--
-- TOC entry 2233 (class 1259 OID 18755)
-- Name: idx_b92215e8e559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_b92215e8e559dfd1 ON feed_status USING btree (locale_id);


--
-- TOC entry 2223 (class 1259 OID 18756)
-- Name: idx_ee7028ec953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ee7028ec953c1c61 ON component_translation USING btree (source_id);


--
-- TOC entry 2224 (class 1259 OID 18757)
-- Name: idx_ee7028ece559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ee7028ece559dfd1 ON component_translation USING btree (locale_id);


--
-- TOC entry 2241 (class 1259 OID 18758)
-- Name: idx_ee9d0f9a3fd34780; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ee9d0f9a3fd34780 ON source_link_translation USING btree (source_translation_id);


--
-- TOC entry 2242 (class 1259 OID 18759)
-- Name: idx_ee9d0f9a953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ee9d0f9a953c1c61 ON source_link_translation USING btree (source_id);


--
-- TOC entry 2243 (class 1259 OID 18760)
-- Name: idx_ee9d0f9ae559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_ee9d0f9ae559dfd1 ON source_link_translation USING btree (locale_id);


--
-- TOC entry 2217 (class 1259 OID 18761)
-- Name: idx_f29d8edc953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f29d8edc953c1c61 ON company_information_translation USING btree (source_id);


--
-- TOC entry 2218 (class 1259 OID 18762)
-- Name: idx_f29d8edce559dfd1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_f29d8edce559dfd1 ON company_information_translation USING btree (locale_id);


--
-- TOC entry 2276 (class 2606 OID 18763)
-- Name: feed fk_234044abddaeffbd; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed
    ADD CONSTRAINT fk_234044abddaeffbd FOREIGN KEY (feed_source_id) REFERENCES feed_source(id);


--
-- TOC entry 2279 (class 2606 OID 18768)
-- Name: source_link fk_37261cf2953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link
    ADD CONSTRAINT fk_37261cf2953c1c61 FOREIGN KEY (source_id) REFERENCES source(id);


--
-- TOC entry 2270 (class 2606 OID 18773)
-- Name: common_information_translation fk_4cddd1af953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY common_information_translation
    ADD CONSTRAINT fk_4cddd1af953c1c61 FOREIGN KEY (source_id) REFERENCES common_information(id);


--
-- TOC entry 2271 (class 2606 OID 18778)
-- Name: common_information_translation fk_4cddd1afe559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY common_information_translation
    ADD CONSTRAINT fk_4cddd1afe559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2283 (class 2606 OID 18783)
-- Name: source_translation fk_881615cf953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_translation
    ADD CONSTRAINT fk_881615cf953c1c61 FOREIGN KEY (source_id) REFERENCES source(id);


--
-- TOC entry 2284 (class 2606 OID 18788)
-- Name: source_translation fk_881615cfe559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_translation
    ADD CONSTRAINT fk_881615cfe559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2266 (class 2606 OID 18793)
-- Name: advantage_translation fk_980b52bb953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advantage_translation
    ADD CONSTRAINT fk_980b52bb953c1c61 FOREIGN KEY (source_id) REFERENCES advantage(id);


--
-- TOC entry 2267 (class 2606 OID 18798)
-- Name: advantage_translation fk_980b52bbe559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advantage_translation
    ADD CONSTRAINT fk_980b52bbe559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2277 (class 2606 OID 18803)
-- Name: feed_source fk_9da80f87e559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed_source
    ADD CONSTRAINT fk_9da80f87e559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2285 (class 2606 OID 18808)
-- Name: text_translation fk_a42fc53c953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY text_translation
    ADD CONSTRAINT fk_a42fc53c953c1c61 FOREIGN KEY (source_id) REFERENCES text(id);


--
-- TOC entry 2286 (class 2606 OID 18813)
-- Name: text_translation fk_a42fc53ce559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY text_translation
    ADD CONSTRAINT fk_a42fc53ce559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2268 (class 2606 OID 18818)
-- Name: client_translation fk_b5226054953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY client_translation
    ADD CONSTRAINT fk_b5226054953c1c61 FOREIGN KEY (source_id) REFERENCES client(id);


--
-- TOC entry 2269 (class 2606 OID 18823)
-- Name: client_translation fk_b5226054e559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY client_translation
    ADD CONSTRAINT fk_b5226054e559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2278 (class 2606 OID 18828)
-- Name: feed_status fk_b92215e8e559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed_status
    ADD CONSTRAINT fk_b92215e8e559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2274 (class 2606 OID 18833)
-- Name: component_translation fk_ee7028ec953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY component_translation
    ADD CONSTRAINT fk_ee7028ec953c1c61 FOREIGN KEY (source_id) REFERENCES component(id);


--
-- TOC entry 2275 (class 2606 OID 18838)
-- Name: component_translation fk_ee7028ece559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY component_translation
    ADD CONSTRAINT fk_ee7028ece559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2280 (class 2606 OID 18843)
-- Name: source_link_translation fk_ee9d0f9a3fd34780; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link_translation
    ADD CONSTRAINT fk_ee9d0f9a3fd34780 FOREIGN KEY (source_translation_id) REFERENCES source_translation(id);


--
-- TOC entry 2281 (class 2606 OID 18848)
-- Name: source_link_translation fk_ee9d0f9a953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link_translation
    ADD CONSTRAINT fk_ee9d0f9a953c1c61 FOREIGN KEY (source_id) REFERENCES source_link(id);


--
-- TOC entry 2282 (class 2606 OID 18853)
-- Name: source_link_translation fk_ee9d0f9ae559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link_translation
    ADD CONSTRAINT fk_ee9d0f9ae559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


--
-- TOC entry 2272 (class 2606 OID 18858)
-- Name: company_information_translation fk_f29d8edc953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_information_translation
    ADD CONSTRAINT fk_f29d8edc953c1c61 FOREIGN KEY (source_id) REFERENCES company_information(id);


--
-- TOC entry 2273 (class 2606 OID 18863)
-- Name: company_information_translation fk_f29d8edce559dfd1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_information_translation
    ADD CONSTRAINT fk_f29d8edce559dfd1 FOREIGN KEY (locale_id) REFERENCES locale(id);


GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO corchestra_db_user;

-- Completed on 2018-02-17 12:35:23

--
-- PostgreSQL database dump complete
--

