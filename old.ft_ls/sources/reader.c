/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:46:34 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 18:47:07 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_infos		*get_infos(t_file *file, char *name, struct dirent *dirent)
{
	t_infos			*infos;
	struct passwd	*uid;
	struct group	*gid;

	uid = getpwuid(file->stat.st_uid);
	gid = getgrgid(file->stat.st_gid);
	infos = (t_infos *)malloc(sizeof(t_infos *) * sizeof(struct stat));
	infos->name = name;
	infos->mode = get_mode(file->stat.st_mode);
	infos->stat = file->stat;
	infos->dirent = dirent;
	infos->uid = uid;
	infos->gid = gid;
	return (infos);
}

void		read_folders(t_opt *opt, t_entry *entry, int ln)
{
	DIR				*dir;
	struct dirent	*sd;
	t_file			*folder;
	int				index;

	folder = has_flag(opt, F_REVERSE) ? entry->file : entry->first;
	index = 0;
	while (index++ < entry->count)
	{
		free_entries(entry->tmp_dir);
		entry->tmp_dir = new_entry();
		entry->tmp_dir->recurs = entry->recurs;
		entry->tmp_dir->name = folder->path;
		if ((dir = opendir(folder->path)))
		{
			entry->tmp_dir->count = 0;
			while ((sd = readdir(dir)))
				add_file(entry->tmp_dir, sd->d_name, sd);
			sort(opt, entry->tmp_dir, 0, entry->tmp_dir->count - 1);
			ft_putstr(ln ? "\n" : "");
			recurs(opt, entry);
			closedir(dir);
		}
		folder = has_flag(opt, F_REVERSE) ? folder->prev : folder->next;
	}
}

void		recurs(t_opt *opt, t_entry *entry)
{
	t_entry	*tmp;

	tmp = NULL;
	display_folder(opt, entry->tmp_dir);
	if (has_flag(opt, F_RECURS))
	{	
		if ((tmp = check_recurs(opt, entry)))
		{
			read_folders(opt, tmp, 1);
			free_entries(tmp);
		}
	}
}

t_entry		*check_recurs(t_opt *opt, t_entry *folder)
{
	int		index;
	t_file	*file;
	t_entry	*tmp;
	char	*strtmp;

	index = 0;
	file = folder->tmp_dir->first;
	tmp = new_entry();
	tmp->recurs = 1;
	while (file && index++ < folder->tmp_dir->count)
	{
		strtmp = join_path(folder->tmp_dir->name, file->name);
		if (is_folder(strtmp) && !(is_parent_path(file->path)))
			add_file(tmp, strtmp, NULL);
		else
			free(strtmp);
		file = file->next;
	}
	if (tmp->count)
		sort(opt, tmp, 0, tmp->count - 1);
	else
	{
		free_entries(tmp);
		return (NULL);
	}
	return (tmp);
}
