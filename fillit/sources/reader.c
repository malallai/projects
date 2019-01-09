/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 12:26:41 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			read_tetris(int fd, t_tetris **tetris, t_infos *infos)
{
	int			r;
	char		*buffer;
	int			index;
	t_tetris	*tetro;

	index = 0;
	buffer = ft_strnew(22);
	if ((r = read(fd, buffer, 21)))
	{
		if (infos->size > 0)
			new_tetris(tetris, infos, 1);
		tetro = infos->last;
		buffer[21] = '\0';
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			tetro->array[infos->y][infos->x] = buffer[index] == '\n' ? \
				tetro->array[infos->y][infos->x] : buffer[index];
			edit_infos(infos, buffer[index++], 0);
		}
		edit_infos(infos, buffer[index], 1);
		if (index != 21)
			r = -1;
	}
	ft_strdel(&buffer);
	return (r >= 1 ? 1 : r);
}
