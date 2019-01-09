/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/09 12:41:12 by malallai         ###   ########.fr       */
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

void	fillit(char **argv)
{
	int			ret;
	t_tetris	*tetris;
	t_infos		*infos;

	ret = 0;
	infos = new_infos();
	if (!new_tetris(&tetris, infos, 0))
		return (print_error());
	while ((ret = read_tetris(ft_atoi(argv[2]), &tetris, infos)) == 1)
		;
	if (ret == -1)
		return (print_error());
	//print_arrays(tetris);
	free_tetris(&tetris);
	free(infos);
}
