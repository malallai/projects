/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/11/24 13:39:23 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "testgnl.h"

static int		ft_getfile(char *f)
{
	int fd;
	char *output = "outputs/";
	char *tmp = ft_strjoin(output, f);
	output = ".output.log";
	output = ft_strjoin(tmp, output);
	fd = open(output, O_CREAT | O_RDWR | O_TRUNC, 0755);
	free(output);
	free(tmp);
	return (fd);
}

int main(void)
{
	int		fd;
	int		output;
	/*int		global_output;
	int		diff;
	int		diff_file_size;*/
	char	*line;
	char	*files[4] = {"lorem.txt", "tiny_file.txt", "large_file.txt", "big_file.txt"};
	int		i = 0;
	int		r = 0;

	while (i < 4)
	{
		output = ft_getfile(files[i]);
		fd = open(files[i], O_RDONLY);

		while ((r = get_next_line(fd, &line)) == 1)
		{
			write(output, line, ft_strlen(line));
			write(output, "\n", 1);
		}

		if (r < 0)
			printf("%s>> %s%s\t%sFAIL!%s\n", WARN_COLOR, NO_COLOR, files[i], ERROR_COLOR, NO_COLOR);
		else
			printf("%s>> %s%s\t%sOK!%s\n", WARN_COLOR, NO_COLOR, files[i], OK_COLOR, NO_COLOR);

		close(fd);
		close(output);
		i++;
	}
	/*if (argc == 3)
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
	printf("%d\n", diff_file_size);*/
	return (0);
}
