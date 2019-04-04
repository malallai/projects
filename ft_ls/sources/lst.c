/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lst.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 13:42:27 by malallai          #+#    #+#             */
/*   Updated: 2019/04/04 18:02:09 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_file		*new_file(int id, char *name, char *parent)
{
	t_file		*file;
	char		*tmp;

	file = malloc(sizeof(t_file *) * 8);
	file->id = id;
	file->next = NULL;
	file->prev = NULL;
	file->name = ft_strdup(name);
	if (to_folder(name, parent))
		tmp = ft_strjoin(name, "/");
	else
		tmp = ft_strdup(name);
	if (parent)
		file->path = ft_strjoin(parent, tmp);
	else
		file->path = ft_strjoin(name[0] == '/' ? "" : "./", tmp);
	free(tmp);
	file->infos = get_infos(file);
	file->exist = exist(file);
	return (file);
}

t_infos		*get_infos(t_file *file)
{
	t_infos			*infos;
	struct stat		filestat;
	struct passwd	*uid;
	struct group	*gid;

	infos = malloc(sizeof(t_infos *) * (sizeof(struct stat) + 9));
	infos->display_name = ft_strdup(file->name);
	infos->path = ft_strdup(file->path);
	lstat(infos->path, &filestat);
	infos->file_stat = filestat;
	infos->perms = get_perms(infos->file_stat.st_mode);
	uid = getpwuid(infos->file_stat.st_uid);
	gid = getgrgid(infos->file_stat.st_gid);
	infos->uid = uid;
	infos->gid = gid;
	infos->millis = infos->file_stat.st_mtime;
	infos->date = get_date(infos->millis);
	infos->sizes = get_sizes(infos, infos->file_stat);
	return (infos);
}

t_infosize	*get_sizes(t_infos *info, struct stat pstat)
{
	t_infosize	*isize;
	int			len;

	isize = malloc(sizeof(t_infosize *) * 6);
	len = ft_len((int)pstat.st_blocks);
	isize->blocks = len > isize->blocks ? len : isize->blocks;
	len = ft_len((int)pstat.st_nlink);
	isize->links = len > isize->links ? len : isize->links;
	len = (int)ft_strlen(info->uid->pw_name);
	isize->uid = len > isize->uid ? len : isize->uid;
	len = (int)ft_strlen(info->gid->gr_name);
	isize->gid = len > isize->gid ? len : isize->gid;
	len = ft_len((int)pstat.st_size);
	isize->size = len > isize->size ? len : isize->size;
	len = (int)ft_strlen(info->date);
	isize->date = len > isize->date ? len : isize->date;
	return (isize);
}

t_folder	*new_folder(t_file *file)
{
	t_folder	*folder;

	folder = malloc(sizeof(t_folder *) * 6);
	folder->folder = file;
	folder->file = NULL;
	folder->first = NULL;
	folder->size = 0;
	folder->size_all = 0;
	folder->count = 0;
	return (folder);
}
