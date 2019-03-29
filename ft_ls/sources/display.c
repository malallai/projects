/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   display.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/21 13:56:33 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 13:50:17 by malallai         ###   ########.fr       */
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
	t_infos	*infos;

	if (!entry->count)
		return ;
	index = 0;
	file = has_flag(opt, F_REVERSE) ? entry->file : entry->first;
	while (index++ < entry->count && file)
	{
		tmp = print(opt, entry, file, (infos = get_infos(file, \
			file->name, file->dirent)));
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		if (file && tmp && can_print_next(opt, file))
			ft_putchar('\n');
		free_infos(infos);		
	}
	ft_putchar('\n');
}

int			can_print_next(t_opt *opt, t_file *file)
{
	if (!has_flag(opt, F_ALL) && file->name[0] == '.')
		return (0);
	return (1);
}

void		print_ls(t_opt *opt)
{
	display(opt, opt->files);
	read_folders(opt, opt->folders, 0);
}
