/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   stat_ftls.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 13:53:47 by malallai          #+#    #+#             */
/*   Updated: 2019/04/13 13:11:49 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		is_regular_file(const char *path)
{
	struct stat path_stat;

	lstat(path, &path_stat);
	return (S_ISREG(path_stat.st_mode));
}

int		is_lnk(const char *path)
{
	struct stat path_stat;

	lstat(path, &path_stat);
	return (S_ISLNK(path_stat.st_mode));
}

int		is_folder(const char *path)
{
	struct stat path_stat;

	lstat(path, &path_stat);
	return (S_ISDIR(path_stat.st_mode));
}

int		exist(t_file *file)
{
	return (is_lnk(file->path) || \
		is_regular_file(file->path) || is_folder(file->path));
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
