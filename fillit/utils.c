/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/15 14:31:23 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		exit_fillit(t_params *params, int error)
{
	if (error)
		ft_putendl("error");
	if (params)
	{
		close(params->fd);
		free_tetris(params->tetris);
		if (params->map)
		{
			ft_freearray(params->map->array);
			free(params->map);
		}
		free(params);
	}
	exit(-1);
	return (-1);
}

int		free_tetris(t_tetris *tetris)
{
	t_tetris	*tmp;

	while (tetris)
	{
		tmp = tetris->next;
		ft_freearray(tetris->array);
		ft_freearray(tetris->full_array);
		free(tetris->chard);
		free(tetris);
		tetris = tmp;
	}
	return (1);
}

int		remove_dots(t_tetris *tetris)
{
	char	c;
	int		index;
	char	*tmp;

	index = 0;
	tmp = ft_strdup(tetris->chard);
	while (index < 20)
	{
		if (!is_valid_char(tmp[index]))
			return (0);
		if (check(tmp, index))
			c = ' ';
		else
			c = tmp[index];
		tmp[index] = c;
		index++;
	}
	tmp = ft_strreplace(tmp, '.', 0);
	free(tetris->array);
	tetris->array = ft_strsplit(tmp, '\n');
	free(tmp);
	return (1);
}

int		check(char *str, int index)
{
	if (str[index] == '.')
	{
		if ((index + 1 < 20 && str[index + 1] == '#')
			|| (index + 2 < 20 && str[index + 2] == '#'))
		{
			if ((index + 5 < 20 && str[index + 5] == '#')
				|| (index - 5 >= 0 && str[index - 5] == '#'))
				return (1);
			else if ((index + 10 < 20 && str[index - 10] == '#')
				|| (index - 10 < 20 && str[index - 10] == '#'))
				return (1);
		}
	}
	return (0);
}

void	get_size(t_tetris *tetris)
{
	t_pos	*pos;

	pos = new_pos(0, 0);
	while (!pos->index)
	{
		if (!tetris->height)
		{
			while (tetris->array[pos->y])
			{
				tetris->height += tetris->array[pos->y][0] ? 1 : 0;
				pos->y++;
			}
			pos->y = 0;
		}
		while (tetris->array[pos->y][pos->x])
			pos->x++;
		tetris->width = tetris->width < pos->x ? pos->x : tetris->width;
		pos->y++;
		pos->x = 0;
		pos->index = pos->y == tetris->height ? 1 : 0;
	}
	free(pos);
}
