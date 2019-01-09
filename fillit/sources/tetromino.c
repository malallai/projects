/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetromino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 15:56:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

char		**new_array(void)
{
	char	**new_array;
	size_t	i;

	i = 0;
	if ((new_array = (char **)malloc(sizeof(char **) * 5)))
	{
		while (i < 4)
		{
			if (!(new_array[i] = ft_strnew(4)))
				return (NULL);
			i++;
		}
		new_array[i] = 0;
	}
	else
		return (NULL);
	return (new_array);
}

int			init_tetris(t_tetris **tetris, t_infos *infos)
{
	t_tetris *tmp;

	if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
		return (print_error(infos));
	tmp->next = NULL;
	if (!(tmp->array = new_array()))
		return (print_error(infos));
	tmp->id = 0;
	infos->last = tmp;
	*tetris = tmp;
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
	if (!(tmp->array = new_array()))
		return (print_error(infos));
	last->next = tmp;
	infos->last = tmp;
	return (1);
}

int			check_tetro(t_tetris *tetris, t_infos *infos)
{
	size_t id;

	if (!(tetris->charl = convert_to_array(tetris, 'A' + tetris->id)))
		return (print_error(infos));
	if (!(tetris->chard = convert_to_array(tetris, '#')))
		return (print_error(infos));
	id = ft_count_char(tetris->chard, '#');
	if (id != 4)
		return (print_error(infos));
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
