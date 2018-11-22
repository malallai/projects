/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
<<<<<<< HEAD
/*   Updated: 2018/11/22 13:01:57 by malallai         ###   ########.fr       */
=======
/*   Updated: 2018/11/20 22:08:08 by malallai         ###   ########.fr       */
>>>>>>> 9ee428cd5a8e8fe70165fea22e5544d533aa5655
/*                                                                            */
/* ************************************************************************** */

#include <get_next_line.h>

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
		get_next_line(fd, &line);
		//ft_putendl(line);
		free(line);
		close(fd);
		free(line);
	}
	return (0);
}
