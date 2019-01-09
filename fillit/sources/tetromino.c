/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetromino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 17:43:08 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			init_tetris(t_tetris **tetris, t_infos *infos)
{
	t_tetris *tmp;

	if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
		return (print_error(infos));
	tmp->next = NULL;
	if (!(tmp->array = ft_arraynew(5, 4)))
		return (print_error(infos));
	tmp->id = 0;
	infos->last = tmp;
	*tetris = tmp;
	infos->tetris = tetris;
	return (1);
}

int			new_tetris(t_infos *infos)
{
	t_tetris *tmp;
	t_tetris *last;

	last = infos->last;
	if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
		return (print_error(infos));
	tmp->next = NULL;
	tmp->id = last->id + 1;
	if (!(tmp->array = ft_arraynew(5, 4)))
		return (print_error(infos));
	last->next = tmp;
	infos->last = tmp;
	return (1);
}

char		*convert_to_array(t_tetris *tetris, char c)
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

int			check_tetro(t_tetris *tetris, t_infos *infos)
{
	if (!(tetris->charl = convert_to_array(tetris, 'A' + tetris->id)))
		return (print_error(infos));
	if (!(tetris->chard = convert_to_array(tetris, '#')))
		return (print_error(infos));
	if (ft_count_char(tetris->chard, '#') != 4 || !check_connection(tetris))
		return (print_error(infos));
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
