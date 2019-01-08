/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/08 20:53:30 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int			read_tetris(int fd, t_tetris **tetris, t_infos *infos)
{
	int			r;
	char		*buffer;
	char		**array;
	int			index;
	t_tetris	*tetro;

	index = 0;
	buffer = ft_strnew(22);
	infos->x = 0;
	infos->y = 0;
	if ((r = read(fd, buffer, 21)))
	{
		if (infos->size > 0)
			new_tetris(tetris, infos, 1);
		tetro = infos->last;
		array = tetro->array;
		buffer[21] = '\0';
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			array[infos->y][infos->x] = buffer[index] == '\n' ? array[infos->y][infos->x] : buffer[index];
			if (!edit_infos(infos, buffer[index++]))
				break ;
		}
		if (index != 21)
			return (-1);
		infos->size = infos->size + 1;
	}
	ft_strdel(&buffer);
	return (r == 0 ? 0 : 1);
}