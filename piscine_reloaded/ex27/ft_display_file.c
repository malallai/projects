/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_display_file.c                                  :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/06 15:03:11 by malallai          #+#    #+#             */
/*   Updated: 2018/11/06 15:57:19 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "display_file.h"
#include <stdio.h>

void	ft_display_file(char *file)
{
	int		fd;
	char	content;

	if ((fd = open(file, O_RDONLY)) == -1)
		ft_putstr("open failed.");
	else
	{
		while (read(fd, &content, 1))
		{
			ft_putchar(content);
		}
		if (close(fd) == -1)
			ft_putstr("close failed.");
	}
}
