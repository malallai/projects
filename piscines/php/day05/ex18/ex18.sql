SELECT `name` FROM distrib WHERE `id_distrib` in (42, 62, 63, 64, 65, 66, 67,68, 69, 71, 88, 89, 90) OR `name` REGEXP '^[^yY]*[yY][^yY]*[yY][^yY]*$' LIMIT 3,5;
