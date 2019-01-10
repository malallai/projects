/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   infos.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:27:56 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 13:15:28 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int		edit_infos(t_infos *infos, char c, int end)
{
	if (c == '\n')
		return (1);
	if (infos->tmp_x == 3 && infos->tmp_y < 3)
	{
		infos->tmp_x = 0;
		infos->tmp_y++;
	}
	else if (infos->tmp_x < 3)
		infos->tmp_x++;
	if (end)
	{
		if (infos->tmp_x == 3 && infos->tmp_y == 3)
		{
			infos->tmp_x = 0;
			infos->tmp_y = 0;
			infos->size = infos->size + 1;
		}
		else
			return (0);
	}
	return (infos->size > 26 ? 0 : 1);
}

t_infos	*new_infos(int fd)
{
	t_infos *infos;

	if (!(infos = malloc(sizeof(t_infos))))
		return (NULL);
	infos->tmp_x = 0;
	infos->tmp_y = 0;
	infos->last = NULL;
	infos->size = 0;
	infos->fd = fd;
	return (infos);
}
