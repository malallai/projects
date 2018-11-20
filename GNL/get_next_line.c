/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/11/20 18:19:46 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "get_next_line.h"

static void	*ft_memalloc(size_t size)
{
	void *t;

	if (!(t = malloc(size)) || size == 0)
		return (NULL);
	ft_bzero(t, size);
	return (t);
}


static t_list	*ft_lstnew(void const *content, size_t content_size)
{
	t_list *new_list;

	if (!(new_list = (t_list *)malloc(sizeof(t_list))))
		return (NULL);
	if (content)
	{
		if (!(new_list->content = ft_memalloc(content_size)))
		{
			free(new_list);
			return (NULL);
		}
		ft_memcpy(new_list->content, content, content_size);
		new_list->content_size = content_size;
	}
	else
	{
		new_list->content = NULL;
		new_list->content_size = 0;
	}
	new_list->next = NULL;
	return (new_list);
}

static t_list		*ft_getfile(t_list **files, int fd)
{
	t_list *tmp;

	tmp = *files;
	while (tmp)
	{
		if ((int)tmp->content_size == fd)
			return (tmp);
		tmp = tmp->next;
	}
	if (!(tmp = ft_lstnew("\0", fd)))
		return (NULL);
	ft_lstadd(files, tmp);
	tmp = *files;
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

static int			ft_free(t_list **files, int fd)
{
	t_list *tmp;
	t_list *t;

	tmp = *files;
	while (tmp)
	{
		if ((int)tmp->content_size == fd)
		{
			t->next = tmp->next;
			free(tmp->content);
			free(tmp);
			*files = t;
			break ;
		}
		t = tmp;
		tmp = tmp->next;
	}
	return (0);
}

int					get_next_line(const int fd, char **line)
{
	char			buff[BUFF_SIZE + 1];
	static t_list	*files;
	size_t			r;
	t_list			*list;
	char			*tmp;

	if (fd < 0 || line == NULL || read(fd, buff, 0) < 0
		|| !(list = ft_getfile(&files, fd)))
		return (-1);
	while ((r = read(fd, buff, BUFF_SIZE)))
	{
		buff[r] = '\0';
		if (!(list->content = ft_strjoin((tmp = ft_strdup(list->content)), buff)))
		{
			free(tmp);
			return (-1);
		}
		free(tmp);
		if (ft_strchr(buff, '\n'))
			break ;
	}
	if (r < BUFF_SIZE && !ft_strlen(list->content))
		return (ft_free(&files, fd));
	r = ft_copyuntil(line, (tmp = ft_strdup(list->content)), '\n');
	if (r < ft_strlen(list->content))
		list->content = list->content + r + 1;
	else
		ft_bzero(list->content, ft_strlen(list->content));
	free(tmp);
	return (1);
}
