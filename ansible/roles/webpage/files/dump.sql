--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.8
-- Dumped by pg_dump version 9.5.8

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: advantage; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE advantage (
    id integer NOT NULL,
    image_name character varying(255) DEFAULT NULL::character varying,
    description text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE advantage OWNER TO postgres;

--
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
-- Name: client; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE client (
    id integer NOT NULL,
    gray_scale_image_name character varying(255) DEFAULT NULL::character varying,
    color_image_name character varying(255) DEFAULT NULL::character varying,
    title text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE client OWNER TO postgres;

--
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
-- Name: common_information; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE common_information (
    id integer NOT NULL,
    title character varying(1024) DEFAULT NULL::character varying,
    description text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE common_information OWNER TO postgres;

--
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
-- Name: company_information; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE company_information (
    id integer NOT NULL,
    description text,
    address character varying(512) DEFAULT NULL::character varying,
    email character varying(128) DEFAULT NULL::character varying,
    phone_number character varying(32) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE company_information OWNER TO postgres;

--
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
-- Name: component; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE component (
    id integer NOT NULL,
    name character varying(128) DEFAULT NULL::character varying,
    description text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    wiki_url character varying(1024) DEFAULT NULL::character varying
);


ALTER TABLE component OWNER TO postgres;

--
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
-- Name: feed; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed (
    id integer NOT NULL,
    link character varying(256) DEFAULT NULL::character varying,
    public_id character varying(256) DEFAULT NULL::character varying,
    title character varying(1024) DEFAULT NULL::character varying,
    text text,
    author character varying(128) DEFAULT NULL::character varying,
    last_modified timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    status character varying(255) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    feed_source_id integer
);


ALTER TABLE feed OWNER TO postgres;

--
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
-- Name: feed_source; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed_source (
    id integer NOT NULL,
    url character varying(256) DEFAULT NULL::character varying,
    public_id character varying(256) DEFAULT NULL::character varying,
    title character varying(1024) DEFAULT NULL::character varying,
    description text,
    last_modified timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    link character varying(256) DEFAULT NULL::character varying,
    selected boolean
);


ALTER TABLE feed_source OWNER TO postgres;

--
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
-- Name: feed_status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE feed_status (
    id integer NOT NULL,
    name character varying(32) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE feed_status OWNER TO postgres;

--
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
-- Name: source; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE source (
    id integer NOT NULL,
    title character varying(64) DEFAULT NULL::character varying,
    subtitle character varying(128) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE source OWNER TO postgres;

--
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
-- Name: source_link; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE source_link (
    id integer NOT NULL,
    source_id integer,
    name character varying(64) DEFAULT NULL::character varying,
    url character varying(1024) DEFAULT NULL::character varying,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL
);


ALTER TABLE source_link OWNER TO postgres;

--
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
    roles text,
    date_of_creation timestamp(0) without time zone NOT NULL,
    date_of_change timestamp(0) without time zone NOT NULL,
    subscribed_to_feed boolean
);


ALTER TABLE system_user OWNER TO postgres;

--
-- Name: COLUMN system_user.roles; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN system_user.roles IS '(DC2Type:array)';


--
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
-- Data for Name: advantage; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY advantage (id, image_name, description, date_of_creation, date_of_change) FROM stdin;
2	59a7da7ae91d3206469355.png	Мы поддерживаем SQL Server, Oracle, PostgreSQL и H2	2017-08-09 14:41:19	2017-08-31 12:44:26
3	59a7da8424013950497815.png	Автоматическое обновление структуры базы данных через идемпотентный DDL	2017-08-09 14:42:01	2017-08-31 12:44:36
4	59a7da8cbbfd6742400517.png	CelestaUnit: быстрое и лёгкое модульное тестирование процедур обработки данных	2017-08-09 14:42:54	2017-08-31 12:44:44
1	59a7da72018a4255401936.png	CelestaSQL: код бизнес-логики не зависит от типа базы данных	2017-08-09 14:40:10	2017-09-01 09:58:19
6	59a9f3ec14f1e551064237.png	Эффективный механизм аутентификации и распределения прав доступа	2017-08-09 14:45:46	2017-09-01 23:57:32
7	59a9f41da2e10507172846.png	Поддержка сервис-ориентированной архитектуры	2017-08-09 14:46:38	2017-09-01 23:58:21
\.


--
-- Name: advantage_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('advantage_id_seq', 9, true);


--
-- Data for Name: client; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY client (id, gray_scale_image_name, color_image_name, title, date_of_creation, date_of_change) FROM stdin;
31	\N	59a7da31070d0998372685.png	ОТКРЫТИЕ	2017-08-28 14:12:33	2017-08-31 12:43:13
33	\N	59a7da3ebdca4326449787.png	ВТБ	2017-08-28 14:13:14	2017-08-31 12:43:26
34	\N	59a7da4df11c7299589398.png	РНИМУ	2017-08-28 14:13:39	2017-08-31 12:43:41
35	\N	59a7da589b85d636089654.png	РОСТРАНСНАДЗОР	2017-08-28 14:13:52	2017-08-31 12:43:52
36	\N	59a7da64a552a549988330.png	МИНЗДРАВ	2017-08-28 17:26:47	2017-08-31 12:44:04
30	\N	59a97add9c1ef218078846.png	KELVION	2017-08-28 14:12:13	2017-09-01 15:21:01
\.


--
-- Name: client_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('client_id_seq', 36, true);


--
-- Data for Name: common_information; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY common_information (id, title, description, date_of_creation, date_of_change) FROM stdin;
1	Открытая платформа для разработки бизнес-приложений с веб-интерфейсом	Разработав бизнес-приложение, запускайте его на той РСУБД, <a href="https://corchestra.ru/wiki/index.php?title=Особенности_работы_Celesta_с_поддерживаемыми_типами_СУБД" target="_blank">которую предпочитает ваш заказчик</a>.</br>\r\n<a href="https://corchestra.ru/wiki/index.php?title=Проектирование_базы_данных_Celesta_в_DBSchema"  target="_blank">Визуально проектируйте</a> таблицы базы данных на <a href="https://corchestra.ru/wiki/index.php?title=Язык_Celesta-SQL" target="_blank">языке CelestaSQL</a>.</br>\r\nБыстро создавайте <a href="https://corchestra.ru/wiki/index.php?title=Lyra" target="_blank">экранные формы</a>, связанные с данными таблицы.<br/>\r\n<a href="https://corchestra.ru/wiki/index.php?title=Xylophone" target="_blank">Выводите отчёты</a> в форматах Excel, PDF и напрямую на принтер.	2017-08-10 06:03:10	2017-08-10 06:03:10
\.


--
-- Name: common_information_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('common_information_id_seq', 1, true);


--
-- Data for Name: company_information; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY company_information (id, description, address, email, phone_number, date_of_creation, date_of_change) FROM stdin;
1	Группа компаний «КУРС» с 1998 года активно работает на российском рынке информационных и консультационных услуг, как в корпоративном, так и в государственном секторе.	111020, Москва, Боровая ул., дом 7, корп. 2	info@curs.ru	+7 (495) 640-27-72	2017-08-10 08:41:32	2017-08-10 08:41:32
\.


--
-- Name: company_information_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('company_information_id_seq', 2, true);


--
-- Data for Name: component; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY component (id, name, description, date_of_creation, date_of_change, wiki_url) FROM stdin;
1	Showcase	Конструирование веб-интерфейса бизнес-систем, работающего в Java Servlet Container	2017-08-09 14:49:24	2017-08-09 14:49:24	https://corchestra.ru/wiki/index.php?title=Showcase
2	Celesta	Разработка приложений в условиях меняющихся требований бизнеса на языке Jython с использованием реляционной базы данных	2017-08-09 14:49:56	2017-08-09 14:49:56	https://corchestra.ru/wiki/index.php?title=Celesta
3	Flute	REST-сервисы, обработчики очередей и периодические задания на базе Celesta-процедур	2017-08-09 14:50:26	2017-08-09 14:50:26	https://corchestra.ru/wiki/index.php?title=Flute
7	Xylophone	Формирование печатных и форм и документов	2017-08-09 14:51:46	2017-08-09 14:51:46	https://corchestra.ru/wiki/index.php?title=Xylophone
5	Mellophone	Модуль аутентификации пользователей	2017-08-09 14:51:04	2017-08-09 14:51:04	https://corchestra.ru/wiki/index.php?title=Mellophone
\.


--
-- Name: component_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('component_id_seq', 8, true);


--
-- Data for Name: feed; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed (id, link, public_id, title, text, author, last_modified, status, date_of_creation, date_of_change, feed_source_id) FROM stdin;
3	https://groups.google.com/d/msg/curs-group/C0s-hodtp74/bh3kAPo4AgAJ	https://groups.google.com/d/topic/curs-group/C0s-hodtp74	Celesta: setIn (вложенные фильтры)	Уважаемые коллеги, в класс BasicCursor Celesta добавился новый метод фильтрации: setIn, который позволяет установить фильтр с вложенным запросом по указанному набору полей. Для чего он нужен? Хорошо знакомый метод setFilter позволяет фильтровать записи, некоторое поле которых принимает любое	\nIvan Ponomarev	2017-06-12 00:19:24	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
4	https://groups.google.com/d/msg/curs-group/w_sBvgw3CEI/Ps1Au_AxAQAJ	https://groups.google.com/d/topic/curs-group/w_sBvgw3CEI	В Celesta добавлена возможность асинхронного вызова python функций	Класс ru.curs.celesta.Celesta пополнился двумя методами с наименованием runPythonAsync. Они принимают те же параметры, что и runPython и возвращают Future<PyObject> (Future из пакета java.util.concurrent) -- С уважением, Иван Головко	\nioanngolovko	2017-06-08 15:59:13	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
15	https://groups.google.com/d/msg/curs-group/E9uXjlDlaw8/D6BeaR75AwAJ	https://groups.google.com/d/topic/curs-group/E9uXjlDlaw8	В Celesta-SQL добавлены агрегатные функции	В Celesta-SQL были добавлены следующие конструкции: 1. COUNT(*) 2. SUM 3. MIN 4. MAX 5. GROUP BY Эти конструкции можно использовать при создании View, например: - CREATE VIEW testView1 AS select sum (f1 * 2 + f2) as sumv, f3 from testTable group by f3; - CREATE VIEW	\nioanngolovko	2017-05-30 11:51:59	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
14	https://groups.google.com/d/msg/curs-group/-r0ut7yjlgw/6CdCQ2GCBgAJ	https://groups.google.com/d/topic/curs-group/-r0ut7yjlgw	Celesta теперь поддерживает триггеры для системных курсоров	Всем доброго времени суток. В Celesta добавлена возможность регистрировать триггеры для системных курсоров. Регистрация триггеров на системные курсоры отличается от курсоров, сгенерированных в Jython модули. В каждый системный курсор добавлены статические методы для регистрации триггеров	\nioanngolovko	2017-05-31 20:23:15	Отклонена	2017-08-11 20:06:43	2017-08-11 20:06:43	1
13	https://groups.google.com/d/msg/curs-group/B9lUYCxEAoU/ogz9dajQBgAJ	https://groups.google.com/d/topic/curs-group/B9lUYCxEAoU	Опрос: что из этих двух фич вы хотели бы видеть во Flute/Celesta?	Уважаемые коллеги! Некоторое время назад вашим решением была оставлена поддержка SQL Server2008, и вот снова нам важно ваше мнение. Какую из двух перечисленных доработок платформы вы считаете более нужной/перспективной? Поясню ситуацию. Для решения некоторой задачи на проекте М. без доработок	\nIvan Ponomarev	2017-06-01 20:17:42	На модерации	2017-08-11 20:06:43	2017-08-11 20:06:43	1
1	https://groups.google.com/d/msg/curs-group/w9-WlUP5fLE/KLt_UfUhBQAJ	https://groups.google.com/d/topic/curs-group/w9-WlUP5fLE	Новости платформы Курс. Добавлена возможность задания списка столбцов для курсоров celesta	Уважаемые пользователи платформы Курс. Теперь в trunk релизе платформы Курс Celesta поддерживает возможность задания списка столбцов при выборке записей через курсоры celesta. Данный функционал позволит снизить нагрузку на базу данных решения (БД) и сеть, так как из базы будут выбираться данные	\nioanngolovko	2017-08-03 08:46:41	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
2	https://groups.google.com/d/msg/curs-group/nkU5aZlHTO0/NXDGNfDoAAAJ	https://groups.google.com/d/topic/curs-group/nkU5aZlHTO0	Новости платформы Курс: реализована поддержка материализованных представлений (Materialized View) в celesta	Уважаемые пользователи платформы Курс. С 25 июля синтаксис CelestaSQL поддерживает материализованные представления - Materialized View. Материализованное представление - физический объект базы данных, содержащий результат выполнения запроса. Материализованные представления позволяют существенно	\nioanngolovko	2017-07-26 12:22:11	Опубликована	2017-08-11 20:06:43	2017-08-11 20:06:43	1
17	https://groups.google.com/d/msg/curs-group/GHHtElD3Zl8/TYjWQgB0AgAJ	https://groups.google.com/d/topic/curs-group/GHHtElD3Zl8	Обновление сайта платформы и wiki	Уважаемые коллеги, официально объявляю о состоявшемся запуске 1. новой версии сайта платформы КУРС (https://corchestra.ru/) 2. новой версии wiki (https://corchestra.ru/wiki), которая теперь является полноценной частью сайта платформы. Добро пожаловать! Старая wiki переведена в	\nIvan Ponomarev	2017-09-02 16:27:03	На модерации	2017-09-04 10:00:03	2017-09-04 10:00:03	1
16	https://groups.google.com/d/msg/curs-group/Oe3TfGji4qI/0UG6WcC9CQAJ	https://groups.google.com/d/topic/curs-group/Oe3TfGji4qI	Регистрация в едином реестре российских программ	Платформа Курс включена в единый реестр российских программ для электронных вычислительных машин и баз данных под номером 3926 (приказ Минкомсвязи России от 15.08.2017 №421, приложение 2, пп.29)	\nNickolay Potashnikoff	2017-09-03 09:04:25	Опубликована	2017-09-04 10:00:03	2017-09-04 10:00:03	1
18	https://groups.google.com/d/msg/curs-group/9Akg7gyvzYE/GBmH7GX8AgAJ	https://groups.google.com/d/topic/curs-group/9Akg7gyvzYE	Статья на habrahabr	Уважаемые коллеги, о Celesta и Flute опубликована большая статья на Habrahabr: https://habrahabr.ru/post/335966/	\nIvan Ponomarev	2017-09-04 10:06:33	Опубликована	2017-09-04 10:20:03	2017-09-04 10:20:03	1
\.


--
-- Name: feed_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_id_seq', 18, true);


--
-- Data for Name: feed_source; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed_source (id, url, public_id, title, description, last_modified, date_of_creation, date_of_change, link, selected) FROM stdin;
1	https://groups.google.com/forum/feed/curs-group/msgs/rss.xml	https://groups.google.com/d/forum/curs-group	curs-group	Новости и техническая поддержка платформы КУРС<br><a href="https://share.curs.ru/wiki/">https://share.curs.ru/wiki/</a>	1970-01-01 00:00:00	2017-08-11 13:55:13	2017-08-11 13:55:13	https://groups.google.com/d/forum/curs-group	t
2	https://groups.google.com/forum/feed/curs-group/msgs/atom.xml	https://groups.google.com/d/forum/curs-group	curs-group	\N	2017-08-27 16:39:38	2017-08-24 21:50:06	2017-08-24 21:50:06	https://groups.google.com/forum/feed/curs-group/msgs/atom_v1_0.xml	f
\.


--
-- Name: feed_source_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_source_id_seq', 3, true);


--
-- Data for Name: feed_status; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY feed_status (id, name, date_of_creation, date_of_change) FROM stdin;
1	На модерации	2017-08-11 17:08:04	2017-08-11 17:08:04
2	Опубликована	2017-08-11 17:08:11	2017-08-11 17:08:11
3	Отклонена	2017-08-11 17:08:17	2017-08-11 17:08:17
\.


--
-- Name: feed_status_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('feed_status_id_seq', 3, true);


--
-- Data for Name: source; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY source (id, title, subtitle, date_of_creation, date_of_change) FROM stdin;
1	С сайта компании КУРС	Master SVN | user: reader | pwd: reader	2017-08-25 14:15:00	2017-08-25 14:15:00
2	Lancelot-it.ru	Primary read-only copy | user: reader | pwd: platform	2017-08-25 14:17:12	2017-08-25 14:17:12
3	code.sf.net	Secondary read-only copy (sourceforge.net, anonymous access)	2017-08-25 14:21:04	2017-08-25 14:21:04
\.


--
-- Name: source_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('source_id_seq', 4, true);


--
-- Data for Name: source_link; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY source_link (id, source_id, name, url, date_of_creation, date_of_change) FROM stdin;
1	1	Celesta	https://share.curs.ru/svn/celesta/	2017-08-25 14:15:00	2017-08-25 14:15:00
2	1	Flute (включая XML2Spreadsheet)	https://share.curs.ru/svn/flute/	2017-08-25 14:15:00	2017-08-25 14:15:00
3	1	grains (системная библиотека Celesta)	https://share.curs.ru/svn/grains/	2017-08-25 14:15:00	2017-08-25 14:15:00
16	1	Mellophone	https://share.curs.ru/svn/mellophone/	2017-08-27 15:58:29	2017-08-27 15:58:29
4	1	Showcase	https://share.curs.ru/svn/showcase/	2017-08-25 14:15:00	2017-08-25 14:15:00
5	2	Celesta	https://svn.lancelot-it.ru:8420/svn/celesta/	2017-08-25 14:17:12	2017-08-25 14:17:12
6	2	Flute (включая XML2Spreadsheet)	https://svn.lancelot-it.ru:8420/svn/flute/	2017-08-25 14:17:12	2017-08-25 14:17:12
7	2	grains (системная библиотека Celesta)	https://svn.lancelot-it.ru:8420/svn/grains/	2017-08-25 14:17:12	2017-08-25 14:17:12
8	2	Mellophone	https://svn.lancelot-it.ru:8420/svn/mellophone/	2017-08-25 14:17:12	2017-08-25 14:17:12
9	2	Showcase	https://svn.lancelot-it.ru:8420/svn/showcase/	2017-08-25 14:17:12	2017-08-25 14:17:12
10	3	Celesta	https://svn.code.sf.net/p/kurs-celesta/code/	2017-08-25 14:21:04	2017-08-25 14:21:04
11	3	Flute (включая XML2Spreadsheet)	https://svn.code.sf.net/p/kurs-flute/code/	2017-08-25 14:21:04	2017-08-25 14:21:04
12	3	grains (системная библиотека Celesta)	https://svn.code.sf.net/p/kurs-grains/code/	2017-08-25 14:21:04	2017-08-25 14:21:04
13	3	Mellophone	https://svn.code.sf.net/p/kurs-mellophone/code/	2017-08-25 14:21:04	2017-08-25 14:21:04
\.


--
-- Name: source_link_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('source_link_id_seq', 16, true);


--
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
-- Name: subscriber_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subscriber_id_seq', 9, true);


--
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
1	admin	\N	admin@admin.admin	\N	t	\N	$2y$13$PA3GfctcBi04jrdr6xVF5On3E.i8sVGLGF8jbWKlb3WoovwUVpJne	\N	a:1:{i:0;s:10:"ROLE_ADMIN";}	2017-08-09 03:11:01	2017-08-09 03:11:01	\N
\.


--
-- Name: system_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('system_user_id_seq', 17, true);


--
-- Data for Name: version; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY version (id, type, date_of_creation, date_of_change, version) FROM stdin;
1	Стабильная	2017-08-15 11:50:19	2017-08-15 11:50:19	6.0RC2
2	Новейшая	2017-08-15 11:53:32	2017-08-15 11:53:32	6.0RC2
\.


--
-- Name: version_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('version_id_seq', 3, true);


--
-- Name: advantage_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY advantage
    ADD CONSTRAINT advantage_pkey PRIMARY KEY (id);


--
-- Name: client_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY client
    ADD CONSTRAINT client_pkey PRIMARY KEY (id);


--
-- Name: common_information_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY common_information
    ADD CONSTRAINT common_information_pkey PRIMARY KEY (id);


--
-- Name: company_information_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY company_information
    ADD CONSTRAINT company_information_pkey PRIMARY KEY (id);


--
-- Name: component_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY component
    ADD CONSTRAINT component_pkey PRIMARY KEY (id);


--
-- Name: feed_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed
    ADD CONSTRAINT feed_pkey PRIMARY KEY (id);


--
-- Name: feed_source_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed_source
    ADD CONSTRAINT feed_source_pkey PRIMARY KEY (id);


--
-- Name: feed_status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed_status
    ADD CONSTRAINT feed_status_pkey PRIMARY KEY (id);


--
-- Name: source_link_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link
    ADD CONSTRAINT source_link_pkey PRIMARY KEY (id);


--
-- Name: source_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source
    ADD CONSTRAINT source_pkey PRIMARY KEY (id);


--
-- Name: subscriber_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subscriber
    ADD CONSTRAINT subscriber_pkey PRIMARY KEY (id);


--
-- Name: system_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY system_user
    ADD CONSTRAINT system_user_pkey PRIMARY KEY (id);


--
-- Name: version_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY version
    ADD CONSTRAINT version_pkey PRIMARY KEY (id);


--
-- Name: idx_234044abddaeffbd; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_234044abddaeffbd ON feed USING btree (feed_source_id);


--
-- Name: idx_37261cf2953c1c61; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_37261cf2953c1c61 ON source_link USING btree (source_id);


--
-- Name: fk_234044abddaeffbd; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY feed
    ADD CONSTRAINT fk_234044abddaeffbd FOREIGN KEY (feed_source_id) REFERENCES feed_source(id);


--
-- Name: fk_37261cf2953c1c61; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY source_link
    ADD CONSTRAINT fk_37261cf2953c1c61 FOREIGN KEY (source_id) REFERENCES source(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

