/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:28:26 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 17:50:36 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	read_folder(t_opt *opt, t_folder *folder)
{
	int				index;
	DIR				*dir;
	struct dirent	*sd;
	t_file			*tmp;

	index = 0;
	if ((dir = opendir(folder->folder->path)))
	{
		while ((sd = readdir(dir)))
		{
			tmp = new_file(index, sd->d_name, folder->folder->path);
			update_read_folder(folder, tmp, index++);
		}
		closedir(dir);
		sort(opt, folder->first, 0, index);
		ls(opt, has_flag(opt, F_REVERSE) ? folder->file : folder->first);
	}
}

void	update_read_folder(t_folder *folder, t_file *tmp, int index)
{
	if (index)
	{
		tmp->prev = folder->file;
		folder->file->next = tmp;
	}
	else
		folder->first = tmp;
	folder->file = tmp;
	folder->size_all += folder->file->infos->file_stat.st_blocks;
	folder->size += (folder->file->name[0] == '.' ? 0 : \
		folder->file->infos->file_stat.st_blocks);
}

int		read_ls(t_opt *opt, t_file *file, t_file *tmp, int folders)
{
	if (!tmp)
		return (folders);
	if (is_folder(tmp->path))
	{
		if (folders == 2)
			read_folder(opt, tmp);
		else
		{
			if (!tmp->first)
				print_file(opt, tmp);
			folders = 1;
		}
	}
	else if (folders <= 1)
		print_file(opt, tmp);
	return (read_ls(opt, file, has_flag(opt, F_REVERSE) \
		? tmp->prev : tmp->next, folders));
}

void	first_ls(t_opt *opt, int f)
{
	t_file	*file;

	file = has_flag(opt, F_REVERSE) ? opt->main->file : opt->main->first;
	if (f)
	{
		while (file)
		{
			if (is_folder(file->path))
				read_folder(opt, new_folder(file));
			file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		}
	}
	else
	{
		while (file)
		{
			f = f ? f : is_folder(file->path);
			if (!is_folder(file->path))
				print_file(opt, file);
			file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		}
		if (f)
			first_ls(opt, f);
	}
}
