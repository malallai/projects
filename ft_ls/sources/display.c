/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   display.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/21 13:56:33 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 19:23:37 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void		display_folder(t_opt *opt, t_entry *entry)
{
	if (opt->folders->count > 1 || opt->files->count || entry->recurs)
	{
		ft_putstr(entry->name);
		ft_putendl(":");
	}
	if (has_flag(opt, F_DETAIL))
	{
		ft_putstr("total ");
		ft_putnbr(has_flag(opt, F_ALL) ? entry->totalall : entry->total);
	}
	display(opt, entry);
}

void		display(t_opt *opt, t_entry *entry)
{
	int		index;
	t_file	*file;
	int		tmp;

	if (!entry->count)
		return ;
	index = 0;
	file = has_flag(opt, F_REVERSE) ? entry->file : entry->first;
	while (index++ < entry->count && file)
	{
		tmp = print(opt, entry, file, get_infos(entry->name, file->name, file->dirent));
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		if (file && tmp)
			ft_putchar('\n');
	}
	ft_putchar('\n');
}

void		print_ls(t_opt *opt)
{
	display(opt, opt->files);
	if (opt->files->count && opt->folders->count)
		ft_putendl("");
	read_folders(opt, opt->folders, 0);
}
