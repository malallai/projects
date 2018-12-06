/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/12/06 22:29:19 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "testgnl.h"

int main(int argc, char **argv)
{
	int		fd;
	char	*line;
	int		r = 0;

	if (argc == 3)
	{
		fd = open(argv[1], O_RDONLY);
		ft_putchar('\n');
		while ((r = get_next_line(fd, &line)) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		ft_putchar('\n');
		close(fd);
		
		while ((r = get_next_line(fd, &line)) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		//ft_putnbr(r);
		//ft_putendl("");

		close(fd);
	}
	else if (argc == 2)
	{
		fd = open(argv[1], O_RDONLY);
		while ((r = get_next_line(fd, &line)) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		close(fd);
		//ft_putnbr(r);
		//ft_putendl("");

	}
	else if (argc == 1)
	{
		fd = 0;
		while ((r = get_next_line(fd, &line)) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		//ft_putnbr(r);
		//ft_putendl("");
	}
	return (0);
}
