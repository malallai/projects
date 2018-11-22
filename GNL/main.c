/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/11/22 16:53:00 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

int main(int argc, char **argv)
{
	int		fd;
	int 	fd2;
	int		fd3;
	int		fd4;
	int		diff_file_size;
	char	*line;
	fd3 = open("output.txt", O_CREAT | O_RDWR | O_TRUNC, 0755);

	if (argc == 3)
	{
		fd = open(argv[1], O_RDONLY);
		fd2 = open(argv[2], O_RDONLY);

		ft_putchar('\n');
		while (get_next_line(fd, &line) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		ft_putchar('\n');
		while (get_next_line(fd2, &line) == 1)
		{
			ft_putendl(line);
			free(line);
		}

		close(fd);
		close(fd2);
	}
	else if (argc == 2)
	{
		fd = open(argv[1], O_RDONLY);
		while (get_next_line(fd, &line) == 1)
		{
			//ft_putendl(line);
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
			//ft_putendl(line);
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
