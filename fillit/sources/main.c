/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 11:45:13 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 16:45:00 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int		main(int argc, char **argv)
{
	int		fd;
	t_infos *infos;

	infos = NULL;
	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return (0);
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			return (exit_fillit(infos, 1));
		if (!(infos = new_infos(fd)))
			return (exit_fillit(infos, 1));
		if (!fillit(infos))
			return (exit_fillit(infos, 1));
		exit_fillit(infos, 0);
	}
	return (0);
}
