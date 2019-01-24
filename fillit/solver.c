/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   solver.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/24 16:02:14 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		read_tetris(t_params *p)
{
	int			r;
	int			index;
	t_tetris	*tetris;
	t_pos		*pos;

	index = 0;
	p->buff_tmp = ft_strnew(22);
	pos = new_pos(0, 0);
	if ((r = read(p->fd, p->buff_tmp, 21)) >= 20)
	{
		if (!new_tetris(p))
			exit_fillit(p, 1);
		tetris = p->last;
		tetris->chard = ft_strdup(p->buff_tmp);
		while (p->buff_tmp[index] && is_valid_char(p->buff_tmp[index], 1))
		{
			tetris->full_array[pos->y][pos->x] = p->buff_tmp[index] == '\n'
				? tetris->full_array[pos->y][pos->x] : p->buff_tmp[index];
			edit_pos(pos, 3, 3, p->buff_tmp[index++]);
		}
	}
	free(p->buff_tmp);
	free(pos);
	return (r);
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
