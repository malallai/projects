/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetromino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 13:28:48 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			init_tetris(t_infos *infos)
{
	t_tetris *tmp;

	if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
		return (0);
	tmp->next = NULL;
	if (!(tmp->array = ft_newarray(5, 4)))
		return (0);
	tmp->id = 0;
	infos->last = tmp;
	infos->tetris = tmp;
	return (1);
}

int			new_tetris(t_infos *infos)
{
	t_tetris *tmp;
	t_tetris *last;

	last = infos->last;
	if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
		return (0);
	tmp->next = NULL;
	tmp->id = last->id + 1;
	if (!(tmp->array = ft_newarray(5, 4)))
		return (0);
	last->next = tmp;
	infos->last = tmp;
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

int			check_tetro(t_infos *infos)
{
	t_tetris *tetris;

	tetris = infos->last;
	if (!(tetris->charl = convert_to_string(tetris, 'A' + tetris->id)))
		return (0);
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
