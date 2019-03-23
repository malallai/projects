/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   file_utils.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/21 15:42:50 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 13:48:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		is_regular_file(const char *path)
{
	struct stat path_stat;

	stat(path, &path_stat);
	return (S_ISREG(path_stat.st_mode));
}

int		is_folder(const char *path)
{
	struct stat path_stat;

	stat(path, &path_stat);
	return (S_ISDIR(path_stat.st_mode));
}

int		exist(const char *path)
{
	return (is_regular_file(path) || is_folder(path));
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

char	*get_path(char *parent, char *file)
{
	char *tmp;

	if (!parent)
		return (file);
	if (parent[ft_strlen(parent) - 1] == '/')
	{
		tmp = ft_strjoin(parent, file);
		return (tmp);
	}
	tmp = ft_strjoin(parent, "/");
	return (ft_strcat(tmp, file));
}
