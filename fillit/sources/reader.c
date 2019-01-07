/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/07 17:16:33 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			read_tetris(int fd, t_tetris **tetris, t_pos *pos)
{
	int		r;
	char	*buffer;
	char	**array;
	int		index;

	index = 0;
	buffer = ft_strnew(22);
	pos->x = 0;
	pos->y = 0;
	if ((r = read(fd, buffer, 21)))
	{
		array = (*tetris)->array;
		buffer[21] = '\0';
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			array[pos->y][pos->x] = buffer[index] == '\n' ? array[pos->y][pos->x] : buffer[index];
			index++;
			if (!edit_pos(&pos, buffer[index]))
				break ;
		}
		if (index == 21 && r > 0)
			new_tetris(tetris);
		if (index != 21)
			return (-1);
	}
	ft_strdel(&buffer);
	return (r == 0 ? 0 : 1);
}