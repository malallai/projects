/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/11/20 12:46:21 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <get_next_line.h>

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
	tmp = ft_lstnew("\0", fd);
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
	ft_strccpy(*dst, src, c);
	return (i);
}

int					get_next_line(const int fd, char **line)
{
	char			buff[BUFF_SIZE];
	static t_list	*files;
	int				r;
	t_list			*list;
	size_t			cpyret;

	if (fd < 0 || line == NULL || read(fd, buff, 0) < 0)
		return (-1);
	list = ft_getfile(&files, fd);
	while ((r = read(fd, buff, BUFF_SIZE)))
	{
		buff[r] = '\0';
		if (!(list->content = ft_strjoin(list->content, buff)))
			return (-1);
		if (ft_strchr(buff, '\n'))
			break ;
	}
	if (r == 0)
		return (0);
	cpyret = ft_copyuntil(line, list->content, '\n');
	if (cpyret < ft_strlen(list->content))
		list->content = list->content + cpyret + 1;
	else
		ft_bzero(list->content, ft_strlen(list->content));
	return (1);
}
