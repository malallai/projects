/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetrimino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/16 16:45:48 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int			new_tetris(t_params *params)
{
	t_tetris *tmp;

	if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))) || \
		!(tmp->full_array = ft_newarray(5, 4, 0)) || \
		!(tmp->array = ft_newarray(5, 4, 0)))
		return (0);
	if (!params->init)
	{
		params->init = 1;
		tmp->id = 0;
		tmp->parent = NULL;
		params->tetris = tmp;
	}
	else
	{
		tmp->parent = params->last;
		tmp->id = params->last->id + 1;
		params->last->next = tmp;
	}
	tmp->width = 0;
	tmp->height = 0;
	params->last = tmp;
	return (1);
}

int			check_tetro(t_params *params)
{
	t_tetris	*tetris;
	size_t		size;

	tetris = params->last;
	size = ft_strlen(tetris->chard);
	if (size < 20)
		return (0);
	if (!remove_dots(tetris))
		return (0);
	if (ft_count_char(tetris->chard, '#') != 4 || !check_connection(tetris))
		return (0);
	get_size(tetris);
	return (1);
}

int			check_connection(t_tetris *tetris)
{
	int	block;
	int	i;

	block = 0;
	i = 0;
	while (i < 20)
	{
		if (tetris->chard[i] == '#')
		{
			if ((i + 1) < 20 && tetris->chard[i + 1] == '#')
				block++;
			if ((i - 1) >= 0 && tetris->chard[i - 1] == '#')
				block++;
			if ((i + 5) < 20 && tetris->chard[i + 5] == '#')
				block++;
			if ((i - 5) >= 0 && tetris->chard[i - 5] == '#')
				block++;
		}
		i++;
	}
	return (block == 6 || block == 8);
}
