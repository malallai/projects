/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/12/18 11:44:37 by malallai         ###   ########.fr       */
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

static char		**check_static(int fd)
{
	static char *save;
	static int	f;

	if (!save)
	{
		f = fd;
		save = ft_strnew(1);
	}
	if (f != fd)
		return (NULL);
	return (&save);
}

int				get_next_line(const int fd, char **line)
{
	char	*buffer;
	char	*temp;
	char	*temp2;
	char	**content;

	buffer = ft_strnew(BUFF_SIZE);
	if (!(content = check_static(fd)) || fd < 0 || line == NULL
		|| buffer == NULL || BUFF_SIZE < 1)
		return (-1);
	if (!get_line(fd, buffer, &*content))
		return (-1);
	if ((temp = ft_strchr(*content, '\n')))
	{
		*line = ft_strsub(*content, 0, temp - *content);
		temp2 = *content;
		*content = ft_strdup(temp + 1);
		ft_strdel(&temp2);
		return (1);
	}
	*line = ft_strdup(*content);
	ft_strdel(&*content);
	return (ft_strlen(*line) > 0 ? 1 : 0);
}
