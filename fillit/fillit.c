/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/15 11:53:54 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		fillit(t_params *params)
{
	int	ret;

	ret = 0;
	if (!new_tetris(params))
		return (0);
	while ((ret = read_tetris(params)) == 1)
	{
		params->size = params->size + 1;
		if (!check_tetro(params))
			return (0);
		if (params->size > 26)
			return (0);
		if (!new_tetris(params))
			return (0);
	}
	if (ret == -1)
		return (0);
	return (1);
}

int		main(int argc, char **argv)
{
	int			fd;
	t_params	*params;

	params = NULL;
	if (argc != 2)
	{
		ft_putendl("Usage: ./fillit [file]");
		return (0);
	}
	else
	{
		fd = open(argv[1], O_RDONLY);
		if (fd < 0)
			return (exit_fillit(params, 1));
		if (!(params = new_params(fd)))
			return (exit_fillit(params, 1));
		if (!fillit(params))
			return (exit_fillit(params, 1));
		if (!solve(params))
			return (exit_fillit(params, 1));
		exit_fillit(params, 0);
	}
	return (0);
}
