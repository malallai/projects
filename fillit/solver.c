/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   solver.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/13 18:15:35 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		read_tetris(t_params *p)
{
	int			r;
	char		*buffer;
	int			index;
	t_tetris	*tetris;
	t_pos		*pos;

	index = 0;
	buffer = ft_strnew(22);
	tetris = p->last;
	pos = new_pos(0, 0);
	if ((r = read(p->fd, buffer, 21)))
	{
		buffer[21] = '\0';
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			tetris->full_array[pos->y][pos->x] = buffer[index] == '\n'
				? tetris->full_array[pos->y][pos->x] : buffer[index];
			edit_pos(pos, 3, 3, buffer[index++]);
		}
	}
	ft_strdel(&buffer);
	free(pos);
	return (r && index == 21 ? 1 : 0);
}

int		solve(t_params *params)
{
	t_map		*map;
	int			size;
	int			i;

	i = 0;
	size = ft_sqrt(params->size * 4);
	map = new_map(params, size);
	while (!solve_map(params, params->tetris))
	{
		size++;
		ft_freearray(params->map->array);
		free(params->map);
		map = new_map(params, size);
	}
	while (params->map->array[i])
		ft_putendl(params->map->array[i++]);
	return (1);
}

int		solve_map(t_params *params, t_tetris *tetris)
{
	t_pos	*pos;

	pos = new_pos(0, 0);
	while (pos->y < params->map->size && pos->x < params->map->size)
	{
		if (try_set(params, tetris, new_pos(pos->x, pos->y)))
		{
			if (!tetris->next || solve_map(params, tetris->next))
				return (1);
			else
				set(params, tetris, new_pos(pos->x, pos->y), '.');
		}
		edit_pos(pos, params->map->size, params->map->size, 0);
	}
	free(pos);
	return (0);
}
