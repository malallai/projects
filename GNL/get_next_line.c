/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/11/19 19:51:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <get_next_line.h>

static int	ft_copyuntil(char **dst, char *src, char c)
{
	int		i;

	i = -1;
	while (src[++i])
		if (src[i] == c)
			break ;
	if (!(*dst = ft_strnew(i)))
		return (0);
	ft_strccpy(*dst, src, c);
	return (i);
}

int			get_next_line(const int fd, char **line)
{
	char			buff[BUFF_SIZE];
	//static t_list	file;
	//int				i;
	int				r;
	char			*tmp;

	while ((r = read(fd, buff, BUFF_SIZE)))
	{
		buff[r] = '\0';
		tmp = ft_strjoin(tmp, buff);
		if (ft_strchr(buff, '\n'))
			break;
	}
	ft_copyuntil(line, tmp, '\n');
	printf("%s\n", *line);
	return (1);
}
