/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   printer.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:28:25 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 17:49:03 by malallai         ###   ########.fr       */
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
			ft_putchar('\n');
	}
	
}

void	print_details(t_file *file)
{
	(void)file;
}

void	put_lnk(t_file *file)
{
	if (!S_ISLNK(file->infos->file_stat.st_mode))
		return ;
	ft_putstr(" -> ");
	ft_putstr(lsgetlink(file->path));
}

void	put_nbr(int nbr, int tab, int spaces, int max)
{
	int		index;
	char	*str;

	index = 0;
	str = ft_itoa(nbr);
	while (tab && index++ < spaces + (max - (int)ft_strlen(str)))
		ft_putchar(' ');
	ft_putstr(str);
	free(str);
}

void	put_str(char *str, int tab, int spaces, int max)
{
	int index;

	index = 0;
	while (tab && index++ < spaces + (max - (int)ft_strlen(str)))
		ft_putchar(' ');
	ft_putstr(str);
}
