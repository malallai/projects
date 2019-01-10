/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 16:40:32 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int		print_error(t_infos *infos)
{
	ft_putendl("error");
	exit_fillit(infos);
	return (-1);
}

int		exit_fillit(t_infos *infos)
{
	if (infos)
	{
		close(infos->fd);
		free_tetris(infos->tetris);
		free(infos->pos);
		free(infos);
	}
	exit(-1);
	return (-1);
}

int		free_tetris(t_tetris *tetris)
{
	t_tetris *tmp;
	int index;

	while (tetris)
	{
		tmp = tetris->next;
		index = 0;
		while (tetris->array[index])
		{
			free(tetris->array[index]);
			index++;
		}
		free(tetris->array);
		free(tetris->charl);
		free(tetris->chard);
		free(tetris);
		tetris = tmp;
	}
	return (1);
}
