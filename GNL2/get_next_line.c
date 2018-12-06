/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/12/06 22:40:15 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

static int		get_line(int fd, char *buffer, char *files[fd])
{
	int		ret;
	char	*temp;

	while ((ret = read(fd, buffer, BUFF_SIZE)) > 0)
	{
		buffer[ret] = '\0';
		temp = files[fd];
		files[fd] = ft_strjoin(temp, buffer);
		ft_strdel(&temp);
		if (ft_strchr(buffer, '\n'))
			break;
	}
	if (buffer)
		ft_strdel(&buffer);
	return (ret == -1 ? 0 : 1);
}

int				get_next_line(const int f, char **line)
{
	static char		*files[0];
	char			*b;
	char			*temp;
	char			*temp2;

	b = ft_strnew(BUFF_SIZE);
	if (f < 0 || line == NULL || b == NULL || BUFF_SIZE < 1)
		return (-1);
	if (!files[f])
		files[f] = ft_strnew(1);
	if (get_line(f, b, files) == 0)
		return (-1);
	if ((temp = ft_strchr(files[f], '\n')))
	{
		*line = ft_strsub(files[f], 0, temp - files[f]);
		temp2 = files[f];
		files[f] = ft_strdup(temp + 1);
		ft_strdel(&temp2);
		return (1);
	}
	*line = ft_strdup(files[f]);
	files[f] = NULL;
	return (ft_strlen(*line) > 0 ? 1 : 0);
}
