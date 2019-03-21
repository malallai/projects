/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:46:34 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 00:20:26 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_infos		*get_infos(char *path, struct dirent *dirent)
{
	t_infos			*infos;
	struct stat		path_stat;
	struct passwd	*uid;
	struct group 	*gid;

	stat(path, &path_stat);
	uid = getpwuid(path_stat.st_uid);
	gid = getgrgid(path_stat.st_gid);
	infos = (t_infos *)malloc(sizeof(t_infos *) * sizeof(struct stat));
	infos->name = path;
	infos->mode = get_mode(path_stat.st_mode, 0);
	infos->stat = path_stat;
	infos->dirent = dirent;
	infos->uid = uid;
	infos->gid = gid;
	return (infos);
}

void		read_folders(t_opt *opt)
{
	DIR				*dir;
	struct dirent	*sd;
	t_file			*folder;
	int				index;

	folder = opt->folders->first;
	index = 0;
	while (index++ < opt->folders->count)
	{
		opt->tmp_dir = new_entry();
		opt->tmp_dir->name = folder->name;
		if ((dir = opendir(folder->name)))
		{
			opt->tmp_dir->count = 0;
			while ((sd = readdir(dir)))
				add_file(opt->tmp_dir, sd->d_name, sd);
			quicksort(opt->tmp_dir, 0, opt->tmp_dir->count - 1);
			display_folder(opt, opt->tmp_dir);
			closedir(dir);
		}
		if ((folder = folder->next))
			ft_putendl("");
	}
}
