/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/12/14 13:34:19 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"
#include <stdio.h>
#include <fcntl.h>
#include <time.h>

int			global_print = 1;
int			output_print = 1;
int			w = 0;
int			testulimit = 0;
int			ul = 15;
int			single_fd = 0;

static void print_multifd(char *str, int fd1, int fd2)
{
	if (global_print)
		ft_putstr_fd(str, fd1);
	if (output_print)
		ft_putstr_fd(str, fd2);
}

static void	put_line(char *line, int output, int fd, int r)
{
	char *t1 = ft_itoa(r);
	char *t2 = ft_itoa(fd);

	print_multifd(t1, output, 1);
	print_multifd(" FD = ", output, 1);
	print_multifd(t2, output, 1);
	print_multifd(" | Line : ", output, 1);
	print_multifd(line, output, 1);
	print_multifd("\n", output, 1);
	
	free(t1);
	free(t2);
	free(line);
}


static void put_ulimit(char *line, int output, int fd, int r)
{
	char *t1 = ft_itoa(fd);

	print_multifd("Test ulimit for FD = ", output, 1);
	print_multifd(t1, output, 1);
	print_multifd("\n", output, 1);
	if (r == 1 || r == 0)
	{
		put_line(line, output, fd, r);
		print_multifd("OK!\n", output, 1);
	}
	else
		print_multifd("ERROR!\n", output, 1);
	
	free(t1);
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

	if (!testulimit)
	{
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
			fd = single_fd;
			while ((r = get_next_line(fd, &line)) == 1)
				put_line(line, output, fd, r);
		}
	}
	else
	{
		int		h[ul];
		int		g = 0;
		char	*tf;
		while (g < ul)
		{
			ra = rand();
			t = ft_itoa(ra);
			tf = ft_strjoin("testulimit/", t);

			h[g] = open(tf, O_RDWR | O_CREAT | O_TRUNC, 0666);
			write(h[g], "testtowpajtpo\n", 14);
			write(h[g], t, ft_strlen(t));
			close(h[g]);
			h[g] = open(tf, O_RDONLY);
			g++;
			free(tf);
			free(t);
		}
		g = 0;
		while (g < ul)
		{
			r = get_next_line(h[g], &line);
			put_ulimit(line, output, h[g], r);
			close(h[g]);
			g++;
		}
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
