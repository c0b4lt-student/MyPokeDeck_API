<?php

  $users = [
    'thomas.flora2001@gmail.com' => 'flora2001',
    'contact.ziak@gang.fr' => 'ekipdu91',
    'contact.karchak@gang.fr' => 'kerc'
  ];
  $insert_requests = [
    'series' =>  'INSERT INTO series (name_serie, total_ext_serie) VALUES
                    (\'Wizards\', 19),
                    (\'Ex\', 17),
                    (\'DiamondNPearl\', 7),
                    (\'Platinum\', 5),
                    (\'HeartGoldNSoulSilver\', 5),
                    (\'BlackNWhite\', 12),
                    (\'XY\', 15),
                    (\'SunNMoon\', 16),
                    (\'SwordNShield\', 18);',
    'extensions'  =>  'INSERT INTO extensions (name_ext, total_card_ext, total_deck_ext, id_serie) VALUES
                        (\'Base set\', 102, 5, 1),
                        (\'Jungle\', 64, 2, 1),
                        (\'Fossil\', 62, 2, 1),
                        (\'EX ruby & Sapphire\', 109, 2, 2)'
  ];

function populate_table($pdo, $request) {
  $pdo->exec($request);
}

try {
  $pdo = new PDO('pgsql:host=ep-small-bush-994035.eu-central-1.aws.neon.tech;port=5432;dbname=neondb;user=c0b4lt-student;password=7sqa5xbkJifN');
  foreach ($insert_requests as $table_name => $request) {
    populate_table($pdo, $request);
  }
  $stmt = $pdo->prepare('INSERT INTO admins(email_admin, passwd_admin) VALUES (:email, :passwd)');
  $stmt->bindValue(':email', 'corentin.turgis@outlook.fr');
  $stmt->bindValue(':passwd', password_hash('vturgis', PASSWORD_BCRYPT));
  $stmt->execute();
  foreach ($users as $user_email => $user_pass) {
    $stmt = $pdo->prepare('INSERT INTO users(email_user, passwd_user) VALUES (:email, :passwd)');
    $stmt->bindValue(':email', $user_email);
    $stmt->bindValue(':passwd', password_hash($user_pass, PASSWORD_BCRYPT));
    $stmt->execute();
  }
} catch (PDOException $e) {
  echo $e->getMessage();
}
