/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   printer.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:28:25 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 23:46:57 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		print_file(t_opt *opt, t_file *file)
{
	if (has_flag(opt, F_DETAIL))
		return (print_details(file));
	else
	{
		if (!has_flag(opt, F_ALL) && is_hidden_file(file->name))
			return (0);
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
	if (name)
	{
		ft_putstr(folder->folder->name);
		ft_putendl(":");
	}
	while (file)
	{
		ret = print_file(opt, file);
		file = has_flag(opt, F_REVERSE) ? file->prev : file->next;
		if (ret && file && can_print(opt, file->name))
			ft_putchar('\n');
		if (!file)
			ft_putchar('\n');
	}
}

int		print_details(t_file *file)
{
	(void)file;
	return (1);
}
