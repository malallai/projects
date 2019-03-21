/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:46:34 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 19:31:08 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_infos		*get_infos(char *parent_path, char *path, struct dirent *dirent)
{
	t_infos			*infos;
	struct stat		path_stat;
	struct passwd	*uid;
	struct group	*gid;
	char			*tmp;

	lstat((tmp = get_path(parent_path, path)), &path_stat);
	uid = getpwuid(path_stat.st_uid);
	gid = getgrgid(path_stat.st_gid);
	infos = (t_infos *)malloc(sizeof(t_infos *) * sizeof(struct stat));
	infos->name = path;
	infos->full_path = tmp;
	infos->mode = get_mode(path_stat.st_mode);
	infos->stat = path_stat;
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
		entry->tmp_dir = new_entry();
		entry->tmp_dir->recurs = entry->recurs;
		entry->tmp_dir->name = folder->name;
		if ((dir = opendir(folder->name)))
		{
			entry->tmp_dir->count = 0;
			while ((sd = readdir(dir)))
				add_file(entry->tmp_dir, sd->d_name, sd);
			quicksort(entry->tmp_dir, 0, entry->tmp_dir->count - 1);
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
	if (has_flag(opt, F_REVERSE))
	{
		if (has_flag(opt, F_RECURS))
		{
			if ((tmp = check_recurs(entry)))
			{
				read_folders(opt, tmp, 1);
				free_entries(tmp);
			}
		}
		display_folder(opt, entry->tmp_dir);
	}
	else
	{
		display_folder(opt, entry->tmp_dir);
		if (has_flag(opt, F_RECURS))
		{	
			if ((tmp = check_recurs(entry)))
			{
				read_folders(opt, tmp, 1);
				free_entries(tmp);
			}
		}
	}	
}

t_entry		*check_recurs(t_entry *folder)
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
		DEBUG("Test : %s %d\n", file->name, is_folder(file->name));		
		if (is_folder(file->name) && !(ft_strequ(file->name, ".") \
			|| ft_strequ(file->name, "..")))
		{
			strtmp = ft_strdup(folder->tmp_dir->name);
			strtmp = ft_strjoin(strtmp, "/");
			add_file(tmp, ft_strjoin(strtmp, file->name), NULL);
		}
		file = file->next;
	}
	if (tmp->count)
		quicksort(tmp, 0, tmp->count - 1);
	else
		return (NULL);
	return (tmp);
}
