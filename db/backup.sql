--
-- PostgreSQL database dump
--

-- Dumped from database version 17.0
-- Dumped by pg_dump version 17.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- Name: utente; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.utente (
    username character varying NOT NULL,
    password character varying NOT NULL,
    nome character varying NOT NULL,
    cognome character varying NOT NULL,
    vegano boolean,
    vegetariano boolean
);


ALTER TABLE public.utente OWNER TO www;

--
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.utente (username, password, nome, cognome, vegano, vegetariano) FROM stdin;
gaet	$2y$10$5clvpwimapQW1VTN1iZJ1eV7lyX25/DNr/BuwqwhVF3duykkqwUt2	Gaetano	Carbone	t	t
a	$2y$10$aHkNAwKxaxji.OxH.aHJbO60TiXzLiw24GHcrHZkFpBjWcSZJoSTG	Gaetano	Carbone	f	f
aaa	$2y$10$ud1XZclLnEQCGMI7L3M2Eu5MwIQJJdGYAU4wHDd1d2i.F00x19Fs.	Gaetano	Carbone	f	f
simo	$2y$10$vBbciNTa9i94N12Vp/WzzeUG2.W3JouZzPMsvFfKjhQQy9axQmQs2	Simone	Grimaldi	t	f
gae	$2y$10$FX.0BV1sK45vsCYlfYLQAOc1JrvGf7xxqFUXoCQpK4bdU2Y5S0v2W	Gaetano	Carbone	f	f
pincar	$2y$10$sX6DJPHfLmvq9CEOyjThwu1ssana7U6rW5ftmSwfEoN6xk1Nag53a	giuseppe	Carbone	f	t
mik	$2y$10$DxFu7UBOHVG4VaSyHPmEKuotI6t3GLezuFRwnUDiVVGi5ZAc2NG6S	Michele	Cetriolo	f	f
\.


--
-- Name: utente utente_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (username, password);


--
-- PostgreSQL database dump complete
--

