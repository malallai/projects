/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/29 12:10:52 by malallai         ###   ########.fr       */
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
		if (error != 1)
		{
			free_tetris(params);
			if (params->map)
			{
				ft_freearray(params->map->array);
				free(params->map);
			}
		}
		free(params);
	}
	exit(-1);
	return (-1);
}

int		free_tetris(t_params *params)
{
	t_tetris	*tmp;
	t_tetris	*tetris;

	tetris = params->tetris;
	while (tetris)
	{
		tmp = tetris;
		if (tmp->id + 1 < params->size)
			tetris = tmp->next;
		else
			tetris = NULL;
		ft_freearray(tmp->array);
		ft_freearray(tmp->full_array);
		free(tmp->string);
		free(tmp);
	}
	return (1);
}
