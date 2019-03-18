/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:46:34 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 15:49:04 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_infos	*get_dinfos(char *path, struct dirent *dirent)
{
	t_infos			*infos;
	struct stat		path_stat;

	stat(path, &path_stat);
	infos = (t_infos *)malloc(sizeof(t_infos *) * 6);
	infos->dirent = dirent;
	infos->gid = getgrgid(path_stat.st_gid);
	infos->uid = getpwuid(path_stat.st_uid);
	infos->stat = path_stat;
	infos->name = path;
	return (infos);
}

t_infos	*get_finfos(char *path)
{
	t_infos			*infos;
	struct stat		path_stat;

	stat(path, &path_stat);
	infos = (t_infos *)malloc(sizeof(t_infos *) * 6);
	infos->dirent = NULL;
	infos->gid = getgrgid(path_stat.st_gid); // plante
	infos->uid = getpwuid(path_stat.st_uid);
	infos->stat = path_stat;
	infos->name = path;
	return (infos);
}

void	read_folders(t_opt *opt)
{
	DIR				*dir;
	struct dirent	*sd;

	if ((dir = opendir(opt->entries->a[0])))
	{
		while ((sd = readdir(dir)))
		{
			add_file(opt, sd);
			ft_putcharln(get_dtype(sd->d_type));
		}
		closedir(dir);
	}
}

void	read_files(t_opt *opt)
{
	int		index;
	t_infos	*infos;

	index = 0;
	while (index < opt->files->count)
	{
		infos = get_finfos(opt->files->a[index++]);
		display(opt, infos, opt->files->max);
		free(infos);
	}
	ft_putendl("");
}
