/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/13 18:18:09 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		exit_fillit(t_params *params, int error)
{
	if (error)
		ft_putendl("error");
	if (params)
	{
		close(params->fd);
		free_tetris(params->tetris);
		ft_freearray(params->map->array);
		free(params->map);
		free(params);
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
		ft_freearray(tetris->full_array);
		free(tetris->chard);
		free(tetris);
		tetris = tmp;
	}
	return (1);
}
