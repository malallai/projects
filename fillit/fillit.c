/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   fillit.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/08 20:53:22 by malallai          #+#    #+#             */
/*   Updated: 2019/01/25 04:17:22 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		fillit(t_params *params)
{
	int	ret;

	while ((ret = read_tetris(params)) > 0)
	{
		params->size = params->size + 1;
		if (ret < 20 || !check_tetro(params, ret) || params->size > 26)
			return (0);
	}
	if (!ret && (!params->size || ft_strlen(params->last->string) != 20))
		return (0);
	if (!solve(params))
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
		if ((fd = open(argv[1], O_RDONLY)) < 0 \
			|| !(params = new_params(fd)))
			return (exit_fillit(params, 1));
		if (!fillit(params))
			exit_fillit(params, 1);
		exit_fillit(params, 0);
	}
	return (0);
}
