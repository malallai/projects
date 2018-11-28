/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/11/28 16:22:24 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

static t_list		*ft_getfile(int fd)
{
	t_list			*tmp;
	static t_list	*files;

	tmp = files;
	while (tmp)
	{
		if ((int)tmp->content_size == fd)
			return (tmp);
		tmp = tmp->next;
	}
	if (!(tmp = ft_lstnew("\0", 1)))
		return (NULL);
	tmp->content_size = fd;
	ft_lstadd(&files, tmp);
	tmp = files;
	return (tmp);
}

static int			ft_cpy(t_list *list, char *buff)
{
	char	*tmp;
	int		r;

	r = 1;
	if ((tmp = ft_strjoin(list->content, buff)))
	{
		free(list->content);
		if ((list->content = ft_strnew(ft_strlen(tmp))))
			ft_strcpy(list->content, tmp);
		else
			r = 0;
	}
	else
		r = 0;
	free(tmp);
	return (r);
}

static void			ft_check(t_list *list, size_t r)
{
	char	*tmp;
	size_t	len;

	if (r < ft_strlen(list->content))
	{
		len = ft_strlen(tmp) - r - 1;
		tmp = ft_strdup(list->content);
		free(list->content);
		list->content = ft_strsub(tmp, r + 1, len);
		free(tmp);
	}
	else
		free(list->content);
}

int					get_next_line(const int f, char **line)
{
	char			*b;
	size_t			r;
	t_list			*list;

	b = ft_strnew(BUFF_SIZE);
	if (f < 0 || line == NULL || read(f, b, 0) < 0 || !(list = ft_getfile(f)))
		return (-1);
	while ((r = read(f, b, BUFF_SIZE)))
	{
		b[r] = '\0';
		if (!(ft_cpy(list, b)))
			return (-1);
		if (r < BUFF_SIZE)
		{
			if (ft_strchr(b, '\n'))
				break ;
		}
	}
	if (r < BUFF_SIZE && !ft_strlen(list->content))
	{
		free(list->content);
		list->content_size = -1;
		return (0);
	}
	r = ft_copyuntil(line, list->content, '\n');
	ft_check(list, r);
	return (1);
}
