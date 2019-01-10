/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   solver.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 17:17:38 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			is_valid_char(char c)
{
	return (c == '.' || c == '#' || c == '\n');
}

int			read_tetris(t_infos *infos)
{
	int			r;
	char		*buffer;
	int			index;
	t_tetris	*tetris;

	index = 0;
	buffer = ft_strnew(22);
	if ((r = read(infos->fd, buffer, 21)))
	{
		buffer[21] = '\0';
		if (infos->size > 0)
			if (!new_tetris(infos))
				return (0);
		tetris = infos->last;
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			tetris->array[infos->pos->y][infos->pos->x] = buffer[index] == \
			'\n' ? tetris->array[infos->pos->y][infos->pos->x] : buffer[index];
			edit_infos(infos, buffer[index++], 0);
		}
		if (!edit_infos(infos, buffer[index], 1) || index != 21)
			r = -1;
	}
	ft_strdel(&buffer);
	return (r >= 1 ? 1 : r);
}
