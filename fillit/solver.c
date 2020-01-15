/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   solver.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/29 12:27:49 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		read_tetris(t_params *params)
{
	int	r;

	params->buff_tmp = ft_strnew(22);
	if ((r = read(params->fd, params->buff_tmp, 21)) >= 20)
	{
		if (!copy_read(params))
			exit_fillit(params, 3);
	}
	free(params->buff_tmp);
	return (r);
}

int		copy_read(t_params *p)
{
	t_tetris	*tetris;
	t_pos		*pos;
	int			index;

	index = 0;
	if (!new_tetris(p))
		return (0);
	pos = new_pos(0, 0);
	tetris = p->last;
	tetris->string = ft_strdup(p->buff_tmp);
	while (p->buff_tmp[index] && is_valid_char(p->buff_tmp[index], 1))
	{
		tetris->full_array[pos->y][pos->x] = p->buff_tmp[index] == '\n'
			? tetris->full_array[pos->y][pos->x] : p->buff_tmp[index];
		edit_pos(pos, 3, 3, p->buff_tmp[index++]);
	}
	free(pos);
	return (1);
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
