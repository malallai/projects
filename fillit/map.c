/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   map.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:07:49 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/19 14:38:16 by malallai         ###   ########.fr       */
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
	int		x;
	int		y;

	x = 0;
	while (x < tetris->width)
	{
		y = 0;
		while (y < tetris->height)
		{
			if (tetris->array[y][x] == '#' && \
				params->map->array[y + pos->y][x + pos->x] != '.')
				return (0);
			y++;
		}
		x++;
	}
	set(params, tetris, pos, 'A' + tetris->id);
	return (1);
}

int		set(t_params *params, t_tetris *tetris, t_pos *pos, char to_set)
{
	int		x;
	int		y;

	x = 0;
	while (x < tetris->width)
	{
		y = 0;
		while (y < tetris->height)
		{
			if (tetris->array[y][x] == '#')
				params->map->array[y + pos->y][x + pos->x] = to_set;
			y++;
		}
		x++;
	}
	free(pos);
	return (1);
}
