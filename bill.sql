#
# database definition
#

DROP DATABASE IF EXISTS bill;
CREATE DATABASE bill CHARACTER SET utf8;

USE bill;

CREATE TABLE user (

  id MEDIUMINT unsigned PRIMARY KEY AUTO_INCREMENT, #  max id 16,777,215
  email VARCHAR(64) NOT NULL,                       #+ email
  pseudo VARCHAR(32) NOT NULL,                      #+ pseudo
  password VARCHAR(255) NOT NULL                    #+ password
);

CREATE TABLE customer (

  id MEDIUMINT unsigned PRIMARY KEY AUTO_INCREMENT, #  max id 16,777,215
  company_name VARCHAR(32) NOT NULL,                #+ company_name
  email VARCHAR(64) NOT NULL,                       #+ email
  address VARCHAR(128) NOT NULL DEFAULT "",         #~ address
  user_id MEDIUMINT unsigned,                       #+ user ref
  FOREIGN KEY (user_id) REFERENCES user(id)
);

CREATE TABLE status (

  id TINYINT unsigned PRIMARY KEY AUTO_INCREMENT, # max 255
  updated VARCHAR (4) NOT NULL
);

CREATE TABLE invoice (

  id MEDIUMINT unsigned PRIMARY KEY AUTO_INCREMENT, #  max id 16,777,215
  amount MEDIUMINT unsigned DEFAULT NULL,           #+ max 16,777,215
  billed DATE DEFAULT (CURRENT_DATE),               #+ bill date
  dued DATE DEFAULT (CURRENT_DATE),                 #+ due date
  customer_id MEDIUMINT unsigned,                   #+ customer ref
  status_id TINYINT unsigned,                       #+ status ref
  user_id MEDIUMINT unsigned,                       #+ user ref
  FOREIGN KEY (customer_id) REFERENCES customer(id),
  FOREIGN KEY (status_id) REFERENCES status(id),
  FOREIGN KEY (user_id) REFERENCES user(id)
);

#
# database content
#

INSERT INTO status (updated) VALUES
('BILL'), # billed
('DUED'), # dued
('PROB'), # prob
('PAID'), # paid
('XXXX'); # unlisted

INSERT INTO user (id, email, pseudo, password) VALUES
(1, 'a@a.a', 'a', '$2y$10$dIzP/rt4oQaMPBOqlGzDpesjUW81imSFh1LxNNJqkoCGzZSuv5bM6'), # password 'a'
(2, 'b@b.b', 'b', '$2y$10$AI4c2mCWyN9sP4W5chqZIeIdjupANJTs7KG.u4F.k3caLIL0q8V22'), # password 'b'
(3, 'c@c.c', 'c', '$2y$10$CY29DK8gBu99mGfnTUzLFOsw59.Mfqio/odJRO4wPwNQ42cpJuo5q'), # password 'c'
(4, 'd@d.d', 'd', '$2y$10$2x8V/8w8Nu.JIFb93OS63.nnBB99/9oNlzn/SV2aSym/4LbyoBghG'); # password 'd'

INSERT INTO customer (id, email, address, company_name, user_id) VALUES
(1, 'gustave.germany@germany.de', '22, Place des Victoires, 14000 BERLIN', 'WinnersOnline', 1),
(2, 'salome.spain@spain.es', '44, Rue du Sacre, 25000 MADRID', 'SaltForSlugs', 1),
(3, 'pedro.portugal@portugal.pt', '88, Rue du Putsch, 18000 LISBONNE', 'ConceptTools', 2),
(4, 'baltus.belgium@belgium.be', '111, Avenue de Waterloo, 10001 BRUXELLES', 'DesignWays', 3),
(5, 'anders.austria@austria.at', '9, Impasse Mozart, 99000 VIENNE', 'TooFarGone', 4);

INSERT INTO invoice (id, amount, billed, dued, customer_id, status_id, user_id) VALUES # invoices with dates
(1, 1500, '2021-08-18', '2021-09-15', 1, 1, 1),
(2, 750,  '2021-09-15', '2021-12-15', 1, 2, 1),
(3, 525,  '2021-09-30', '2021-12-20', 1, 2, 1),
(4, 2000, '2021-06-28', '2021-12-25', 2, 3, 1),
(5, 1250, '2021-09-25', '2021-10-25', 2, 4, 1),
(6, 7500, '2021-10-21', '2021-06-15', 3, 4, 2),
(7, 3500, '2021-09-01', '2021-12-12', 4, 1, 3),
(8, 2000, '2021-11-11', '2021-11-30', 5, 1, 4);
