/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/11 14:21:31 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		exit_fillit(t_infos *infos, int error)
{
	if (error)
		ft_putendl("error");
	if (infos)
	{
		close(infos->fd);
		free_tetris(infos->tetris);
		free(infos->pos);
		ft_freearray(infos->map->map);
		free(infos->map);
		free(infos);
	}
	exit(-1);
	return (-1);
}

int		free_tetris(t_tetris *tetris)
{
	t_tetris	*tmp;

	while (tetris)
	{
		tmp = tetris->next;
		ft_freearray(tetris->array);
		free(tetris->charl);
		free(tetris->chard);
		free(tetris);
		tetris = tmp;
	}
	return (1);
}

int		edit_infos(t_infos *infos, char c, int end)
{
	if (c == '\n')
		return (1);
	if (infos->pos->x == 3 && infos->pos->y < 3)
	{
		infos->pos->x = 0;
		infos->pos->y++;
	}
	else if (infos->pos->x < 3)
		infos->pos->x++;
	if (end)
	{
		if (infos->pos->x == 3 && infos->pos->y == 3)
		{
			infos->pos->x = 0;
			infos->pos->y = 0;
			infos->size = infos->size + 1;
		}
		else
			return (0);
	}
	return (infos->size > 26 ? 0 : 1);
}

t_infos	*new_infos(int fd)
{
	t_infos *infos;

	if (!(infos = malloc(sizeof(t_infos))) || \
		!(infos->pos = malloc(sizeof(t_pos))))
		return (NULL);
	infos->pos->x = 0;
	infos->pos->y = 0;
	infos->init = 0;
	infos->last = NULL;
	infos->size = 0;
	infos->fd = fd;
	return (infos);
}
