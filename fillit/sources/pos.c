/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   pos.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:27:56 by malallai          #+#    #+#             */
/*   Updated: 2019/01/07 16:28:05 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			edit_pos(t_pos **pos, char c)
{
	if (c == '\n')
		return (1);
	if ((*pos)->x == 3 && (*pos)->y < 3)
	{
		(*pos)->x = 0;
		(*pos)->y++;
	}
	else if ((*pos)->x < 3)
		(*pos)->x++;
	if ((*pos)->x > 3 && (*pos)->y > 3)
		return (0);
	return (1);
}

t_pos		*new_pos()
{
	t_pos *pos;

	pos = malloc(sizeof(t_pos));
	pos->x = 0;
	pos->y = 0;
	return (pos);
}
