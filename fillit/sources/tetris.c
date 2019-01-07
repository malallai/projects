/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   tetris.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/07 16:11:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

char		**new_array(size_t size)
{
	char	**new_array;
	size_t	i;

	i = 0;
	if ((new_array = (char **)malloc(sizeof(char **) * size + 1)))
	{
		while (i < size)
		{
			new_array[i] = ft_strnew(size);
			i++;
		}
		new_array[i] = 0;
	}
	else
		return (NULL);
	return (new_array);
}

void		new_tetris(t_tetris **tetris)
{
	t_tetris *tmp;

	tmp = *tetris;
	tmp = (t_tetris *)malloc(sizeof(t_tetris));
	tmp->next = *tetris;
	tmp->id = (*tetris)->id + 1;
	*tetris = tmp;
}

int			edit_pos(t_pos **pos, char c)
{
	if (c == '\n')
		return (1);
	if ((*pos)->x == 3 && (*pos)->y < 3)
	{
		(*pos)->x = 0;
		(*pos)->y++;
	}
	else if ((*pos)->x < 3)
		(*pos)->x++;
	if ((*pos)->x > 3 && (*pos)->y > 3)
		return (0);
	return (1);
}

t_pos		*new_pos()
{
	t_pos *pos;

	pos = malloc(sizeof(t_pos));
	pos->x = 0;
	pos->y = 0;
	return (pos);
}

int			read_tetris(int fd, t_tetris **tetris)
{
	int		r;
	char	*buffer;
	char	**array;
	t_pos	*pos;
	int		index;

	index = 0;
	buffer = ft_strnew(22);
	if ((r = read(fd, buffer, 21)))
	{
		new_tetris(tetris);
		array = new_array(4);
		pos = new_pos();
		buffer[21] = '\0';
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			array[pos->y][pos->x] = buffer[index] == '\n' ? array[pos->y][pos->x] : buffer[index];
			index++;
			if (!edit_pos(&pos, buffer[index]))
				break ;
		}
		if (index != 21)
			return (-1);
		(*tetris)->array = array;
	}
	ft_strdel(&buffer);
	return (r == 0 ? 0 : 1);
}