/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 15:19:43 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

void	print_arrays(t_tetris *tetris)
{
	char	**array;
	int		index;

	index = 0;
	while (tetris)
	{
		array = tetris->array;
		while (array[index])
			printf("id : %d line : %s\n", tetris->id, array[index++]);
		printf("\n");
		tetris = tetris->next;
		index = 0;
	}
}

int		fillit(int fd)
{
	int			ret;
	t_tetris	*tetris;
	t_infos		*infos;

	ret = 0;
	if (!(infos = new_infos(fd)))
		return (-1);
	if ((new_tetris(&tetris, infos, 0)) != 1)
		return (print_error(infos));
	infos->tetris = &tetris;
	while ((ret = read_tetris(fd, &tetris, infos)) == 1)
	{
		convert_to_array(infos->last, infos);
	}
	if (ret == -1)
		return (print_error(infos));
	//print_arrays(tetris);
	exit_fillit(infos);
	return (1);
}
