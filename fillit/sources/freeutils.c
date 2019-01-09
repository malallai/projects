/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   freeutils.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/09 14:02:56 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 15:42:34 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int		free_array(char **array)
{
	int index;

	index = 0;
	while (array[index])
	{
		free(array[index]);
		index++;
	}
	free(array);
	return (1);
}

int		free_tetris(t_tetris **tetris)
{
	t_tetris *tmp;
	t_tetris *tmp_next;

	tmp = *tetris;
	while (tmp)
	{
		tmp_next = tmp->next;
		free_array(tmp->array);
		free(tmp->charl);
		free(tmp->chard);
		free(tmp);
		tmp = tmp_next;
	}
	return (1);
}

int		free_infos(t_infos *infos)
{
	free(infos);
	return (1);
}
