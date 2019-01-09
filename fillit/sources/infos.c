/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   infos.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:27:56 by malallai          #+#    #+#             */
/*   Updated: 2019/01/08 12:33:33 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			edit_infos(t_infos *infos, char c, int end)
{
	if (c == '\n')
		return (1);
	if (infos->x == 3 && infos->y < 3)
	{
		infos->x = 0;
		infos->y++;
	}
	else if (infos->x < 3)
		infos->x++;
	if (end)
	{
		if (infos->x == 3 && infos->y == 3)
		{
			infos->x = 0;
			infos->y = 0;
			infos->size = infos->size + 1;
		}
		else
			return (0);
	}
	return (1);
}

t_infos		*new_infos(void)
{
	t_infos *infos;

	infos = malloc(sizeof(t_infos));
	infos->x = 0;
	infos->y = 0;
	infos->last = NULL;
	infos->size = 0;
	return (infos);
}
