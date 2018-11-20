/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:40 by malallai          #+#    #+#             */
/*   Updated: 2018/11/20 12:39:25 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <get_next_line.h>

int main(int argc, char **argv)
{
	int		fd;
	char	*line;
	int		r;

	if (argc == 2)
	{
		fd = open(argv[1], O_RDONLY);
		while ((r = get_next_line(fd, &line)) == 1)
		{
			ft_putendl(line);
			free(line);
		}
		close(fd);
	}
	return (0);
}
