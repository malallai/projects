/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   printer.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:28:25 by malallai          #+#    #+#             */
/*   Updated: 2019/04/16 11:39:19 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		print_file(t_opt *opt, t_file *file)
{
	if (!has_flag(opt, F_ALL) && is_hidden_file(file->name))
		return (0);
	opt->print = 1;
	if (!file->infos)
		return (0);
	if (has_flag(opt, F_DETAIL))
		return (print_details(opt, file));
	else
	{
		if (has_flag(opt, F_BLOCKS))
		{
			ft_putnbr(file->infos->file_stat.st_blocks);
			ft_putchar(' ');
		}
		ft_putstr(get_color(file->infos->file_stat.st_mode));
		ft_putstr(file->name);
		ft_putstr(WHITE);
	}
	return (1);
}

void	print_folder(t_opt *opt, t_folder *folder, int name)
{
	t_file	*file;
	int		ret;

	file = has_flag(opt, F_REVERSE) ? folder->file : folder->first;
	ft_putstr(opt->print ? "\n" : "");
	opt->print = 1;
	if (name)
	{
		ft_putstr(folder->folder->clean_path);
		ft_putendl(":");
	}
	if (!file)
		return ;
	if (has_flag(opt, F_DETAIL))
	{
		ft_putstr("total ");
		ft_putnbrln(has_flag(opt, F_ALL) ? folder->size_all : folder->size);
	}
	while (file)
	{
		ret = print_file(opt, file);
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		if (ret)
			ft_putchar('\n');
	}
}

int		print_details(t_opt *opt, t_file *file)
{
	t_infos		*infos;

	infos = file->infos;
	if (has_flag(opt, F_BLOCKS))
	{
		put_nbr(infos->file_stat.st_blocks, 1, 0, infos->sizes->blocks);
		put_str(infos->perms, 1, 1, 10);
	}
	else
		put_str(infos->perms, 0, 0, 0);
	put_nbr(infos->file_stat.st_nlink, 1, 2, infos->sizes->links);
	put_str(infos->uid->pw_name, 1, 1, infos->sizes->uid);
	put_str(infos->gid->gr_name, 1, 2, infos->sizes->gid);
	put_nbr(infos->file_stat.st_size, 1, 2, infos->sizes->size);
	put_str(infos->date, 1, 1, infos->sizes->date);
	ft_putstr(get_color(infos->file_stat.st_mode));
	ft_putchar(' ');
	put_str(file->name, 0, 0, 0);
	ft_putstr(WHITE);
	put_lnk(file);
	return (1);
}

void	print_lnk(t_opt *opt, t_file *file)
{
	char	*tmp;
	char	*tmp2;

	tmp = file->path;
	if (has_flag(opt, F_DETAIL))
		return ;
	tmp2 = ft_strjoin(tmp, "/");
	if (is_folder(tmp2))
	{
		file->path = tmp2;
		free(tmp);
	}
	else
		free(tmp2);
}
