/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   print_put.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 17:56:02 by malallai          #+#    #+#             */
/*   Updated: 2019/04/23 14:01:59 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../ft_ls.h"

void	put_lnk(t_file *file)
{
	char	*tmp;

	if (!S_ISLNK(file->infos->file_stat.st_mode))
		return ;
	tmp = lsgetlink(file->path);
	ft_putstr(" -> ");
	ft_putstr(tmp);
	free(tmp);
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

void	put_guid(t_infos *infos, t_infosize *sizes)
{
	if (getpwuid(infos->file_stat.st_uid))
		put_str(getpwuid(infos->file_stat.st_uid)->pw_name, 1, 1, sizes->uid);
	else
		put_nbr(infos->file_stat.st_uid, 1, 1, sizes->uid);
	if (getgrgid(infos->file_stat.st_gid))
		put_str(getgrgid(infos->file_stat.st_gid)->gr_name, 1, 2, sizes->gid);
	else
		put_nbr(infos->file_stat.st_gid, 1, 2, sizes->gid);
}
