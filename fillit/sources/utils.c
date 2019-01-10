/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 14:03:14 by malallai          #+#    #+#             */
/*   Updated: 2019/01/10 15:05:57 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../includes/fillit.h"

int		print_error(t_infos *infos)
{
	ft_putendl("error");
	exit_fillit(infos);
	return (-1);
}

int		exit_fillit(t_infos *infos)
{
	if (infos)
	{
		if (infos->tetris)
			free_tetris(infos->tetris);
		close(infos->fd);
		free(infos);
	}
	exit(-1);
	return (-1);
}

int		is_valid_char(char c)
{
	return (c == '.' || c == '#' || c == '\n');
}
