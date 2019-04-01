/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   stat_ftls.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 13:53:47 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 14:52:51 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		is_regular_file(const char *path)
{
	struct stat path_stat;

	lstat(path, &path_stat);
	return (S_ISREG(path_stat.st_mode));
}

int		is_folder(const char *path)
{
	struct stat path_stat;

	lstat(path, &path_stat);
	return (S_ISDIR(path_stat.st_mode));
}

int		exist(t_file *file)
{
	return (is_regular_file(file->path) || is_folder(file->path));
}

char	*lsgetlink(char *path)
{
	int			link_len;
	char		*buf;

	if (!(buf = ft_strnew(1024)))
		return (NULL);
	if ((link_len = readlink(path, buf, 1024)))
		return (buf);
	return (NULL);
}

t_file	*get_file(t_file *first, int id)
{
	if (!first || id < 0)
		return (NULL);
	if (first->id == id)
		return (first);
	return (get_file(first->next, id));
}
