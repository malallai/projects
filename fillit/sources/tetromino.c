/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetromino.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 16:22:31 by malallai          #+#    #+#             */
/*   Updated: 2019/01/08 11:51:29 by malallai         ###   ########.fr       */
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
				return ((char **)free_array(new_array));
			i++;
		}
		new_array[i] = 0;
	}
	else
		return (NULL);
	return (new_array);
}

void		**free_array(char **array)
{
	int index;

	index = 0;
	while (array[index])
	{
		free(array[index]);
		index++;
	}
	free(array);
	return (0);
}

void		free_tetris(t_tetris **tetris)
{
	t_tetris *tmp;
	t_tetris *tmp_next;

	tmp = *tetris;
	while (tmp)
	{
		tmp_next = tmp->next;
		free_array(tmp->array);
		free(tmp);
		tmp = tmp_next;
	}
}

int			new_tetris(t_tetris **tetris, t_infos *infos, int id)
{
	t_tetris *tmp;
	t_tetris *last;

	if (!id)
	{
		if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
			return (-1);
		tmp->next = NULL;
		tmp->array = new_array();
		tmp->id = 0;
		infos->last = tmp;
		*tetris = tmp;
	}
	else
	{
		last = infos->last;
		if (!(tmp = (t_tetris *)malloc(sizeof(t_tetris))))
			return (-1);
		tmp->next = NULL;
		tmp->id = last->id + 1;
		tmp->array = new_array();
		last->next = tmp;
		infos->last = tmp;
	}
	return (1);
}
