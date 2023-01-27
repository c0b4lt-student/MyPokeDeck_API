<?php

  $insert_requests = [
    'admins' => 'INSERT INTO admins (email_admin, passwd_admin) VALUES
                    (\'corentin.turgis@outlook.fr\', \'nopass\');',
    'users' => 'INSERT INTO users (email_user, passwd_user) VALUES
                    (\'thomas.flora2001@gmail.com\', \'nopass\'),
                    (\'contact.ziak@gang.fr\', \'nopass\'),
                    (\'contact.karchak@gang.fr\', \'nopass\');',
    'series' =>  'INSERT INTO series (name_serie, total_ext_serie) VALUES
                    (\'Wizards\', 19),
                    (\'Ex\', 17),
                    (\'DiamondNPearl\', 7),
                    (\'Platinum\', 5),
                    (\'HeartGoldNSoulSilver\', 5),
                    (\'BlackNWhite\', 12),
                    (\'XY\', 15),
                    (\'SunNMoon\', 16),
                    (\'SwordNShield\', 18);'
  ];

function populate_table($pdo, $request) {
  $pdo->exec($request);
}

try {
  $pdo = new PDO('pgsql:host=ep-small-bush-994035.eu-central-1.aws.neon.tech;port=5432;dbname=neondb;user=c0b4lt-student;password=7sqa5xbkJifN');
  foreach ($insert_requests as $table_name => $request) {
    populate_table($pdo, $request);
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
