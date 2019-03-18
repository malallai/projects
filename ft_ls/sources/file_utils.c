/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   file_utils.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/18 14:35:04 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 14:35:23 by malallai         ###   ########.fr       */
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
