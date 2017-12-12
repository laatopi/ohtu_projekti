-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Lukuvinkki(otsikko, tekija, isbn, url, tyyppi, kuvaus, julkaistu, sarja) VALUES('Functional Geekery Episode 117 – Eric Normand', 'Steven Proctor', null, 'https://www.functionalgeekery.com/episode-117-eric-normand/', 'podcast', null, '05.12.2017', 'Functional Geekery');
INSERT INTO Lukuvinkki(otsikko, tekija, isbn, url, tyyppi, kuvaus, julkaistu, sarja) VALUES('Should all locks have keys?', 'CGP Grey', null, 'https://www.youtube.com/watch?v=VPBH1eW28mo', 'video', null, '14.04.2016', null);
INSERT INTO Lukuvinkki(otsikko, tekija, isbn, url, tyyppi, kuvaus, julkaistu, sarja) VALUES('The Agile Samurai', 'Jonathan Rasmusson','9781934356586', null, 'kirja', 'The Agile Samurai gives you everything you need to deliver something of value every week and make rolling your software into production a non-event.', '2010', null);
INSERT INTO Lukuvinkki(otsikko, tekija, isbn, url, tyyppi, kuvaus, julkaistu, sarja) VALUES('Map of Computer Science', 'Domain of Science', null, 'https://www.youtube.com/watch?v=SzJ46YA_RaA', 'video', null, '06.10.2017', null);
INSERT INTO Lukuvinkki(otsikko, tekija, isbn, url, tyyppi, kuvaus, julkaistu, sarja) VALUES('Should You Learn C++ in 2018?', 'Stefan Mischook', null, 'https://www.youtube.com/watch?v=7xVrYnyQ04M', 'video', null, '13.11.2017', null);
INSERT INTO Lukuvinkki(otsikko, tekija, isbn, url, tyyppi, kuvaus, julkaistu, sarja) VALUES('The Value of Encryption', 'Bruce Schneier', null, 'https://www.schneier.com/essays/archives/2016/04/the_value_of_encrypt.html', 'blogpost', null, '17.04.2016', null);

INSERT INTO Tag(nimi) VALUES ('tietojenkäsittely');
INSERT INTO Tag(nimi) VALUES ('verkot');
INSERT INTO Tag(nimi) VALUES ('agile');
INSERT INTO Tag(nimi) VALUES ('tietoturva');

INSERT INTO Kayttaja(tunnus, salasana) VALUES('topi','topitopi');
