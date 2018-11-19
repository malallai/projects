/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   get_next_line.c                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/19 13:16:21 by malallai          #+#    #+#             */
/*   Updated: 2018/11/19 15:22:30 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <get_next_line.h>

static int	ft_copyuntil(char **dst, char *src, char c)
{

}

int			get_next_line(const int fd, char **line)
{
	char			buff[BUFF_SIZE + 1];
	//static t_list	file;
	//int				i;
	int				r;
	t_list			*lst;

	(void)line;
	lst = ft_lstnew(NULL, 0);
	while ((r = read(fd, buff, BUFF_SIZE)))
	{
		buff[r] = '\0';
		lst->content = ft_strjoin(lst->content, buff);
		if (ft_strchr(buff, '\n'))
			break;
	}
	ft_copyuntil(line, lst->content, '\n');
	printf ("%s\n", line);
	return (1);
}
