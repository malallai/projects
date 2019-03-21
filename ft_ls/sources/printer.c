/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   display.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/17 16:13:29 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 16:13:29 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	print(t_opt *opt, t_file *file, t_infos *infos, int size_max)
{
	int i;

	i = 0;
	if (has_flag(opt, F_DETAIL))
	{
		print_details(opt, infos, size_max);
		return ;
	}
	if (!has_flag(opt, F_ALL) && infos->name[0] == '.')
		return ;
		(void)file;
		ft_putendl(infos->name);
		get_color(infos->stat.st_mode);
	/*ft_putstr(get_color(infos->stat.st_mode));
	ft_putstr(infos->name);
	while (i++ < 1 + (size_max - file->name_size))
		ft_putstr(" ");*/
}

void	print_details(t_opt *opt, t_infos *infos, int size_max)
{
	(void)opt;
	(void)infos;
	(void)size_max;
}

void		display_folder(t_opt *opt, t_entry *entry)
{
	if (opt->folders->count > 1 || opt->files->count)
	{
		ft_putstr(entry->name);
		ft_putendl(":");
	}
	display(opt, entry);
}

void		display(t_opt *opt, t_entry *entry)
{
	int		index;
	t_infos	*infos;
	t_file	*file;

	if (!entry->count)
		return ;
	index = 0;
	file = entry->first;
	while (index++ < entry->count)
	{
		infos = get_infos(file->name, file->dirent);
		print(opt, file, infos, entry->max);
		file = file->next;
		free(infos);
	}
	ft_putendl("");
}

void		print_ls(t_opt *opt)
{
	display(opt, opt->files);
	if (opt->files->count && opt->folders->count)
		ft_putendl("");
	read_folders(opt);
}
