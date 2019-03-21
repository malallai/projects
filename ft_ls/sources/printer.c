/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   printer.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/21 15:46:40 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 19:23:56 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		print(t_opt *opt, t_entry *entry, t_file *file, t_infos *infos)
{
	int i;

	i = 0;
	if (has_flag(opt, F_DETAIL))
	{
		print_details(opt, entry, file, infos);
		return (0);
	}
	if (!has_flag(opt, F_ALL) && infos->name[0] == '.')
	{
		free_infos(infos);
		return (0);
	}
	ft_putstr(get_color(infos->stat.st_mode));
	ft_putstr(infos->name);
	ft_putstr(WHITE);
	free_infos(infos);
	return (1);
}

void	print_details(t_opt *opt, t_entry *entry, t_file *file, \
		t_infos *infos)
{
	char	*tmp;

	if (!has_flag(opt, F_ALL) && infos->name[0] == '.')
	{
		free_infos(infos);
		return ;
	}
	ft_putendl("");
	put(infos->mode, 0, 0, 0);
	put((tmp = ft_itoa(infos->stat.st_nlink)), 1, 1, entry->size.blks);
	free(tmp);
	put(infos->uid->pw_name, 1, 1, entry->size.uid);
	put(infos->gid->gr_name, 1, 2, entry->size.gid);
	put((tmp = ft_itoa(infos->stat.st_size)), 1, 2, entry->size.size);
	free(tmp);
	put(file->date, 1, 1, entry->size.t);
	ft_putstr(get_color(infos->stat.st_mode));
	ft_putchar(' ');
	put(infos->name, 0, 0, 0);
	ft_putstr(WHITE);
	print_lnk(opt, entry, file, infos);	
	free_infos(infos);
}

void	print_lnk(t_opt *opt, t_entry *entry, t_file *file, \
		t_infos *infos)
{
	(void)opt;
	(void)entry;
	(void)file;
	if (!S_ISLNK(infos->stat.st_mode))
		return ;
	ft_putstr(" -> ");
	ft_putstr(lsgetlink(infos->full_path));
}

void	put(char *str, int tab, int spaces, int max)
{
	int index;

	index = 0;
	while (tab && index++ < spaces + (max - (int)ft_strlen(str)))
		ft_putchar(' ');
	ft_putstr(str);
}
