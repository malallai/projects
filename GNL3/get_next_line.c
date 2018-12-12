/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/12/12 16:15:37 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

static t_list		*ft_getfile(int fd)
{
	t_list			*tmp;
	static t_list	*files;

	tmp = files;
	if (fd && tmp && (int)tmp->content_size == fd)
		return (tmp);
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

	if ((tmp = ft_strjoin(list->content, buff)))
	{
		free(list->content);
		list->content = tmp;
	}
	else
		return (0);
	return (1);
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
		((char *)list->content)[0] = '\0';
}

int					get_next_line(const int f, char **line)
{
	char			b[BUFF_SIZE + 1];
	size_t			r;
	t_list			*list;

	if (f < 0 || line == NULL || read(f, b, 0) < 0 || !(list = ft_getfile(f)))
		return (-1);
	while ((r = read(f, b, BUFF_SIZE)))
	{
		b[r] = '\0';
		if (!(ft_cpy(list, b)))
			return (-1);
		if (ft_strchr(b, '\n'))
			break ;
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
