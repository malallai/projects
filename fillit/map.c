/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   map.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:07:49 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/15 12:57:22 by malallai         ###   ########.fr       */
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
	t_pos	*pos2;

	pos2 = new_pos(0, 0);
	while (pos2->y < params->map->size - tetris->height
		&& pos2->x < params->map->size - tetris->width)
	{
		if (tetris->array[pos2->y][pos2->x] == '#'
			&& params->map->array[pos2->y + pos->y][pos2->x + pos->x] != '.')
			return (0);
		edit_pos(pos2, 3, 3, 0);
	}
	set(params, tetris, pos2, 'A' + tetris->id);
	return (1);
}

int		set(t_params *params, t_tetris *tetris, t_pos *pos, char to_set)
{
	t_pos	*pos2;

	pos2 = new_pos(0, 0);
	while (pos2->y < 4 && pos2->x < 4)
	{
		if (tetris->array[pos2->y][pos2->x] == '#')
			params->map->array[pos2->y + pos->y][pos2->x + pos->x] = to_set;
		edit_pos(pos2, 3, 3, 0);
	}
	printf("%d %d\n", pos2->x, pos2->y);
	free(pos2);
	free(pos);
	return (1);
}
