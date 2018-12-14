/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/12/14 14:15:23 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"
#include <stdio.h>
#include <fcntl.h>
#include <time.h>

int			global_print = 1;
int			output_print = 0;

int			w = 0;

int			testulimit = 0;
int			ul = 15;

int			single_fd = 0;

static void print_multifd(char *str, int fd, int force)
{
	if (output_print)
		ft_putstr_fd(str, fd);
	if (global_print || force)
		ft_putstr_fd(str, 1);
}

static void print_nbr_multifd(int nbr, int fd, int force)
{
	char *t = ft_itoa(nbr);
	print_multifd(t, fd, force);
	free(t);
}

static void	put_line(char *line, int output, int fd, int r)
{
	print_nbr_multifd(r, output, 0);
	print_multifd(" FD = ", output, 0);
	print_nbr_multifd(fd, output, 0);
	print_multifd(" | Line : ", output, 0);
	print_multifd(line, output, 0);
	print_multifd("\n", output, 0);
	free(line);
}

static void put_ulimit(char *line, int output, int fd, int r)
{
	print_multifd("Test ulimit for FD = ", output, 0);
	print_nbr_multifd(fd, output, 0);
	print_multifd("\n", output, 0);
	if (r == 1 || r == 0)
	{
		put_line(line, output, fd, r);
		print_multifd("OK!\n", output, 0);
	}
	else
		print_multifd("ERROR!\n", output, 0);
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

	print_multifd("BUFF_SIZE = ", output, 1);
	print_nbr_multifd(BUFF_SIZE, output, 1);
	print_multifd("\n", output, 1);

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
	print_multifd("Final return = ", output, 1);
	print_nbr_multifd(r, output, 1);
	print_multifd("\n", output, 1);
	if (w)
		while (1)
			;
	return (0);
}
