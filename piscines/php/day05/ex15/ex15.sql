SELECT REVERSE(SUBSTR(`phone_number`, 2, 9)) AS `reb-munenohp` FROM distrib WHERE `phone_number` REGEXP '^05';
