/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetrimino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/13 17:44:01 by malallai         ###   ########.fr       */
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
		tmp->next = NULL;
		tmp->id = 0;
		params->last = tmp;
		params->tetris = tmp;
	}
	else
	{
		tmp->next = NULL;
		tmp->id = params->last->id + 1;
		params->last->next = tmp;
		params->last = tmp;
	}
	return (1);
}

char		*convert_to_string(t_tetris *tetris, char c)
{
	char	*tmp;
	int		i;
	int		j;
	int		index;

	i = 0;
	j = 0;
	index = 0;
	if (!(tmp = ft_strnew(21)))
		return (NULL);
	while (tetris->array[i])
	{
		while (tetris->array[i][j])
		{
			tmp[index++] = tetris->array[i][j] == '#' ? c : tetris->array[i][j];
			j++;
		}
		tmp[index++] = '\n';
		j = 0;
		i++;
	}
	return (tmp);
}

int			check_tetro(t_params *params)
{
	t_tetris *tetris;

	tetris = params->last;
	if (!(tetris->chard = convert_to_string(tetris, '#')))
		return (0);
	if (ft_count_char(tetris->chard, '#') != 4 || !check_connection(tetris))
		return (0);
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
