/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 14:46:05 by malallai         ###   ########.fr       */
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

int		fillit(t_infos *infos)
{
	int	ret;

	ret = 0;
	if (!init_tetris(infos))
		return (0);
	while ((ret = read_tetris(infos)) == 1)
	{
		if (!check_tetro(infos))
			return (0);
	}
	if (ret == -1)
		return (0);
	print_tetros(infos->tetris);
	return (1);
}
