/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 16:48:50 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

void	print(t_tetris *tetris)
{
	while (tetris)
	{
		ft_putendl(tetris->charl);
		tetris = tetris->next;
	}
}

int		fillit(t_infos *infos)
{
	int	ret;

	ret = 0;
	if (!new_tetris(infos))
		return (0);
	while ((ret = read_tetris(infos)) == 1)
	{
		if (!check_tetro(infos))
			return (0);
	}
	if (ret == -1)
		return (0);
	print(infos->tetris);
	return (1);
}

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
