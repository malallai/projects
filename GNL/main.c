/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/11/24 11:32:14 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

int main(int argc, char **argv)
{
	int		fd;
	int		output;
	int		diff;
	int		diff_file_size;
	char	*line;
	output = open("output.txt", O_CREAT | O_RDWR | O_TRUNC, 0755);
	int		array[10] = {1, 8, 16, 32, 64, 128, 512, 1024, 2048, 4096};

	/* Basic test */
	int i = 0;
	while (i < 10)
	{
		system("sed -i '' -e \"s|TESTED_DIR.*=.*|TESTED_DIR = $TEST_PATH\/GNL\/gnl_testerizer\/gnl|\" Makefile");
		i++;
	}
	

	if (argc == 3)
	{
		fd = open(argv[1], O_RDONLY);
		ft_putchar('\n');
		while (get_next_line(fd, &line) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		ft_putchar('\n');
		close(fd);
		
		while (get_next_line(fd, &line) == 1)
		{
			ft_putendl(line);
			free(line);
		}

		close(fd);
	}
	else if (argc == 2)
	{
		fd = open(argv[1], O_RDONLY);
		while (get_next_line(fd, &line) == 1)
		{
			ft_putendl(line);
			write(fd3, line, ft_strlen(line));
			write(fd3, "\n", 1);
			free(line);
		}
		close(fd);
	}
	else if (argc == 1)
	{
		fd = 0;
		while (get_next_line(fd, &line) == 1)
		{
			ft_putendl(line);
			write(fd3, line, ft_strlen(line));
			write(fd3, "\n", 1);
			free(line);
		}
	}

	system("diff lorem.txt output.txt > diff.diff");
    fd4 = open("diff.diff", O_RDONLY);
    diff_file_size = read(fd4, NULL, 10);
    close(fd3);
    close(fd4);
	printf("%d\n", diff_file_size);
	return (0);
}
