/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   freeutils.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/09 14:02:56 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 15:05:24 by malallai         ###   ########.fr       */
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

int		free_tetris(t_tetris *tetris)
{
	t_tetris *tmp;

	while (tetris)
	{
		tmp = tetris->next;
		free_array(tetris->array);
		free(tetris->charl);
		free(tetris->chard);
		free(tetris);
		tetris = tmp;
	}
	return (1);
}
