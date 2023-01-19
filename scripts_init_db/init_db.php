<?php
$create_requests = [
  'Admins' =>     'DROP TABLE IF EXISTS admins;
                    CREATE TABLE admins
                    (
                        Id_admin SERIAL NOT NULL PRIMARY KEY,
                        Email_admin VARCHAR(80) NOT NULL,
                        Passwd_admin VARCHAR(80) NOT NULL
                    );',
  'Users' =>      'DROP TABLE IF EXISTS users;
                    CREATE TABLE users
                    (
                        Id_user SERIAL NOT NULL PRIMARY KEY,
                        Email_user VARCHAR(80) NOT NULL,
                        Passwd_user VARCHAR(80) NOT NULL
                    );',
  'Series' =>     'DROP TABLE IF EXISTS series;
                    CREATE TABLE series
                    (
                        Id_serie SERIAL NOT NULL PRIMARY KEY,
                        Name_serie VARCHAR(30) NOT NULL,
                        Total_card_serie INT NOT NULL,
                        Total_deck_serie INT NOT NULL
                    );',
  'Cards' =>    'DROP TABLE IF EXISTS cards;
                    CREATE TABLE cards
                    (
                        Id_card SERIAL NOT NULL PRIMARY KEY,
                        Id_serie INT NOT NULL,
                        Number_card INT NOT NULL,
                        FOREIGN KEY (Id_serie)
                            REFERENCES series (Id_serie)
                    );',
  'Fav_cards' =>      'DROP TABLE IF EXISTS fav_cards;
                        CREATE TABLE fav_cards
                        (
                            Id_user INT NOT NULL,
                            Id_card INT NOT NULL,
                            FOREIGN KEY (Id_user)
                                REFERENCES users (Id_user),
                            FOREIGN KEY (Id_card)
                                REFERENCES cards (Id_card)
                        );',
  'Pmdecks' =>  'DROP TABLE IF EXISTS pmdecks;
                        CREATE TABLE pmdecks
                        (
                            Id_pmdeck SERIAL NOT NULL PRIMARY KEY,
                            Id_serie INT NOT NULL PRIMARY KEY,
                            Name_pmdeck VARCHAR(30)
                        );',
  'Pmdecks_cards' =>  'DROP TABLE IF EXISTS pmdecks_cards;
                        CREATE TABLE pmdecks_cards
                        (
                            Id_pmdeck INT NOT NULL,
                            Id_card INT NOT NULL,
                            FOREIGN KEY (Id_pmdeck)
                                REFERENCES pmdecks (Id_pmdeck),
                            FOREIGN KEY (Id_card)
                                REFERENCES cards (Id_card)
                        );',
  'Cdecks'  =>          'DROP TABLE IF EXISTS cdecks;
                            CREATE TABLE cdecks
                            (
                                Id_cdeck SERIAL NOT NULL PRIMARY KEY,
                                Name_cdeck VARCHAR(30) NOT NULL,
                                Id_user INT NOT NULL,
                                FOREIGN KEY (Id_user)
                                    REFERENCES users (Id_user)
                            );',
  'Cdecks_cards' =>     'DROP TABLE IF EXISTS cdecks_cards;
                            CREATE TABLE cdecks_cards
                            (
                                Id_cdeck INT NOT NULL,
                                Id_card INT NOT NULL,
                                FOREIGN KEY (Id_cdeck)
                                    REFERENCES cdecks (Id_cdeck),
                                FOREIGN KEY (Id_card)
                                    REFERENCES cards (Id_card)
                            );'
];

function create_table($pdo, $create_request) {
  $pdo->exec($create_request);
}

try {
  $pdo = new PDO('pgsql:host=ep-small-bush-994035.eu-central-1.aws.neon.tech;port=5432;dbname=neondb;user=c0b4lt-student;password=7sqa5xbkJifN');
  foreach ($create_requests as $table_name => $create_request) {
    create_table($pdo, $create_request);
  }
} catch (PDOException $e) {
  echo$e->getMessage();
}