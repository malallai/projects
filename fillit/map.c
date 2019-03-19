/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   map.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/11 14:07:49 by bclerc            #+#    #+#             */
/*   Updated: 2019/01/25 04:14:28 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

t_map	*new_map(t_params *params, size_t size)
{
	t_map *map;

	map = (t_map *)malloc(sizeof(t_map));
	map->size = size;
	map->array = ft_newarray(map->size + 1, map->size, '.');
	params->map = map;
	return (map);
}

int		try_set(t_params *params, t_tetris *tetris, t_pos *pos)
{
	int		x;
	int		y;

	y = 0;
	while (y < tetris->height)
	{
		x = 0;
		while (x < tetris->width)
		{
			if (!tetris->array[y][x])
				break ;
			if (tetris->array[y][x] == '#' && \
				params->map->array[pos->y + y][pos->x + x] != '.')
			{
				free(pos);
				return (0);
			}
			x++;
		}
		y++;
	}
	set(params, tetris, pos, 'A' + tetris->id);
	return (1);
}

void	set(t_params *params, t_tetris *tetris, t_pos *pos, char to_set)
{
	int		x;
	int		y;

	y = 0;
	while (y < tetris->height)
	{
		x = 0;
		while (x < tetris->width)
		{
			if (!tetris->array[y][x])
				break ;
			if (tetris->array[y][x] == '#')
				params->map->array[pos->y + y][pos->x + x] = to_set;
			x++;
		}
		y++;
	}
	free(pos);
}

int		solve_map(t_params *params, t_tetris *tetris)
{
	int		x;
	int		y;

	if (tetris == NULL)
		return (1);
	y = 0;
	while (y < params->map->size - tetris->height + 1)
	{
		x = 0;
		while (x < params->map->size - tetris->width + 1)
		{
			if (try_set(params, tetris, new_pos(x, y)))
			{
				if (solve_map(params, tetris->id + 1 < params->size \
					? tetris->next : NULL))
					return (1);
				else
					set(params, tetris, new_pos(x, y), '.');
			}
			x++;
		}
		y++;
	}
	return (0);
}
