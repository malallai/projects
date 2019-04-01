/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   printer.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:28:25 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 19:52:51 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	print_file(t_opt *opt, t_file *file)
{
	if (has_flag(opt, F_DETAIL))
		print_details(file);
	else
	{
		if (!has_flag(opt, F_ALL) && file->name[0] == '.')
			return ;
		ft_putstr(get_color(file->infos->file_stat.st_mode));
		ft_putstr(file->name);
		ft_putstr(WHITE);
		if (has_flag(opt, F_REVERSE) ? file->prev : file->next)
		{
			if (has_flag(opt, F_ALL) || (!has_flag(opt, F_ALL) && \
				!is_parent_path(has_flag(opt, F_REVERSE) ? file->prev->name \
				: file->next->name)))
				ft_putchar('\n');
		}
	}
}
void	print_folder(t_opt *opt, t_folder *folder, int name)
{
	t_file	*file;

	file = has_flag(opt, F_REVERSE) ? folder->file : folder->first;
	if (name)
	{
		ft_putstr(folder->folder->name);
		ft_putendl(":");
	}
	while (file)
	{
		print_file(opt, file);
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
	}
}

void	print_details(t_file *file)
{
	(void)file;
}
