/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 15:53:11 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

void	print_tetros(t_tetris *tetris)
{
	while (tetris)
	{
		ft_putendl(tetris->charl);
		tetris = tetris->next;
	}
}

int		fillit(int fd)
{
	int			ret;
	t_tetris	*tetris;
	t_infos		*infos;

	ret = 0;
	if (!(infos = new_infos(fd)))
		return (-1);
	if ((init_tetris(&tetris, infos)) != 1)
		return (print_error(infos));
	infos->tetris = &tetris;
	while ((ret = read_tetris(fd, infos)) == 1)
	{
		if ((check_tetro(infos->last, infos)) != 1)
			return (print_error(infos));
	}
	if (ret == -1)
		return (print_error(infos));
	print_tetros(tetris);
	exit_fillit(infos);
	return (1);
}
