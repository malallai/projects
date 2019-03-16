/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:33:25 by malallai          #+#    #+#             */
/*   Updated: 2019/03/16 19:00:04 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

char	get_dtype(unsigned char type)
{
	if (type == DT_BLK)
		return ('p');
	else if (type == DT_CHR)
		return ('c');
	else if (type == DT_DIR)
		return ('d');
	else if (type == DT_FIFO)
		return ('t');
	else if (type == DT_LNK)
		return ('l');
	else if (type == DT_REG)
		return ('-');
	else if (type == DT_SOCK)
		return ('s');
	return ('-');
}

char	*get_color(char type, int mode)
{
	char *color;

	if (type == F_DIR)
		color = ft_strdup("\033[1;36m");
	else if (type == F_LINK)
		color = ft_strdup("\033[0;35m");
	else if (mode & S_IXUSR)
		color = ft_strdup("\033[0;31m");
	else
		color = ft_strdup("\033[0m");
	return (color);
}

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
    return (S_ISDIR(path_stat.st_mode) || S_ISLNK(path_stat.st_mode));
}
