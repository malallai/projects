/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/06 14:55:36 by malallai          #+#    #+#             */
/*   Updated: 2018/11/06 16:48:11 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "display_file.h"

int		main(int argc, char **argv)
{
	if (argc == 1)
	{
		ft_putstr("File name missing.\n");
		return (0);
	}
	else if (argc >= 3)
	{
		ft_putstr("Too many arguments.\n");
		return (0);
	}
	ft_display_file(argv[1]);
	return (0);
}
