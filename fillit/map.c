/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   map.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:07:49 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/15 15:02:53 by malallai         ###   ########.fr       */
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
	t_pos	*tetri_pos;

	tetri_pos = new_pos(0, 0);
	while (tetri_pos->x < tetris->width)
	{
		tetri_pos->y = 0;
		while (tetri_pos->y < tetris->height)
		{
			if (tetris->array[tetri_pos->y][tetri_pos->x] == '#'
				&& params->map->array[tetri_pos->y + pos->y][tetri_pos->x + pos->x] != '.')
				return (0);
			tetri_pos->y++;
		}
		tetri_pos->x++;
	}
	set(params, tetris, pos, 'A' + tetris->id);
	free(tetri_pos);
	return (1);
}

int		set(t_params *params, t_tetris *tetris, t_pos *pos, char to_set)
{
	t_pos	*tetri_pos;

	tetri_pos = new_pos(0, 0);
	while (tetri_pos->x < tetris->width)
	{
		tetri_pos->y = 0;
		while (tetri_pos->y < tetris->height)
		{
			if (tetris->array[tetri_pos->y][tetri_pos->x] == '#')
				params->map->array[tetri_pos->y + pos->y][tetri_pos->x + pos->x] = to_set;
			tetri_pos->y++;
		}
		tetri_pos->x++;
	}
	free(tetri_pos);
	return (1);
}
