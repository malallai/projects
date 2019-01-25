/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   maths.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/13 17:03:07 by malallai          #+#    #+#             */
/*   Updated: 2019/01/25 04:15:50 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		ft_sqrt(int n)
{
	int size;

	size = 2;
	while (size * size < n)
		size++;
	return (size);
}

int		is_valid_char(char c, int i)
{
	if (!i)
		return (c == '\n' ? 0 : 1);
	return (c == '.' || c == '#' || c == '\n');
}

void	get_size(t_tetris *tetris)
{
	t_pos	*pos;

	pos = new_pos(0, 0);
	while (!pos->index)
	{
		if (!tetris->height)
		{
			while (tetris->array[pos->y])
			{
				tetris->height += tetris->array[pos->y][0] ? 1 : 0;
				pos->y++;
			}
			pos->y = 0;
		}
		while (tetris->array[pos->y][pos->x])
			pos->x++;
		tetris->width = tetris->width < pos->x ? pos->x : tetris->width;
		pos->y++;
		pos->x = 0;
		pos->index = pos->y == tetris->height ? 1 : 0;
	}
	free(pos);
}
