/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   params.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/13 17:54:55 by malallai          #+#    #+#             */
/*   Updated: 2019/01/28 21:46:14 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int			edit_pos(t_pos *pos, int max_x, int max_y, char c)
{
	if (c == '\n')
		return (1);
	if (pos->x == max_x && pos->y < max_y)
	{
		pos->x = 0;
		pos->y++;
	}
	else if (pos->x < max_x)
		pos->x++;
	pos->index++;
	return (1);
}

t_pos		*new_pos(int x, int y)
{
	t_pos *pos;

	if (!(pos = malloc(sizeof(t_pos))))
		return (NULL);
	pos->x = x;
	pos->y = y;
	pos->index = 0;
	return (pos);
}

t_params	*new_params(int fd)
{
	t_params *params;

	if (!(params = malloc(sizeof(t_params))))
		return (NULL);
	params->init = 0;
	params->last = NULL;
	params->size = 0;
	params->fd = fd;
	params->map = NULL;
	params->tetris = NULL;
	return (params);
}
