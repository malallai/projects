/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
<<<<<<< HEAD
/*   Updated: 2018/11/22 13:01:24 by malallai         ###   ########.fr       */
=======
/*   Updated: 2018/11/20 23:15:23 by malallai         ###   ########.fr       */
>>>>>>> 9ee428cd5a8e8fe70165fea22e5544d533aa5655
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

<<<<<<< HEAD
static t_list		*ft_getfile(int fd)
{
	t_list			*tmp;
	static t_list	*files;
=======
static t_list		*ft_getfile(t_list **files, int fd)
{
	t_list *tmp;
>>>>>>> 9ee428cd5a8e8fe70165fea22e5544d533aa5655

	tmp = files;
	while (tmp)
	{
		if ((int)tmp->content_size == fd)
			return (tmp);
		tmp = tmp->next;
	}
	if (!(tmp = ft_lstnew("\0", fd)))
		return (NULL);
	ft_lstadd(&files, tmp);
	tmp = files;
	return (tmp);
}

static size_t		ft_copyuntil(char **dst, char *src, char c)
{
	size_t		i;

	i = -1;
	while (src[++i])
		if (src[i] == c)
			break ;
	if (!(*dst = ft_strnew(i)))
		return (0);
	ft_strncpy(*dst, src, i);
	return (i);
}

static int			ft_free(t_list *list)
{
	free(list->content);
	return (0);
}

static int			ft_cpy(t_list *list, char *buff)
{
	char *tmp;

	if (!(tmp = ft_strjoin(list->content, buff)))
	{
		free(tmp);
		return (0);
	}
	free(list->content);
	if (!(list->content = ft_strnew(ft_strlen(tmp))))
	{
		free(tmp);
		return (0);
	}
	list->content = ft_strcpy(list->content, tmp);
	free(tmp);
	return (1);
}

int					get_next_line(const int fd, char **line)
{
	char			buff[BUFF_SIZE + 1];
	size_t			r;
	t_list			*list;

	if (fd < 0 || line == NULL || read(fd, buff, 0) < 0
		|| !(list = ft_getfile(fd)))
		return (-1);
	while ((r = read(fd, buff, BUFF_SIZE)))
	{
		buff[r] = '\0';
		if (!(ft_cpy(list, buff)))
			return (-1);
		if (ft_strchr(buff, '\n'))
			break ;
	}
	if (r < BUFF_SIZE && !ft_strlen(list->content))
		return (ft_free(list));
	r = ft_copyuntil(line, list->content, '\n');
	if (r < ft_strlen(list->content))
		list->content = list->content + r + 1;
	else
		ft_bzero(list->content, ft_strlen(list->content));
	return (1);
}
