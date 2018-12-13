/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/12/13 15:08:31 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"
#include <stdio.h>
#include <fcntl.h>
#include <time.h>

int			global_print = 0;
int			output_print = 0;
int			w = 0;

static void	print_output(char *line, int fd, int r, int toprint)
{
	ft_putnbr_fd(r, toprint);
	ft_putstr_fd(" FD = ", toprint);
	ft_putnbr_fd(fd, toprint);
	ft_putstr_fd(" | Line : ", toprint);
	ft_putendl_fd(line, toprint);
}

static void	put_line(char *line, int output, int fd, int r)
{
	if (global_print)
		print_output(line, fd, r, 1);
	if (output_print)
		print_output(line, fd, r, output);
	free(line);
}

int 		main(int argc, char **argv)
{
	int		fd;
	char	*line = NULL;
	int		output = 0;
	int		r = 0;
	char	*file = NULL;
	int		ra = 0;
	char	*t = NULL;

	if (output_print)
	{
		srand(time(NULL));
		ra = rand();
		t = ft_itoa(ra);
		file = ft_strjoin("outputs/output-test-", t);
		free(t);
		output = open(file, O_WRONLY | O_CREAT | O_TRUNC, 0666);
	}
	
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

	if (output_print)
	{
		ft_putstr("Output saved to : ");
		ft_putendl(file);
		free(file);
		close(output);
	}
	ft_putstr("Final return = ");
	ft_putnbr(r);
	ft_putendl("");
	if (w)
		while (1)
			;
	return (0);
}
