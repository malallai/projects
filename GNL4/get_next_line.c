/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/12/18 11:07:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"
#include <stdio.h>

static int		get_line(int fd, char *buffer, char **save)
{
	int		r;
	char	*temp;

	while ((r = read(fd, buffer, BUFF_SIZE)) > 0)
	{
		buffer[r] = '\0';
		temp = *save;
		*save = ft_strjoin(temp, buffer);
		ft_strdel(&temp);
		if (ft_strchr(buffer, '\n'))
			break ;
	}
	ft_strdel(&buffer);
	return (r == -1 ? 0 : 1);
}

int				get_next_line(const int fd, char **line)
{
	static char		*save;
	char			*buffer;
	char			*temp;
	char			*temp2;

	buffer = ft_strnew(BUFF_SIZE);
	if (fd < 0 || line == NULL || buffer == NULL
		|| BUFF_SIZE < 1)
		return (-1);
	if (!save)
		save = ft_strnew(1);
	if (!get_line(fd, buffer, &save))
		return (-1);
	if ((temp = ft_strchr(save, '\n')))
	{
		*line = ft_strsub(save, 0, temp - save);
		temp2 = save;
		save = ft_strdup(temp + 1);
		ft_strdel(&temp2);
		return (1);
	}
	*line = ft_strdup(save);
	ft_strdel(&save);
	return (ft_strlen(*line) > 0 ? 1 : 0);
}
