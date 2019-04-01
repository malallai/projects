/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:28:26 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 23:47:20 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	read_folder(t_opt *opt, t_folder *folder, int name)
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
		folder->count = index;
		sort(opt, folder, 0, folder->count);
		print_folder(opt, folder, name);
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

void	ls_folder(t_opt *opt, t_file *file)
{
	
	while (file)
	{
		if (is_folder(file->path))
			read_folder(opt, new_folder(file), file->prev || file->next);
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		if (file && is_folder(file->path))
			ft_putchar('\n');
	}
}

void	ls(t_opt *opt, t_file *file, int f)
{
	int		ret;
	
	ret = 0;
	while (file)
	{
		f = f ? f : is_folder(file->path);
		if (!is_folder(file->path))
			ret = print_file(opt, file);
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		if (ret && file && !is_folder(file->path) && can_print(opt, file->name))
			ft_putchar('\n');
		if (!file && ret)
			ft_putchar('\n');
	}
	if (f)
		ls_folder(opt, has_flag(opt, F_REVERSE) \
			? opt->main->file : opt->main->first);
}
