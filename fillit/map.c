/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   map.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:07:49 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/16 15:45:34 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

t_map	*new_map(t_params *params, size_t size)
{
	t_map *map;

	map = ft_memalloc(1);
	map->size = size;
	map->array = ft_newarray(map->size + 1, map->size, '.');
	params->map = map;
	return (map);
}

int		try_set(t_params *params, t_tetris *tetris, t_pos *pos)
{
	t_pos	*tpos;

	tpos = new_pos(0, 0);
	while (tpos->x < tetris->width)
	{
		tpos->y = 0;
		while (tpos->y < tetris->height)
		{
			if (tetris->array[tpos->y][tpos->x] == '#' && \
				params->map->array[tpos->y + pos->y][tpos->x + pos->x] != '.')
			{
				free(tpos);
				return (0);
			}
			tpos->y++;
		}
		tpos->x++;
	}
	set(params, tetris, pos, 'A' + tetris->id);
	free(tpos);
	return (1);
}

int		set(t_params *params, t_tetris *tetris, t_pos *pos, char to_set)
{
	t_pos	*tpos;

	tpos = new_pos(0, 0);
	while (tpos->x < tetris->width)
	{
		tpos->y = 0;
		while (tpos->y < tetris->height)
		{
			if (tetris->array[tpos->y][tpos->x] == '#')
				params->map->array[tpos->y + pos->y][tpos->x + pos->x] = to_set;
			tpos->y++;
		}
		tpos->x++;
	}
	free(tpos);
	return (1);
}
