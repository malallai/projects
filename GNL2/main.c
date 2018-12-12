/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/12/12 14:54:26 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "gnl.h"
#include <time.h>

int			print = 1;

static void	print_output(char *line, int fd, int r, int toprint)
{
	ft_putnbr_fd(r, toprint);
	ft_putstr_fd(" FD = | ", toprint);
	ft_putnbr_fd(fd, toprint);
	ft_putstr_fd("Line : ", toprint);
	ft_putendl_fd(line, toprint);
}

static void	put_line(char *line, int output, int fd, int r)
{
	if (print)
		print_output(line, fd, r, 1);
	print_output(line, fd, r, output);
}

int 		main(int argc, char **argv)
{
	int		fd;
	char	*line;
	int		output;
	int		r;
	char	*file = NULL;
	int		ra = 0;

	srand(time(NULL));
	ra = rand();
	file = ft_strjoin("outputs/output-test-", ft_itoa(ra));
	output = open(file, O_WRONLY | O_CREAT | O_TRUNC, 0666);
	
	ft_putstr("BUFF_SIZE = ");
	ft_putnbr(BUFF_SIZE);
	ft_putendl("");

	if (argc == 3)
	{
		fd = open(argv[1], O_RDONLY);
		while ((r = get_next_line(fd, &line)) == 1)
			put_line(line, output, fd, r);
		close(fd);
		
		while ((r = get_next_line(fd, &line)) == 1)
			put_line(line, output, fd, r);
		close(fd);
	}
	else if (argc == 2)
	{
		fd = open(argv[1], O_RDONLY);
		while ((r = get_next_line(fd, &line)) == 1)
			put_line(line, output, fd, r);
		close(fd);
	}
	else if (argc == 1)
	{
		fd = 0;
		while ((r = get_next_line(fd, &line)) == 1)
			put_line(line, output, fd, r);
	}

	ft_putstr("Output saved to : ");
	ft_putendl(file);
	free(file);
	close(output);
	return (0);
}
