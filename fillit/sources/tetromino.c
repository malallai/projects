/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetromino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 15:26:26 by malallai         ###   ########.fr       */
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

int			new_tetris(t_tetris **tetris, t_infos *infos, int id)
{
	t_tetris *tmp;
	t_tetris *last;

	if (!id)
	{
		if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
			return (print_error(infos));
		tmp->next = NULL;
		if (!(tmp->array = new_array()))
			return (print_error(infos));
		tmp->id = 0;
		infos->last = tmp;
		*tetris = tmp;
	}
	else
	{
		last = infos->last;
		if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
			return (print_error(infos));
		tmp->next = NULL;
		tmp->id = last->id + 1;
		if (!(tmp->array = new_array()))
			return (print_error(infos));
		last->next = tmp;
		infos->last = tmp;
	}
	return (1);
}

int			convert_to_array(t_tetris *tetris, t_infos *infos)
{
	char	*temp;
	int		i;
	int		j;
	int		index;
	
	i = 0;
	j = 0;
	index = 0;
	if (!(temp = ft_strnew(21)))
		return (print_error(infos));
	while (tetris->array[i])
	{
		while (tetris->array[i][j])
		{
			temp[index++] = tetris->array[i][j] == '#' ? 'A' + tetris->id : \
				tetris->array[i][j];
			j++;
		}
		temp[index++] = '\n';
		j = 0;
		i++;
	}
	tetris->tochar = temp;
	return (1);
}
