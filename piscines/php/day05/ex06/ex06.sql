SELECT `title`,`summary` FROM `film` WHERE LOWER(`summary`) LIKE LOWER('%vincent%') ORDER BY `id_film` ASC;
