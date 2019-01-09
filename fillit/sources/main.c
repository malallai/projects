/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 11:45:13 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 12:26:40 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int		main(int argc, char **argv)
{
	int fd;

	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return (0);
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			print_error();
		argv[2] = ft_itoa(fd);
		fillit(argv);
		close(fd);
	}
	return (0);
}
