/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/11/22 15:48:43 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

int main(int argc, char **argv)
{
	int		fd;
	int 	fd2;
	char	*line;
	int		r;

	if (argc == 3)
	{
		fd = open(argv[1], O_RDONLY);
		fd2 = open(argv[2], O_RDONLY);

		//char *str = "fioeheiohgoiehgioehiogehioge\n hrogriohgoir ghriohg oir";

		//write (fd2, str, ft_strlen(str));

		if ((r = get_next_line(fd, &line)))
			ft_putendl(line);
		free(line);
		if ((r = get_next_line(fd2, &line)))
			ft_putendl(line);
		free(line);
		if ((r = get_next_line(fd, &line)))
			ft_putendl(line);
		free(line);
		if ((r = get_next_line(fd2, &line)))
			ft_putendl(line);
		free(line);

		close(fd);
		close(fd2);
	}
	else if (argc == 2)
	{
		fd = open(argv[1], O_RDONLY);
		while (get_next_line(fd, &line) == 1)
		{
			ft_putendl(line);
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
			free(line);
		}
	}
	return (0);
}
